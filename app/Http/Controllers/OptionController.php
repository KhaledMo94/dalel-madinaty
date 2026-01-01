<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.options.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
        ]);

        Option::create([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
        ]);

        return redirect()->route('admins.options.index')
            ->with('success', __('Option Added Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
        ]);

        $option->update([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
        ]);

        return redirect()->route('admins.options.index')
            ->with('success', __('Option Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('admins.options.index')
            ->with('success', __('Option Deleted Successfully'));
    }

    /**
     * Search options for select2
     */
    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";

        $options = Option::where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        })->limit(10)->get();

        return response()->json(
            $options->map(function ($option) use ($locale) {
                return [
                    'id' => $option->id,
                    'name' => $option->getTranslation('name', $locale),
                ];
            })
        );
    }
}
