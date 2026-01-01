<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CommenterController extends Controller
{
    /**
     * Display a listing of commenters.
     */
    public function index()
    {
        $users = User::withCount(['listings'])
            ->with('commenterListing')
            ->commenters()
            ->latest()
            ->whereDoesntHave('roles')
            ->get();
        return view('admin.commenters.index', compact('users'));
    }

    /**
     * Show the form for creating a new commenter.
     */
    public function create()
    {
        $listings = Listing::all();
        return view('admin.commenters.create', compact('listings'));
    }

    /**
     * Store a newly created commenter.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'country_code' => 'required|string|max:5',
            'password' => 'required|string|min:8',
            'commenter_id' => 'required|exists:listings,id',
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
        if (User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['phone_number' => __('Phone number already exists')]);
        }

        $userData = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'commenter_id' => $request->commenter_id,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified ? now() : null,
            'phone_verified_at' => $request->phone_verified ? now() : null,
        ];

        if ($request->hasFile('image')) {
            $userData['image'] = $request->file('image')->store('users', 'public');
        }

        User::create($userData);

        return redirect()->route('admins.commenters.index')
            ->with('success', __('Commenter created successfully'));
    }

    /**
     * Show the form for editing the specified commenter.
     */
    public function edit(string $id)
    {
        $user = User::commenters()->findOrFail($id);
        $listings = Listing::all();
        return view('admin.commenters.edit', compact('user', 'listings'));
    }

    /**
     * Update the specified commenter.
     */
    public function update(Request $request, string $id)
    {
        $user = User::commenters()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'country_code' => 'required|string|max:5',
            'password' => 'nullable|string|min:8',
            'commenter_id' => 'required|exists:listings,id',
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
        if (User::where('country_code', $request->country_code)
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
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Controller::deleteFile($user->image);
            }
            $userData['image'] = $request->file('image')->store('users', 'public');
        }

        $user->update($userData);

        return redirect()->route('admins.commenters.index')
            ->with('success', __('Commenter updated successfully'));
    }

    /**
     * Remove the specified commenter.
     */
    public function destroy(string $id)
    {
        $user = User::commenters()->findOrFail($id);
        if ($user->image) {
            Controller::deleteFile($user->image);
        }
        $user->delete();

        return redirect()->route('admins.commenters.index')
            ->with('success', __('Commenter deleted successfully'));
    }
}
