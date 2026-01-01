<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $main_categories = MainCategory::select('id', 'name')->get();
        return view('admin.categories.index', compact('main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = MainCategory::latest('updated_at')
            ->select('id', 'name')->get();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = MainCategory::latest('updated_at')
            ->pluck('id')->toArray();
        $request->validate([
            'name_en'                   => 'required|string|max:255',
            'name_ar'                   => 'required|string|max:255',
            'description_en'            => 'nullable|string',
            'description_ar'            => 'nullable|string',
            'image'                     => 'nullable|image|max:5120',
            'parent_id'                 => ['required', Rule::in($categories)],
            'status'                    => 'required|in:active,inactive',
            'option_ids'                => 'nullable|array',
            'option_ids.*'              => 'exists:options,id',
        ]);

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('categories', 'public');
        }

        $category = Category::create([
            'name'              => [
                'en'                => $request->name_en,
                'ar'                => $request->name_ar,
            ],
            'description'       => [
                'en'                => $request->description_en,
                'ar'                => $request->description_ar,
            ],
            'image'             => $image_path,
            'main_category_id'  => $request->input('parent_id'),
            'status'            => $request->status,
        ]);

        if ($request->has('option_ids')) {
            $category->options()->attach($request->option_ids);
        }

        return redirect()->route('admins.categories.index')
            ->with('success', __('Category Created Successfully'));
    }


    public function edit(Category $category)
    {
        $categories = MainCategory::latest('updated_at')
            ->select('id', 'name')->get();
        $category->load('options');

        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $categories = MainCategory::pluck('id')->toArray();
        $request->validate([
            'name_en'                   => 'required|string|max:255',
            'name_ar'                   => 'required|string|max:255',
            'description_en'            => 'nullable|string',
            'description_ar'            => 'nullable|string',
            'image'                     => 'nullable|image|max:5120',
            'parent_id'                 => ['required', Rule::in($categories)],
            'status'                    => 'required|in:active,inactive',
            'option_ids'                => 'nullable|array',
            'option_ids.*'              => 'exists:options,id',
        ]);

        $image_path = $category->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('categories', 'public');
        }

        $category->update([
            'name'              => [
                'en'                => $request->name_en,
                'ar'                => $request->name_ar,
            ],
            'description'       => [
                'en'                => $request->description_en,
                'ar'                => $request->description_ar,
            ],
            'image'             => $image_path,
            'main_category_id'         => $request->input('parent_id'),
            'status'            => $request->status,
        ]);

        $category->options()->sync($request->option_ids ?? []);

        return redirect()->route('admins.categories.index')
            ->with('success', __('Category Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Controller::deleteFile($category->image);
        }
        $category->delete();
        return redirect()->route('admins.categories.index')
            ->with('success', __('Category Updated Successfully'));
    }

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);

        $category->status = $category->status == 'active' ? 'inactive' : 'active';
        $category->save();

        return response()->json([
            'message'               => __('status changed successfully!')
        ]);
    }

    public function search(Request $request)
    {
        $locale = app()->getLocale();

        $search = "%{$request->query('q')}%";

        $categories = Category::where(function ($query) use ($search, $locale) {
            $query->where("name->{$locale}", 'LIKE', $search);
        })->limit(10)->get();

        $locale = app()->getLocale();
        return response()->json(
            $categories->map(function ($category) use ($locale) {
                return [
                    'id' => $category->id,
                    'name' => $category->getTranslation('name', $locale),
                ];
            })
        );
    }
}
