@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-4">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="{{ __('Search by content or listing name...') }}">
        </div>
        <div class="col-md-3">
            <select wire:model.live="listingFilter" class="form-control">
                <option value="all">{{ __('All Listings') }}</option>
                @foreach ($this->listings ?? [] as $listing)
                    <option value="{{ $listing->id }}">{{ $listing->getTranslation('name', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="sr-only" for="startDateFilter">{{ __('Start Date') }}</label>
            <input type="date" id="startDateFilter" wire:model.live="startDateFilter" class="form-control"
                placeholder="{{ __('Start Date') }}">
        </div>
        <div class="col-md-2">
            <label class="sr-only" for="endDateFilter">{{ __('End Date') }}</label>
            <input type="date" id="endDateFilter" wire:model.live="endDateFilter" class="form-control"
                placeholder="{{ __('End Date') }}">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            @if ($startDateFilter || $endDateFilter)
                <button type="button" wire:click="clearDateFilters" class="btn btn-sm btn-secondary w-100"
                    title="{{ __('Clear Date Filters') }}">
                    <i class="fas fa-times"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Content') }}</th>
                    <th>{{ __('Listing Name') }}</th>
                    <th>{{ __('Listing Logo') }}</th>
                    <th>{{ __('Start Date') }}</th>
                    <th>{{ __('End Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($offers->currentPage() - 1) * $offers->perPage(); @endphp
                @forelse ($offers as $offer)
                    <tr data-id="{{ $offer->id }}">
                        <td>{{ ++$i }}</td>
                        <td>
                            @if ($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ __('Offer Image') }}"
                                    width="50px">
                            @else
                                <p>{{ __('No Image') }}</p>
                            @endif
                        </td>
                        <td>
                            {{ $offer->getTranslation('content', app()->getLocale()) }}
                            <br>
                            {{ $offer->getTranslation('content', $rev_locale) }}
                        </td>
                        <td>
                            {{ $offer->listing?->getTranslation('name', app()->getLocale()) ?? __('N/A') }}
                            <br>
                            {{ $offer->listing?->getTranslation('name', $rev_locale) ?? '' }}
                        </td>
                        <td>
                            @if ($offer->listing?->image)
                                <img src="{{ asset('storage/' . $offer->listing->image) }}" alt=""
                                    width="100px">
                            @else
                                <p>{{ __('No image') }}</p>
                            @endif
                        </td>
                        <td>{{ $offer->start_date ? $offer->start_date->format('Y-m-d H:i') : __('N/A') }}</td>
                        <td>{{ $offer->end_date ? $offer->end_date->format('Y-m-d H:i') : __('N/A') }}</td>
                        <td>
                            @if ($offer->is_active)
                                <span class="badge badge-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.offers.show', $offer->id) }}"
                                    class="mx-1 btn btn-info btn-sm" title="{{ __('View') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admins.offers.edit', $offer->id) }}"
                                    class="mx-1 btn btn-primary btn-sm" title="{{ __('Edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-{{ $offer->id }}"
                                    action="{{ route('admins.offers.destroy', $offer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $offer->id }}); event.preventDefault();"
                                        title="{{ __('Delete') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">{{ __('No offers found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $offers->links() }}
    </div>
</div>

<script>
    function confirmDelete(offerId) {
        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('You will not be able to revert this!') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('Yes, delete it!') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + offerId).submit();
            }
        });
    }
</script>
