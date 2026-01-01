<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::select('id', 'name')->get();
        return view('admin.areas.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::latest('updated_at')->select('id', 'name')->get();
        return view('admin.areas.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities = City::pluck('id')->toArray();
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
            'city_id'                   => ['required', 'exists:cities,id'],
        ]);

        Area::create([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
            'city_id'                   => $request->city_id,
        ]);

        return redirect()->route('admins.areas.index')
            ->with('success', __('Area Added Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $cities = City::latest('updated_at')->select('id', 'name')->get();
        return view('admin.areas.edit', compact('area', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
            'city_id'                   => ['required', 'exists:cities,id'],
        ]);

        $area->update([
            'name'                      => [
                'en'                        => $request->name_en,
                'ar'                        => $request->name_ar,
            ],
            'description'               => [
                'en'                        => $request->description_en,
                'ar'                        => $request->description_ar,
            ],
            'city_id'                   => $request->city_id,
        ]);

        return redirect()->route('admins.areas.index')
            ->with('success', __('Area Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('admins.areas.index')
            ->with('success', __('Area Deleted Successfully'));
    }

    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";
        $cityId = $request->query('city_id');

        $query = Area::where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        });

        // Filter by city if provided
        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        $areas = $query->limit(10)->get();

        return response()->json(
            $areas->map(function ($area) {
                return [
                    'id' => $area->id,
                    'name' => $area->getTranslation('name', app()->getLocale()),
                ];
            })
        );
    }
}
