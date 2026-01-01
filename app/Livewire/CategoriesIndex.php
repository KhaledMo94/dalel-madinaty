<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $mainCategoryFilter = 'all';
    public $main_categories = [];

    public function mount($main_categories = [])
    {
        $this->main_categories = $main_categories;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingMainCategoryFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Category::query()->with(['mainCategory', 'options']);

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

        // Apply main category filter
        if ($this->mainCategoryFilter != 'all') {
            $query->where('main_category_id', $this->mainCategoryFilter);
        }

        $categories = $query->latest('updated_at')->paginate(10);

        return view('livewire.categories-index', [
            'categories' => $categories
        ]);
    }
}

