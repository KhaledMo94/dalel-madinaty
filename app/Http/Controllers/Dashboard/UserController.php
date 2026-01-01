<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount(['listings'])
            ->latest()
            ->whereDoesntHave('roles')
            ->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Display a listing of commenters.
     */
    public function commenters()
    {
        $users = User::withCount(['listings'])
            ->with('commenterListing')
            ->commenters()
            ->latest()
            ->whereDoesntHave('roles')
            ->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listings = \App\Models\Listing::all();
        return view('admin.users.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'country_code' => 'required|string|max:5',
            'password' => 'required|string|min:8',
            'commenter_id' => 'nullable|exists:listings,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
            'email_verified' => 'nullable|boolean',
            'phone_verified' => 'nullable|boolean',
        ]);

        // Validate Egyptian phone number
        $fullPhone = $request->country_code . $request->phone_number;
        if (!preg_match('/^\+201[0-9]{9}$/', $fullPhone)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['phone_number' => __('Invalid Egyptian phone number. Format: +20XXXXXXXXXX')]);
        }

        // Check if phone number already exists
        if (\App\Models\User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['phone_number' => __('Phone number already exists')]);
        }

        $userData = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => $request->status,
            'commenter_id' => $request->commenter_id,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified ? now() : null,
            'phone_verified_at' => $request->phone_verified ? now() : null,
        ];

        if ($request->hasFile('image')) {
            $userData['image'] = $request->file('image')->store('users', 'public');
        }

        \App\Models\User::create($userData);

        return redirect()->route('admins.users.index')
            ->with('success', __('User created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $listings = \App\Models\Listing::all();
        return view('admin.users.edit', compact('user', 'listings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'country_code' => 'required|string|max:5',
            'password' => 'nullable|string|min:8',
            'commenter_id' => 'nullable|exists:listings,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
            'email_verified' => 'nullable|boolean',
            'phone_verified' => 'nullable|boolean',
        ]);

        // Validate Egyptian phone number
        $fullPhone = $request->country_code . $request->phone_number;
        if (!preg_match('/^\+201[0-9]{9}$/', $fullPhone)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['phone_number' => __('Invalid Egyptian phone number. Format: +20XXXXXXXXXX')]);
        }

        // Check if phone number already exists (excluding current user)
        if (\App\Models\User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)
            ->where('id', '!=', $id)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['phone_number' => __('Phone number already exists')]);
        }

        $userData = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
            'status' => $request->status,
            'commenter_id' => $request->commenter_id,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified ? now() : null,
            'phone_verified_at' => $request->phone_verified ? now() : null,
        ];

        if ($request->filled('password')) {
            $userData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Controller::deleteFile($user->image);
            }
            $userData['image'] = $request->file('image')->store('users', 'public');
        }

        $user->update($userData);

        return redirect()->route('admins.users.index')
            ->with('success', __('User updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if($user->image){
            Controller::deleteFile($user->image);
        }
        $user->delete();
        return redirect()->route('admins.users.index');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status =='active' ? 'inactive' : 'active';
        $user->save();

        $user->tokens()->delete();

        return response()->json([
            'message'                   =>'updated successfully',
        ]);
    }

    public function export()
    {
        return Excel::download(new UserExport(), 'users.xlsx');
    }
}
