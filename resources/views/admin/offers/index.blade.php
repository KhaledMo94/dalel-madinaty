<x-dashboard.main-layout>
    <h1 class="mb-3 text-gray-800 h3">{{ __('Offers') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="{{ route('admins.offers.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>{{ __('Add New') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            @livewire('offers-index', ['listings' => $listings])
        </div>
    </div>
</x-dashboard.main-layout>
