<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\OfferResource;
use App\Models\Area;
use App\Models\Offer;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function offers(Request $request)
    {
        $request->validate([
            'listing_id'                => 'nullable|exists:listings,id',
            'category_id'               => 'nullable|exists:categories,id',
            'search'                    => 'nullable|string',
            'is_active'                 => 'nullable|boolean',
        ]);

        $offers = Offer::with(['listing' => function ($query) {
            $query->withIsLiked();
        }])->when($request->filled('listing_id'), function ($query) use ($request) {
            $query->where('listing_id', $request->listing_id);
        })->when($request->filled('category_id'), function ($query) use ($request) {
            $query->whereHas('listing.category', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        })->when($request->filled('search'), function ($query) use ($request) {
            $query->where('content', 'like', '%' . $request->search . '%');
        })->when($request->filled('is_active'), function ($query) use ($request) {
            $query->where('is_active', $request->is_active);
        })->paginate(10);

        return OfferResource::collection($offers);
    }

    public function areas(Request $request)
    {
        $request->validate([
            'city_id'               => 'nullable|exists:cities,id',
            'search'                => 'nullable|string',
        ]);
        $locale = app()->getLocale();
        $areas = Area::when($request->filled('city_id'), function ($query) use ($request) {
            $query->where('city_id', $request->city_id);
        })->when($request->filled('search'), function ($query) use ($request , $locale) {
            $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
        })->paginate(10);
        return AreaResource::collection($areas);
    }


}
