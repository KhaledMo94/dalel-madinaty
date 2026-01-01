<?php

namespace App\Livewire;

use App\Models\ListingBranch;
use App\Models\City;
use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class BranchesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $cityFilter = 'all';
    public $areaFilter = 'all';
    public $cities = [];
    public $areas = [];

    public function mount($cities = [], $areas = [])
    {
        $this->cities = $cities;
        $this->areas = $areas;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCityFilter()
    {
        $this->resetPage();
        $this->areaFilter = 'all'; // Reset area filter when city changes
    }

    // Computed property for filtered areas
    public function getFilteredAreasProperty()
    {
        if ($this->cityFilter == 'all') {
            return $this->areas;
        }
        return collect($this->areas)->filter(function ($area) {
            return $area->city_id == $this->cityFilter;
        })->values()->all();
    }

    public function updatingAreaFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();
        $query = ListingBranch::query()
            ->with(['listing', 'area.city'])
            ->withoutGlobalScopes(); // Remove global scopes for admin view

        // Apply search filter (search by address and listing name)
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm, $locale) {
                // Search in address (translatable)
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(address, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(address, '$.ar')) LIKE ?", [$searchTerm])
                  // Search in listing name (through relationship)
                  ->orWhereHas('listing', function ($listingQuery) use ($searchTerm, $locale) {
                      $listingQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm]);
                  });
            });
        }

        // Apply city filter (through area relationship)
        if ($this->cityFilter != 'all') {
            $query->whereHas('area', function ($areaQuery) {
                $areaQuery->where('city_id', $this->cityFilter);
            });
        }

        // Apply area filter
        if ($this->areaFilter != 'all') {
            $query->where('area_id', $this->areaFilter);
        }

        $branches = $query->latest('updated_at')->paginate(10);

        return view('livewire.branches-index', [
            'branches' => $branches
        ]);
    }
}

