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
            ->with(['category', 'amenities', 'branches'])->active()->findOrFail($request->query('id'));

        return new ListingResource($listing);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q'                     => 'required|string',
            'city_id'               => 'nullable|exists:cities,id',
        ]);

        $search = "%{$request->query('q')}%";

        $locale = app()->getLocale();

        $listings = Listing::with('category', 'nearestListingBranch')
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

        $listings = $listings->paginate();

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


    public function myListingWithBranches()
    {
        $user = Auth::guard('sanctum')->user();

        $listing = Listing::with(['branches', 'category', 'amenities'])
            ->where('user_id', $user->id)
            ->first();
            
        if(! $listing){
            return response()->json([
                'message'               =>__('No Listing Found'),    
            ]);
        }
            
        return new ListingResource($listing);
    }


    public function store(Request $request)
    {
        $categories_ids = Category::active()->pluck('id')->toArray();

        $amenities_ids = Amenity::whereHas('categories', function ($query) use ($request) {
            $query->where('id', $request->category_id);
        })->get()->pluck('id')->toArray();

        $user = Auth::guard('sanctum')->user();
        if (Listing::where('user_id', $user->id)->exists()) {
            return response()->json([
                'message'                       => __('Already Have A Listing'),
            ]);
        }

        $request->validate([
            'name_ar'               => 'required|string|max:255',
            'name_en'               => 'required|string|max:255',
            'description_en'        => 'nullable|required_with:description_ar|string',
            'description_ar'        => 'nullable|required_with:description_en|string',
            'address_ar'            => 'required|required_with:address_en|string',
            'address_en'            => 'required|required_with:address_ar|string',
            'phone'                 => ['required', 'string', 'max:15'],
            'phone_alt'             => ['nullable', 'string', 'max:15'],
            'category_id'           => ['required', Rule::in($categories_ids)],
            'image'                 => 'required|image|max:2048',
            'banner_image'          => 'required|image|max:2048',
            'file'                  => 'required|file|max:2048',
            'latitude'              => 'required|numeric|between:-90,90',
            'longitude'             => 'required|numeric|between:-180,180',
            'city_id'               => 'required|exists:cities,id',
            'tt_link'               => 'nullable|url',
            'insta_link'               => 'nullable|url',
            'fb_link'               => 'nullable|url',
            'amenities_ids'          => 'nullable|array',
            'amenities_ids.*'        => ['required', 'integer', Rule::in($amenities_ids)],
        ]);

        $image = $request->file('image');
        $image_path = $image->store('listings', 'public');

        $banner_path = null;
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_path = $banner_image->store('listings');
        }

        $file_path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('listings');
        }

        try {

            DB::beginTransaction();

            $listing = Listing::create([
                'name'                  => [
                    'en'                                => $request->name_en,
                    'ar'                                => $request->name_ar,
                ],
                'description'           => [
                    'en'                                => $request->description_en,
                    'ar'                                => $request->description_ar,
                ],
                'status'                            => 'active',
                'user_id'                           => $user->id,
                'category_id'                       => $request->category_id,
                'image'                             => $image_path,
                'file'                              => $file_path,
                'banner_image'                      => $banner_path,
                'tt_link'                           => $request->tt_link,
                'insta_link'                           => $request->insta_link,
                'fb_link'                           => $request->fb_link,
            ]);

            $listing->branches()->create([
                'address'                           => [
                    'en'                                => $request->address_en,
                    'ar'                                => $request->address_ar,
                ],
                'phone'                 => $request->phone,
                'phone_alt'             => $request->phone_alt,
                'latitude'              => $request->latitude,
                'longitude'              => $request->longitude,
                'city_id'               => $request->city_id,
            ]);

            if ($request->filled('amenities_ids')) {
                $listing->amenities()->attach($request->amenities_ids);
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'               => __('An Error Occurred'),
            ], 403);
        }


        return response()->json([
            'message'               => __('Listing Added Successfully'),
            'listing'               => new ListingResource($listing),
        ]);
    }

    public function myListings(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user || $user->status == 'inactive') {
            return response()->json([
                'message'                   => __('Unauthenticated or banned user')
            ], 401);
        }

        $listing = Listing::with(['category', 'amenities', 'branches'])->whereHas('users',function($query) use($user){
            $query->where('id',$user->id);
        })->paginate(10);

        return ListingResource::collection($listing);
    }

    public function nearbyProvider()
    {
        $user = Auth::guard('sanctum')->user();

        $providers = ServiceProvider::with('nearestServiceProviderBranch')
            ->active()
            ->paginate(10);

        return ListingResource::collection($providers);
    }

    public function update(Request $request)
    {
        $categories_ids = Category::active()->pluck('id')->toArray();
        $user = Auth::guard('sanctum')->user();
        $listing = Listing::where('user_id',$user->id)->first();

        $amenities_ids = Amenity::whereHas('categories', function ($query) use ($request , $listing) {
            $query->where('id', $request->category_id ?? $listing->category_id);
        })->get()->pluck('id')->toArray();

        $branch = ListingBranch::withoutGlobalScopes()
        ->where('listing_id',$listing->id)
        ->orderBy('created_at')
        ->firstOrFail();

        $request->validate([
            'name_ar'               => 'nullable|required_with:name_en|required|string|max:255',
            'name_en'               => 'nullable|required_with:name_ar|required|string|max:255',
            'description_en'        => 'nullable|required_with:description_ar|string',
            'description_ar'        => 'nullable|required_with:description_en|string',
            'address_ar'            => 'nullable|required_with:address_en|string',
            'address_en'            => 'nullable|required_with:address_ar|string',
            'image'                 => 'sometimes|required|image|max:2048',
            'banner_image'          => 'sometimes|required|image|max:2048',
            'file'                  => 'sometimes|required|file|max:2048',
            'category_id'           => ['sometimes','required', Rule::in($categories_ids)],
            'phone'                 => ['sometimes','required', 'string', 'max:15'],
            'phone_alt'             => ['sometimes','nullable', 'string', 'max:15'],
            'latitude'              => 'sometimes|required|numeric|between:-90,90',
            'longitude'             => 'sometimes|required|numeric|between:-180,180',
            'city_id'               => 'sometimes|required|exists:cities,id',
            'amenities_ids'         => 'nullable|required_with:category_id|array',
            'amenities_ids.*'       => ['required',Rule::in($amenities_ids)],
            'tt_link'               => 'nullable|url',
            'insta_link'               => 'nullable|url',
            'fb_link'               => 'nullable|url',
        ]);

        $image_path = $listing->image;
        if($request->has('image')){
            $image = $request->file('image');
            $image_path = $image->store('listings', 'public');
            if($listing->image){
                Controller::deleteFile($listing->image);
            }
        }

        $banner_path = $listing->banner_path;
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_path = $banner_image->store('listings');
            if($listing->banner_image){
                Controller::deleteFile($listing->banner_image);
            }
        }

        $file_path = $listing->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('listings');
            if($listing->file){
                Controller::deleteFile($listing->file);
            }
        }

        if($request->filled('name_ar')){
            $listing->name = [
                'ar'                    =>$request->name_ar,
                'en'                    =>$request->name_en,
            ];
        }

        if($request->filled('description_ar')){
            $listing->description = [
                'ar'                    =>$request->description_ar,
                'en'                    =>$request->description_en,
            ];
        }

        $listing->image = $image_path;
        $listing->banner_image = $banner_path;
        $listing->file = $file_path;

        if($request->filled('category_id')){
            $listing->category_id = $request->category_id;
        }
        if($request->filled('fb_link')){
            $listing->fb_link = $request->fb_link;
        }
        if($request->filled('insta_link')){
            $listing->insta_link = $request->insta_link;
        }
        if($request->filled('tt_link')){
            $listing->tt_link = $request->tt_link;
        }

        if($request->filled('city_id')){
            $branch->city_id = $request->city_id;
        }
        if($request->filled('phone')){
            $branch->phone = $request->phone;
        }
        if($request->filled('phone_alt')){
            $branch->phone_alt = $request->phone_alt;
        }
        if($request->filled('latitude')){
            $branch->latitude = $request->latitude;
        }
        if($request->filled('longitude')){
            $branch->longitude = $request->longitude;
        }

        try {
            DB::beginTransaction();
            $listing->save();
            $branch->save();
            if ($request->filled('amenities_ids')) {
                $listing->amenities()->sync($request->amenities_ids);
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message'               => $th->getMessage(),
            ], 403);
        }

        return response()->json([
            'message'               => __('Listing Updated Successfully'),
        ]);
    }

}
