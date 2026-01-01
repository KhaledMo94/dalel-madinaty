<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::all();
        return view('admin.offers.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content_ar'                => 'required|string|max:150',
            'content_en'                => 'required|string|max:150',
            'image'                     => 'required|image|max:5120',
            'listing_id'                => 'required|exists:listings,id',
            'start_date'                => 'required|date',
            'end_date'                  => 'required|date|after:start_date',
        ]);
        
        $image  = $request->file('image');
        $image_path = $image->store('offers', 'public');
        
        Offer::create([
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ], 
            'listing_id' => $request->listing_id,
            'image' => $image_path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        
        return redirect()->route('admins.offers.index')
            ->with('success', __('Offer Added'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $offer->load('listing');
        return view('admin.offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $offer->load('listing');
        return view('admin.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'content_ar'                => 'required|string|max:150',
            'content_en'                => 'required|string|max:150',
            'image'                     => 'nullable|image|max:5120',
            'listing_id'                => 'required|exists:listings,id',
            'start_date'                => 'required|date',
            'end_date'                  => 'required|date|after:start_date',
        ]);
        
        $image_path = $offer->image;
        
        if($request->hasFile('image')){
            $image  = $request->file('image');
            $image_path = $image->store('offers', 'public');
            if($offer->image){
                Storage::disk('public')->delete($offer->image);
            }
        }
        
        $offer->update([
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ], 
            'listing_id' => $request->listing_id,
            'image' => $image_path,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        
        return redirect()->route('admins.offers.index')
            ->with('success', __('Offer Updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        if($offer->image){
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();

        return redirect()->route('admins.offers.index')->with('success', __('Offer Deleted Successfully'));
    }
}
