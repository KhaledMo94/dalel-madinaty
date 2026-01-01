<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $package = Package::latest('updated_at')->first();
        return view('admin.packages.index', compact('package'));
    }

    public function edit(Package $package)
    {
        $general = GeneralSetting::get();
        return view('admin.packages.edit', compact('package','general'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name_en'    => 'required|string|max:255',
            'name_ar'    => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'valid_days' => 'required|numeric|min:0',
            'version_major'         =>'required|integer|min:1',
            'version_minor'         =>'required|integer|min:0',
            'version_patch'         =>'required|integer|min:0',
        ]);


        $package->update([
            'name' => [
                'en'      => $request->name_en,
                'ar'      => $request->name_ar,
            ],
            'price'       => $request->price,
            'valid_days'  => $request->valid_days,
        ]);
        
GeneralSetting::updateOrCreate(
    ['key' => 'version_major'],   // search condition
    ['value' => $request->version_major]  // data to update/insert
);

GeneralSetting::updateOrCreate(
    ['key' => 'version_minor'],
    ['value' => $request->version_minor]
);

GeneralSetting::updateOrCreate(
    ['key' => 'version_patch'],
    ['value' => $request->version_patch]
);


        return redirect()->route('admins.packages.index')->with('success', __('Package Updated Successfully'));
    }
}
