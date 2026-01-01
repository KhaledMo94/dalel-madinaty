<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Listing;
use App\Models\ListingBranch;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'radius'                    => 'nullable|numeric|min:5',
            'latitude'                  => 'required',
            'longitude'                 => 'required',
            'sub_category_id'           => 'required|exists:categories,id'
        ]);

        $radius = $request->query('radius') ?? 5;

        $offers = Offer::with([
            'listingBranch.listing'
        ])->whereHas('listingBranch', function ($query) use ($radius) {
            $query->having('distance', '<=', $radius);
        })->whereHas('listingBranch.listing.category',function($query) use ($request){
            $query->where('id',$request->query('sub_category_id'));
        })->active()->paginate(10);

        return OfferResource::collection($offers);
    }


    public function store(Request $request)
    {
        $request->validate([
            'content_ar'                        => 'nullable|required_with:content_en|string',
            'content_en'                        => 'nullable|required_with:content_ar|string',
            'image'                             => 'required|image|max:5120',
        ]);

        $user = Auth::guard('sanctum')->user();
        $listing = Listing::where('user_id', $user->id)->first();
        if (! $listing || $listing->status != 'active') {
            return response()->json([
                'message'                   => __('Must Create A Listing First Or Listing Deactivated By Admin'),
            ],401);
        }
        $branch = ListingBranch::where('listing_id', $listing->id)->orderBy('created_at')->first();

        $image = $request->file('image');
        $image_path = $image->store('offers', 'public');

        $old_offer = Offer::where('listing_branch_id', $branch->id)->first();

        if ($old_offer) {
            if ($old_offer->created_at > Carbon::now()->subWeek()) {
                return response()->json([
                    'message'                       => __('Offers Only Added Once Per a Week')
                ], 401);
            }
            Controller::deleteFile($old_offer->image);
            $old_offer->delete();
        }

        $offer = Offer::create([
            'image'                     => $image_path,
            'content'                   => [
                'ar'                        => $request->content_ar,
                'en'                        => $request->content_en,
            ],
            'listing_branch_id'         => $branch->id,
        ]);

        return response()->json([
            'message'                   => __('Offer Added Successfully'),
            'offer'                     => new OfferResource($offer),
        ]);
    }

    public function delete()
    {
        $user = Auth::guard('sanctum')->user();
        $listing = Listing::where('user_id', $user->id)->first();
        if (! $listing || $listing->status != 'active') {
            return response()->json([
                'message'                   => __('Must Create A Listing First Or Listing Deactivated By Admin'),
            ], 403);
        }
        $branch = ListingBranch::where('listing_id', $listing->id)->orderBy('created_at')->first();

        $offer = Offer::where('listing_branch_id', $branch->id)->first();

        if ($offer->status != 'active') {
            return response()->json([
                'message'                   => __('Must Be Active to Be Deleted'),
            ], 403);
        }

        if ($offer->image) {
            Controller::deleteFile($offer->image);
        }
        $offer->delete();

        return response()->json(status: 204);
    }
}
