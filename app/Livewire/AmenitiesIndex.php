<?php

namespace App\Livewire;

use App\Models\Amenity;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AmenitiesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = 'all';
    public $categories = [];

    public function mount($categories = [])
    {
        $this->categories = $categories;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();
        $query = Amenity::query()
            ->withCount(['listings', 'categories']);

        // Apply search filter
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.ar')) LIKE ?", [$searchTerm]);
            });
        }

        // Apply category filter
        if ($this->categoryFilter != 'all') {
            $query->whereHas('categories', function ($q) {
                $q->where('categories.id', $this->categoryFilter);
            });
        }

        $amenities = $query->latest('updated_at')->paginate(10);

        return view('livewire.amenities-index', [
            'amenities' => $amenities
        ]);
    }
}

