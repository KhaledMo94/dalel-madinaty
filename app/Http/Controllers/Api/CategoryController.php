<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ListingResource;
use App\Http\Resources\MainCategoryResource;
use App\Models\Category;
use App\Models\Listing;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function mainCategories()
    {
        $categories = MainCategory::active()->paginate(10);
        return MainCategoryResource::collection($categories);
    }

    public function subCategories(Request $request)
    {
        $categories = MainCategory::active()->pluck('id')->toArray();
        $request->validate([
            'main_category_id'               => ['required', Rule::in($categories)],
        ]);

        $id = $request->query('main_category_id');

        $main_category = MainCategory::findOrFail($id);

        $sub_categories = Category::active()->where('main_category_id', $id)->get();

        return response()->json([
            'mainCategory'                      => new MainCategoryResource($main_category),
            'subCategories'                     => CategoryResource::collection($sub_categories),
        ]);
    }

    public function listingsByCategory(Request $request)
    {
        $sub_categories = Category::pluck('id')->toArray();

        $request->validate([
            'category_id'                       => ['nullable', Rule::in($sub_categories)],
            'city_id'                           => 'nullable|exists:cities,id',
        ]);

        $listings = Listing::with('category', 'nearestListingBranch.city')
            ->active()->orderBy('created_at');

        if ($request->filled('category_id')) {
            $listings->where('category_id', $request->query('category_id'));
        }

        $listings->when($request->filled('city_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('city', function ($q) use ($request) {
                    $q->where('id', $request->query('city_id'));
                });
            });
        });

        $listings = $listings->paginate(10);

        return ListingResource::collection($listings);
    }
    
    public function listingByMainCategory(Request $request)
    {
        $request->validate([
            'category_id'                       => ['nullable','exists:main_categories,id'],
            'city_id'                           => 'nullable|exists:cities,id',
        ]);

        $listings = Listing::with('category', 'nearestListingBranch.city')
            ->active();

        if ($request->filled('category_id')) {
            $listings->whereHas('category.mainCategory', function($query) use ($request){
                $query->where('id',$request->query('category_id'));
            });
        }

        $listings->when($request->filled('city_id'), function ($listings) use ($request) {
            $listings->whereHas('branches', function ($query) use ($request) {
                $query->whereHas('city', function ($q) use ($request) {
                    $q->where('id', $request->query('city_id'));
                });
            });
        });

        $listings = $listings->paginate(50);

        return ListingResource::collection($listings);
    }
}
