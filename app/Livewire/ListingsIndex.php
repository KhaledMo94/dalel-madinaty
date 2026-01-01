<?php

namespace App\Livewire;

use App\Models\Listing;
use App\Models\Category;
use App\Models\Amenity;
use App\Models\Option;
use Livewire\Component;
use Livewire\WithPagination;

class ListingsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = 'all';
    public $amenityFilter = 'all';
    public $categories = [];
    public $amenities = [];

    public function mount($categories = [], $amenities = [])
    {
        $this->categories = $categories;
        $this->amenities = $amenities;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingAmenityFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();
        $query = Listing::query()
            ->with(['category', 'amenities', 'optionValues'])
            ->withCount([
                'users',
                'branches',
                'amenities',
                'optionValues'
            ])
            ->withAvg('ratings', 'rating');

        // Apply search filter
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.ar')) LIKE ?", [$searchTerm])
                  ->orWhereHas('category', function ($categoryQuery) use ($searchTerm, $locale) {
                      $categoryQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm]);
                  });
            });
        }

        // Apply category filter
        if ($this->categoryFilter != 'all') {
            $query->where('category_id', $this->categoryFilter);
        }

        // Apply amenity filter
        if ($this->amenityFilter != 'all') {
            $query->whereHas('amenities', function ($q) {
                $q->where('amenities.id', $this->amenityFilter);
            });
        }

        $listings = $query->latest('updated_at')->paginate(10);

        return view('livewire.listings-index', [
            'listings' => $listings
        ]);
    }
}

