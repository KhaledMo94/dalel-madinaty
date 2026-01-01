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
    public function singleListing(Request $request)
    {
        $request->validate([
            'id'                => 'required|exists:listings,id',
        ]);

        $listing = Listing::withCount('users')
            ->withIsLiked()
            ->with(['category', 'amenities', 'branches'])->active()->findOrFail($request->query('id'));

        return new ListingResource($listing);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q'                     => 'required|string',
            'city_id'               => 'nullable|exists:cities,id',
            'area_id'               => 'nullable|exists:areas,id',
            'category_id'           => 'nullable|exists:categories,id',
        ]);

        $search = "%{$request->query('q')}%";

        $locale = app()->getLocale();

        $listings = Listing::with('category', 'nearestListingBranch')
            ->withIsLiked()
            ->active()
            ->where("name->{$locale}", 'LIKE', $search)
            ->orWhere("description->{$locale}", 'LIKE', $search);

        $listings->when($request->filled('city_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('city', function ($q) use ($request) {
                    $q->where('id', $request->query('city_id'));
                });
            });
        });

        $listings->when($request->filled('area_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('area', function ($q) use ($request) {
                    $q->where('id', $request->query('area_id'));
                });
            });
        });

        $listings->when($request->filled('category_id'), function ($listings) use ($request) {
            $listings->whereHas('category', function ($query) use ($request) {
                $query->where('id', $request->query('category_id'));
            });
        });

        $listings = $listings->paginate(10);

        return ListingResource::collection($listings);
    }

    public function myListings(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $listings = $user->listings()
            ->withIsLiked()
            ->with(['category', 'nearestListingBranch'])
            ->active()
            ->paginate(10);

        return ListingResource::collection($listings);
    }

    public function myListingWithBranches(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $listing = Listing::where('user_id', $user->id)
            ->withIsLiked()
            ->with(['category', 'branches.area', 'branches.city'])
            ->firstOrFail();

        return new ListingResource($listing);
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
