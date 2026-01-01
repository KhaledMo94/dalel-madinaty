<?php

namespace App\Livewire;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class CitiesIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = City::query()->withCount(['areas', 'listingBranches']);

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

        $cities = $query->latest('updated_at')->paginate(10);

        return view('livewire.cities-index', [
            'cities' => $cities
        ]);
    }
}

