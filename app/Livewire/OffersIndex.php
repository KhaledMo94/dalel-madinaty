<?php

namespace App\Livewire;

use App\Models\Offer;
use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class OffersIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $listingFilter = 'all';
    public $startDateFilter = '';
    public $endDateFilter = '';
    public $listings = [];

    public function mount($listings = [])
    {
        $this->listings = $listings;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingListingFilter()
    {
        $this->resetPage();
    }

    public function updatingStartDateFilter()
    {
        $this->resetPage();
    }

    public function updatingEndDateFilter()
    {
        $this->resetPage();
    }

    public function clearDateFilters()
    {
        $this->startDateFilter = '';
        $this->endDateFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $locale = app()->getLocale();
        $query = Offer::query()
            ->with(['listing']);

        // Apply search filter
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm, $locale) {
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(content, '$.en')) LIKE ?", [$searchTerm])
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(content, '$.ar')) LIKE ?", [$searchTerm])
                  ->orWhereHas('listing', function ($listingQuery) use ($searchTerm, $locale) {
                      $listingQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.en')) LIKE ?", [$searchTerm])
                                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) LIKE ?", [$searchTerm]);
                  });
            });
        }

        // Apply listing filter
        if ($this->listingFilter != 'all') {
            $query->where('listing_id', $this->listingFilter);
        }

        // Apply date range filter (filters offers that overlap with the selected date range)
        if ($this->startDateFilter || $this->endDateFilter) {
            $query->where(function ($q) {
                $filterStartDate = $this->startDateFilter ? Carbon::parse($this->startDateFilter)->startOfDay() : null;
                $filterEndDate = $this->endDateFilter ? Carbon::parse($this->endDateFilter)->endOfDay() : null;

                if ($filterStartDate && $filterEndDate) {
                    // Both dates selected: find offers that overlap with the date range
                    // An offer overlaps if: offer_start <= filter_end AND offer_end >= filter_start
                    $q->where(function ($subQ) use ($filterStartDate, $filterEndDate) {
                        $subQ->whereDate('start_date', '<=', $filterEndDate)
                             ->whereDate('end_date', '>=', $filterStartDate);
                    });
                } elseif ($filterStartDate) {
                    // Only start date: find offers that haven't ended before the start date
                    $q->whereDate('end_date', '>=', $filterStartDate);
                } elseif ($filterEndDate) {
                    // Only end date: find offers that have started before or on the end date
                    $q->whereDate('start_date', '<=', $filterEndDate);
                }
            });
        }

        $offers = $query->latest('updated_at')->paginate(10);

        return view('livewire.offers-index', [
            'offers' => $offers
        ]);
    }
}

