<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Amenity;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Throwable;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.amenities.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.amenities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar'                       => 'required|string|max:255',
            'name_en'                       => 'required|string|max:255',
            'description_ar'                => 'nullable|string',
            'description_en'                => 'nullable|string',
            'image'                         => 'nullable|image|max:2048',
            'category_ids'                  => 'nullable|array',
            'category_ids.*'                => 'exists:categories,id',
        ]);

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('amenities', 'public');
        }

        try {
            DB::beginTransaction();
            $amenity = Amenity::create([
                'name'                  => [
                    'ar'                    => $request->name_ar,
                    'en'                    => $request->name_en,
                ],
                'description'           => [
                    'ar'                    => $request->description_ar,
                    'en'                    => $request->description_en,
                ],
                'image'                 => $image_path,
            ]);

            if ($request->has('category_ids')) {
                $amenity->categories()->attach($request->category_ids);
            }

            DB::commit();
            return redirect()->route('admins.amenities.index')
                ->with('success', __('Amenity Added Successfully'));
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('admins.amenities.index')
                ->with('error', __('Try Again Later'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenity $amenity)
    {
        $amenity = $amenity->load('categories');
        return view('admin.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name_ar'                       => 'required|string|max:255',
            'name_en'                       => 'required|string|max:255',
            'description_ar'                => 'nullable|string',
            'description_en'                => 'nullable|string',
            'image'                         => 'nullable|image|max:2048',
            'category_ids'                  => 'nullable|array',
            'category_ids.*'                => 'exists:categories,id',
        ]);

        $image_path = $amenity->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('amenities', 'public');
            if ($amenity->image) {
                Controller::deleteFile($amenity->image);
            }
        }

        try {
            DB::beginTransaction();
            $amenity->update([
                'name'                  => [
                    'ar'                    => $request->name_ar,
                    'en'                    => $request->name_en,
                ],
                'description'           => [
                    'ar'                    => $request->description_ar,
                    'en'                    => $request->description_en,
                ],
                'image'                 => $image_path,
            ]);

            $amenity->categories()->sync($request->category_ids ?? []);
            DB::commit();
            return redirect()->route('admins.amenities.index')
                ->with('success', __('Service Updated Successfully'));
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('Error Occurred Try Again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity)
    {
        if ($amenity->image) {
            Controller::deleteFile($amenity->image);
        }

        $amenity->delete();

        return redirect()->route('admins.amenities.index')
            ->with('success', __('Service Deleted Successfully'));
    }

    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";

        $amenities = Amenity::where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        })->limit(10)->get();

        $locale = app()->getLocale();
        return response()->json(
            $amenities->map(function ($amenity) use ($locale) {
                return [
                    'id' => $amenity->id,
                    'name' => $amenity->getTranslation('name', $locale),
                ];
            })
        );
    }
}
