<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
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
            'image'                     => 'nullable|image|max:2048',
        ]);

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('cities', 'public');
        }

        $city = City::create([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
            'image'                     => $image_path,
        ]);

        return redirect()->route('admins.cities.index')
            ->with('success', __('City Added Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
            'image'                     => 'nullable|image|max:2048',
        ]);

        $image_path = $city->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('cities', 'public');
        }

        $city->update([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
            'image'                     => $image_path,
        ]);

        return redirect()->route('admins.cities.index')
            ->with('success', __('City Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if ($city->image) {
            Controller::deleteFile($city->image);
        }

        $city->delete();

        return redirect()->route('admins.cities.index')
            ->with('success', __('City Deleted Successfully'));
    }

    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";

        $cities = City::where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        })->limit(10)->get();

        return response()->json(
            $cities->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->getTranslation('name',app()->getLocale()),
                ];
            })
        );
    }
}
