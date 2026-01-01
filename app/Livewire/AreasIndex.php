<?php

namespace App\Livewire;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class AreasIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $cityFilter = 'all';
    public $cities = [];

    public function mount($cities = [])
    {
        $this->cities = $cities;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCityFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Area::query()->with('city');

        // Apply search filter
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(description, '$.ar')) LIKE ?", [$searchTerm]);
            });
        }

        // Apply city filter
        if ($this->cityFilter != 'all') {
            $query->where('city_id', $this->cityFilter);
        }

        $areas = $query->latest('updated_at')->paginate(10);

        return view('livewire.areas-index', [
            'areas' => $areas
        ]);
    }
}

