<?php

namespace App\Livewire;

use App\Models\MainCategory;
use Livewire\Component;
use Livewire\WithPagination;

class MainCategoriesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = MainCategory::query();

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

        // Apply status filter
        if ($this->statusFilter != 'all') {
            $query->where('status', $this->statusFilter);
        }

        $categories = $query->latest('updated_at')->paginate(10);

        return view('livewire.main-categories-index', [
            'categories' => $categories
        ]);
    }
}

