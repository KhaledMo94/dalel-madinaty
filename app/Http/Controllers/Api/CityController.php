<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search'                 =>'nullable|string',
        ]);
        
        $cities = City::when($request->filled('search'), function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'like', '%' . $request->search . '%')
            ->orWhere("description->{$locale}", 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);

        return CityResource::collection($cities);
    }

    public function show(Request $request)
    {
        $request->validate([
            'id'                 =>'required|exists:cities,id',
        ]);
        $city = City::findOrFail($request->query('id'));
        $city->load(['areas'])
        ->withCount(['areas']);
        return new CityResource($city);
    }
}
