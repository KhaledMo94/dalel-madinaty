<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Amenity;
use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class ListingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $amenities = Amenity::all();
        $options = Option::all();
        return view('admin.listings.index', compact('categories', 'amenities', 'options'));
    }

    public function create()
    {
        return view('admin.listings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
            'image'                     => 'nullable|image|max:5120',
            'images'                    => 'nullable|array',
            'images.*'                  => 'image|max:5120',
            'banner_image'              => 'nullable|image|max:5120',
            'file'                      => 'nullable|file|max:5120',
            'category_id'               => 'required|exists:categories,id',
            'amenities_ids'             => 'nullable|array',
            'amenities_ids.*'           => 'exists:amenities,id',
            'option_value_ids'          => 'nullable|array',
            'option_value_ids.*'        => 'exists:option_values,id',
            'latitude'                  => 'nullable|numeric|between:-90,90',
            'longitude'                 => 'nullable|numeric|between:-180,180',
            'tt_link'                   => 'nullable|url',
            'insta_link'                => 'nullable|url',
            'fb_link'                   => 'nullable|url',
            'status'                    => 'required|in:active,inactive',
        ]);

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('listings', 'public');
        }
        $banner_path = null;
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_path = $banner_image->store('listings', 'public');
        }
        $file_path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('listings', 'public');
        }

        try {
            DB::beginTransaction();
            $listing = Listing::create([
                'name'                      => [
                    'ar'                        => $request->name_ar,
                    'en'                        => $request->name_en,
                ],
                'description'               => [
                    'ar'                        => $request->description_ar,
                    'en'                        => $request->description_en,
                ],
                'image'                     => $image_path,
                'banner_image'              => $banner_path,
                'file'                      => $file_path,
                'status'                    => $request->status,
                'category_id'               => $request->category_id,
                'latitude'                  => $request->latitude,
                'longitude'                 => $request->longitude,
                'tt_link'                   => $request->tt_link,
                'insta_link'                => $request->insta_link,
                'fb_link'                   => $request->fb_link,
            ]);

            if ($request->has('amenities_ids')) {
                $listing->amenities()->attach($request->amenities_ids);
            }

            if ($request->has('option_value_ids')) {
                $listing->optionValues()->attach($request->option_value_ids);
            }

            // Handle multiple images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('listings/images', 'public');
                    ListingImage::create([
                        'listing_id' => $listing->id,
                        'image' => $imagePath,
                    ]);
                }
            }

            DB::commit();

            // Event::dispatch(new ListingsCreatedEvent($provider));
            return redirect()->route('admins.listings.index')
                ->with('success', __('Listing created successfully.'));
        } catch (Throwable $th) {
            return redirect()->route('admins.listings.index')
                ->with('error', $th->getMessage());
        }
    }

    public function show(Listing $listing)
    {
        $listing->load([
            'category',
            'amenities',
            'images',
            'users',
            'comments.user',
            'comments.replies.user'
        ])->loadCount('branches');
        return view('admin.listings.show', compact('listing'));
    }

    public function comments(Listing $listing)
    {
        $listing->load('category');

        // Paginate comments (only top-level comments, not replies)
        $comments = $listing->comments()
            ->with(['user', 'replies.user'])
            ->latest()
            ->paginate(10);

        return view('admin.listings.comments', compact('listing', 'comments'));
    }

    public function edit(Listing $listing)
    {
        $listing->load('amenities', 'category', 'optionValues', 'images');
        return view('admin.listings.edit', compact('listing'));
    }

    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'name_ar'                   => 'required|string|max:255',
            'name_en'                   => 'required|string|max:255',
            'description_ar'            => 'nullable|string',
            'description_en'            => 'nullable|string',
            'image'                     => 'nullable|image|max:5120',
            'images'                    => 'nullable|array',
            'images.*'                  => 'image|max:5120',
            'existing_images_ids'       => 'nullable|array',
            'existing_images_ids.*'     => 'exists:listing_images,id',
            'banner_image'              => 'nullable|image|max:5120',
            'file'                      => 'nullable|file|max:5120',
            'category_id'               => 'required|exists:categories,id',
            'amenities_ids'             => 'nullable|array',
            'amenities_ids.*'           => 'exists:amenities,id',
            'option_value_ids'          => 'nullable|array',
            'option_value_ids.*'        => 'exists:option_values,id',
            'latitude'                  => 'nullable|numeric|between:-90,90',
            'longitude'                 => 'nullable|numeric|between:-180,180',
            'tt_link'                   => 'nullable|url',
            'insta_link'                => 'nullable|url',
            'fb_link'                   => 'nullable|url',
            'status'                    => 'required|in:active,inactive',
        ]);

        $image_path = $listing->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('listings', 'public');
            if ($listing->image) {
                Controller::deleteFile($listing->image);
            }
        }
        $banner_path = $listing->banner_image;
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_path = $banner_image->store('listings', 'public');
            if ($listing->banner_image) {
                Controller::deleteFile($listing->banner_image);
            }
        }
        $file_path = $listing->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('listings', 'public');
            if ($listing->file) {
                Controller::deleteFile($listing->file);
            }
        }

        try {
            DB::beginTransaction();
            $listing->update([
                'name'                      => [
                    'ar'                        => $request->name_ar,
                    'en'                        => $request->name_en,
                ],
                'description'               => [
                    'ar'                        => $request->description_ar,
                    'en'                        => $request->description_en,
                ],
                'image'                     => $image_path,
                'banner_image'              => $banner_path,
                'file'                      => $file_path,
                'status'                    => $request->status,
                'category_id'               => $request->category_id,
                'latitude'                  => $request->latitude,
                'longitude'                 => $request->longitude,
                'tt_link'                   => $request->tt_link,
                'insta_link'                => $request->insta_link,
                'fb_link'                   => $request->fb_link,
            ]);

            $listing->amenities()->sync($request->amenities_ids ?? []);

            $listing->optionValues()->sync($request->option_value_ids ?? []);

            // Handle listing images
            $existingImageIds = $request->input('existing_images_ids', []);
            // Delete images that are not in the existing_images_ids array
            $listing->images()->whereNotIn('id', $existingImageIds)->each(function ($image) {
                Controller::deleteFile($image->image);
                $image->delete();
            });

            // Add new images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('listings/images', 'public');
                    ListingImage::create([
                        'listing_id' => $listing->id,
                        'image' => $imagePath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admins.listings.index')
                ->with('success', __('Listing updated successfully.'));
        } catch (Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }

    public function destroy(Listing $listing)
    {
        if ($listing->image) {
            Controller::deleteFile($listing->image);
        }
        if ($listing->banner_image) {
            Controller::deleteFile($listing->banner_image);
        }
        if ($listing->file) {
            Controller::deleteFile($listing->file);
        }

        $listing->delete();

        return redirect()->route('admins.listings.index')
            ->with('success', __('Listing Deleted successfully.'));
    }

    public function toggleStatus($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->status = $listing->status == 'active' ? 'inactive' : 'active';
        $listing->save();

        return response()->json([
            'message'           => __('Status Changed'),
        ]);
    }

    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";

        $listings = Listing::active()->where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        })->limit(10)->get();

        return response()->json(
            $listings->map(function ($listing) use ($locale) {
                return [
                    'id' => $listing->id,
                    'name' => $listing->getTranslation('name', $locale),
                ];
            })
        );
    }

    /**
     * Get category options with their values for listing form
     */
    public function getCategoryOptions(Request $request)
    {
        $categoryId = $request->query('category_id');

        if (!$categoryId) {
            return response()->json([]);
        }

        $category = Category::with(['options.optionValues'])->findOrFail($categoryId);
        $locale = app()->getLocale();

        $optionsData = $category->options->map(function ($option) use ($locale) {
            return [
                'id' => $option->id,
                'name' => $option->getTranslation('name', $locale),
                'values' => $option->optionValues->map(function ($value) use ($locale) {
                    return [
                        'id' => $value->id,
                        'name' => $value->getTranslation('name', $locale),
                    ];
                }),
            ];
        });

        return response()->json($optionsData);
    }
}
