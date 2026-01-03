<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AmenityResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ListingResource;
use App\Http\Resources\MainCategoryResource;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function mainCategories(Request $request)
    {
        $request->validate([
            'search'                            => 'nullable|string',
        ]);
        $categories = MainCategory::active()->with('categories')
            ->when($request->filled('search'), function ($query) use ($request) {
                $locale = app()->getLocale();
                $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
            })->paginate(10);
        return MainCategoryResource::collection($categories);
    }

    public function subCategories(Request $request)
    {
        $categories = MainCategory::active()->pluck('id')->toArray();
        $request->validate([
            'main_category_id'               => ['nullable', Rule::in($categories)],
            'search'                            => 'nullable|string',
        ]);
        $categories = Category::with('mainCategory')->active()->when($request->filled('search'), function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
        })->when($request->filled('main_category_id'), function ($query) use ($request) {
            $query->where('main_category_id', $request->query('main_category_id'));
        })->paginate(10);
        return CategoryResource::collection($categories);
    }

    // public function listingsByCategory(Request $request)
    // {
    //     $sub_categories = Category::pluck('id')->toArray();

    //     $request->validate([
    //         'category_id'                       => ['nullable', Rule::in($sub_categories)],
    //         'city_id'                           => 'nullable|exists:cities,id',
    //         'area_id'                           => 'nullable|exists:areas,id',
    //     ]);

    //     $listings = Listing::with('category', 'nearestListingBranch.area')
    //         ->withIsLiked()
    //         ->active()->orderBy('created_at');

    //     if ($request->filled('category_id')) {
    //         $listings->where('category_id', $request->query('category_id'));
    //     }

    //     $listings->when($request->filled('city_id'), function ($listings) use ($request) {
    //         $listings->whereHas('branches', function ($query) use ($request) {
    //             $query->whereHas('area', function ($q) use ($request) {
    //                 $q->where('city_id', $request->query('city_id'));
    //             });
    //         });
    //     });

    //     $listings->when($request->filled('area_id'), function ($listings) use ($request) {
    //         $listings->whereHas('branches', function ($query) use ($request) {
    //             $query->whereHas('area', function ($q) use ($request) {
    //                 $q->where('id', $request->query('area_id'));
    //             });
    //         });
    //     });

    //     $listings->when($request->filled('category_id'), function ($listings) use ($request) {
    //         $listings->whereHas('category', function ($query) use ($request) {
    //             $query->where('id', $request->query('category_id'));
    //         });
    //     });

    //     $listings = $listings->paginate(10);

    //     return ListingResource::collection($listings);
    // }

    // public function listingByMainCategory(Request $request)
    // {
    //     $request->validate([
    //         'main_category_id'                       => ['nullable','exists:main_categories,id'],
    //         'city_id'                           => 'nullable|exists:cities,id',
    //         'area_id'                           => 'nullable|exists:areas,id',
    //     ]);

    //     $listings = Listing::with('category', 'nearestListingBranch.area')
    //         ->withIsLiked()
    //         ->active();

    //     if ($request->filled('category_id')) {
    //         $listings->whereHas('category.mainCategory', function($query) use ($request){
    //             $query->where('id',$request->query('category_id'));
    //         });
    //     }

    //     $listings->when($request->filled('city_id'), function ($listings) use ($request) {
    //         $listings->whereHas('branches', function ($query) use ($request) {
    //             $query->whereHas('area', function ($q) use ($request) {
    //                 $q->where('city_id', $request->query('city_id'));
    //             });
    //         });
    //     });

    //     $listings->when($request->filled('area_id'), function ($listings) use ($request) {
    //         $listings->whereHas('branches', function ($query) use ($request) {
    //             $query->whereHas('area', function ($q) use ($request) {
    //                 $q->where('id', $request->query('area_id'));
    //             });
    //         });
    //     });

    //     $listings->when($request->filled('main_category_id'), function ($listings) use ($request) {
    //         $listings->whereHas('category.mainCategory', function ($query) use ($request) {
    //             $query->where('id', $request->query('main_category_id'));
    //         });
    //     });

    //     $listings = $listings->paginate(50);

    //     return ListingResource::collection($listings);
    // }

    public function amenities(Request $request)
    {
        $request->validate([
            'category_id'                       => ['nullable', 'exists:categories,id'],
            'search'                            => 'nullable|string',
        ]);

        $amenities = Amenity::with('categories')
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->where('id', $request->query('category_id'));
                });
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $locale = app()->getLocale();
                $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
            })->paginate(10);

        return AmenityResource::collection($amenities);
    }
}
