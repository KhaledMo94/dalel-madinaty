<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingBranch;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search'                     => 'nullable|string',
            'city_id'                    => 'nullable|exists:cities,id',
            'area_id'                    => 'nullable|exists:areas,id',
            'category_id'                => 'nullable|exists:categories,id',
            'option_id'                  => 'nullable|exists:options,id',
            'option_value_id'            => 'nullable|exists:option_values,id',
            'amenity_id'                 => 'nullable|exists:amenities,id',
        ]);

        $locale = app()->getLocale();

        $listings = Listing::with('category', 'nearestListingBranch','amenities','optionValues.option')
            ->withIsLiked()
            ->withAvg('ratings', 'rating')
            ->active();

        $listings->when($request->filled('search'), function ($listings) use ($request , $locale) {
            $listings->where("name->{$locale}", 'like', '%' . $request->search . '%');
        });

        $listings->when($request->filled('city_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('area', function ($q) use ($request) {
                    $q->where('city_id', $request->city_id);
                });
            });
        });

        $listings->when($request->filled('area_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('area', function ($q) use ($request) {
                    $q->where('id', $request->area_id);
                });
            });
        });

        $listings->when($request->filled('category_id'), function ($listings) use ($request) {
            $listings->whereHas('category', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        });

        $listings->when($request->filled('option_id'), function ($listings) use ($request) {
            $listings->whereHas('optionValues', function ($query) use ($request) {
                $query->where('option_id', $request->option_id);
            });
        });

        $listings->when($request->filled('option_value_id'), function ($listings) use ($request) {
            $listings->whereHas('optionValues', function ($query) use ($request) {
                $query->where('id', $request->option_value_id);
            });
        });

        $listings->when($request->filled('amenity_id'), function ($listings) use ($request) {
            $listings->whereHas('amenities', function ($query) use ($request) {
                $query->where('id', $request->amenity_id);
            });
        });

        $listings = $listings->latest()->paginate(10);

        return ListingResource::collection($listings);
    }

    public function singleListing(Request $request)
    {
        $request->validate([
            'id'                => 'required|exists:listings,id',
        ]);

        $listing = Listing::withCount('users')
            ->withIsLiked()
            ->with(['category', 'amenities', 'branches.area'])->active()->findOrFail($request->query('id'));

        return new ListingResource($listing);
    }

    public function myListings(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $listings = $user->listings()
            ->withIsLiked()
            ->with(['category', 'nearestListingBranch','amenities','optionValues'])
            ->active()
            ->latest()
            ->paginate(10);

        return ListingResource::collection($listings);
    }

    public function likeToggle(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => __('unauthenticated'),
            ], 401);
        }

        $liked = DB::table('listing_users')
            ->where('user_id', $user->id)
            ->where('listing_id', $request->listing_id)
            ->exists();

        if ($liked) {
            $user->listings()->detach($request->listing_id);

            return response()->json([
                'message' => __('Like Removed'),
            ]);
        } else {
            // Attach if not liked yet
            $user->listings()->attach($request->listing_id);

            return response()->json([
                'message' => __('Like Added'),
            ]);
        }
    }

}
