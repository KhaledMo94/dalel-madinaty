<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingBranch;
use Illuminate\Http\Request;

class ListingBranchController extends Controller
{

    public function index()
    {
        $cities = \App\Models\City::all();
        $areas = \App\Models\Area::all();
        return view('admin.branches.index', compact('cities', 'areas'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_ar'                => 'required|string',
            'address_en'                => 'required|string',
            'listing_id'                => 'required|exists:listings,id',
            'area_id'                   => 'required|exists:areas,id',
            'latitude'                  => 'required|numeric|between:-90,90',
            'longitude'                 => 'required|numeric|between:-180,180',
            'phone'                     => 'nullable|string|max:15',
            'phone_alt'                 => 'nullable|string|max:15',
        ]);

        ListingBranch::withoutGlobalScopes()->create([
            'listing_id'                        => $request->listing_id,
            'area_id'                           => $request->area_id,
            'address'                           => [
                'en'                                => $request->address_en,
                'ar'                                => $request->address_ar,
            ],
            'latitude'                          => $request->latitude,
            'longitude'                         => $request->longitude,
            'phone'                             => $request->phone,
            'phone_alt'                         => $request->phone_alt,
        ]);

        return redirect()->route('admins.branches.index')
            ->with('success', __('Branch Added'));
    }

    public function edit($id)
    {
        $branch = ListingBranch::withoutGlobalScopes()
            ->with(['area.city', 'listing'])
            ->where('id', $id)
            ->firstOrFail();
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id )
    {
        $request->validate([
            'address_ar'                => 'required|string',
            'address_en'                => 'required|string',
            'listing_id'                => 'required|exists:listings,id',
            'area_id'                   => 'required|exists:areas,id',
            'latitude'                  => 'required|numeric|between:-90,90',
            'longitude'                 => 'required|numeric|between:-180,180',
            'phone'                     => 'nullable|string|max:15',
            'phone_alt'                 => 'nullable|string|max:15',
        ]);

        ListingBranch::withoutGlobalScopes()->where('id',$id)->update([
            'listing_id'                        => $request->listing_id,
            'area_id'                           => $request->area_id,
            'address'                           => [
                'en'                                => $request->address_en,
                'ar'                                => $request->address_ar,
            ],
            'latitude'                          => $request->latitude,
            'longitude'                         => $request->longitude,
            'phone'                             => $request->phone,
            'phone_alt'                         => $request->phone_alt,
        ]);

        return redirect()->route('admins.branches.index')
            ->with('success', __('Branch Updated'));
    }

    public function destroy($id)
    {
        $serviceProviderBranch = ListingBranch::findOrFail($id);
        $serviceProviderBranch->delete();
        return redirect()->route('admins.branches.index')
            ->with('success', __('Branch Deleted'));
    }

    public function duplicate(Request $request)
    {
        $request->validate([
            'id'                => 'required|exists:listing_branches,id',
        ]);

        $branch = ListingBranch::withoutGlobalScopes()
            ->with(['area.city', 'listing'])
            ->where('id', $request->query('id'))->firstOrFail();

        return view('admin.branches.duplicate', compact('branch'));
    }

    public function searchBranches(Request $request)
    {
        $providerId = $request->input('provider_id');
        $searchTerm = $request->input('q');
        $locale = app()->getLocale();

        $branches = ListingBranch::where('listing_id', $providerId)
            ->where("address->{$locale}", 'LIKE', "%{$searchTerm}%")
            ->limit(10)
            ->select('id', 'address')
            ->get();

        return response()->json(
            $branches->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'address' => $branch->getTranslation('address', app()->getLocale()),
                ];
            })
        );
    }
}
