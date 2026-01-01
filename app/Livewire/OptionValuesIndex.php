<?php

namespace App\Livewire;

use App\Models\OptionValue;
use Livewire\Component;
use Livewire\WithPagination;

class OptionValuesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $optionFilter = 'all';
    public $options = [];

    public function mount($options = [])
    {
        $this->options = $options;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingOptionFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = OptionValue::query()->with('option');

        // Apply search filter
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm]);
            });
        }

        // Apply option filter
        if ($this->optionFilter != 'all') {
            $query->where('option_id', $this->optionFilter);
        }

        $optionValues = $query->latest('updated_at')->paginate(10);

        return view('livewire.option-values-index', [
            'optionValues' => $optionValues
        ]);
    }
}

