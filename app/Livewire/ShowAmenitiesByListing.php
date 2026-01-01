<?php

namespace App\Livewire;

use App\Models\Amenity;
use Livewire\Component;

class ShowAmenitiesByListing extends Component
{
    public $category_id ;
    public $amenities = [];

    protected $listeners = ['categorySelected' => 'loadAmenities'];

    public function loadAmenities()
    {
        $this->amenities = Amenity::whereHas('categories',function($query){
            $query->where('id',$this->category_id);
        })->get();

    }
    public function render()
    {
        return view('livewire.show-amenities-by-listing');
    }
}
