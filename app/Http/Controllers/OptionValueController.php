<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Http\Request;

class OptionValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::select('id', 'name')->get();
        return view('admin.option-values.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $options = Option::latest('updated_at')->select('id', 'name')->get();
        return view('admin.option-values.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $options = Option::pluck('id')->toArray();
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'option_id'                 => ['required', 'exists:options,id'],
        ]);

        OptionValue::create([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'option_id'                 => $request->option_id,
        ]);

        return redirect()->route('admins.option-values.index')
            ->with('success', __('Option Value Added Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OptionValue $optionValue)
    {
        $options = Option::latest('updated_at')->select('id', 'name')->get();
        return view('admin.option-values.edit', compact('optionValue', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OptionValue $optionValue)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'option_id'                 => ['required', 'exists:options,id'],
        ]);

        $optionValue->update([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'option_id'                 => $request->option_id,
        ]);

        return redirect()->route('admins.option-values.index')
            ->with('success', __('Option Value Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OptionValue $optionValue)
    {
        $optionValue->delete();

        return redirect()->route('admins.option-values.index')
            ->with('success', __('Option Value Deleted Successfully'));
    }
}
