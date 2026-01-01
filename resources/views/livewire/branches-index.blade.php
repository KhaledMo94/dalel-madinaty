@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-4">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="{{ __('Search by address or listing name...') }}">
        </div>
        <div class="col-md-4">
            <select wire:model.live="cityFilter" class="form-control">
                <option value="all">{{ __('All Cities') }}</option>
                @foreach($this->cities ?? [] as $city)
                    <option value="{{ $city->id }}">{{ $city->getTranslation('name', app()->getLocale()) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select wire:model.live="areaFilter" class="form-control">
                <option value="all">{{ __('All Areas') }}</option>
                @foreach($this->filteredAreas ?? [] as $area)
                    <option value="{{ $area->id }}">{{ $area->getTranslation('name', app()->getLocale()) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Location') }}</th>
                    <th>{{ __('Listing') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Area') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Alternative Phone') }}</th>
                    <th>{{ __('Logo') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($branches->currentPage() - 1) * $branches->perPage(); @endphp
                @forelse ($branches as $branch)
                    <tr data-id="{{ $branch->id }}">
                        <td>{{ ++$i }}</td>
                        <td>
                            {{ $branch->getTranslation('address', app()->getLocale()) }}
                            <br>
                            {{ $branch->getTranslation('address', $rev_locale) }}
                        </td>
                        <td>
                            <a href="https://www.google.com/maps?q={{ $branch->latitude }},{{ $branch->longitude }}"
                                target="_blank">
                                {{ __('View on Map') }}
                            </a>
                        </td>
                        <td>
                            {{ $branch->listing?->getTranslation('name', app()->getLocale()) }}
                            <br>
                            {{ $branch->listing?->getTranslation('name', $rev_locale) }}
                        </td>
                        <td>
                            {{ $branch->area?->city?->getTranslation('name', app()->getLocale()) ?? __('N/A') }}
                            <br>
                            {{ $branch->area?->city?->getTranslation('name', $rev_locale) ?? '' }}
                        </td>
                        <td>
                            {{ $branch->area?->getTranslation('name', app()->getLocale()) ?? __('N/A') }}
                            <br>
                            {{ $branch->area?->getTranslation('name', $rev_locale) ?? '' }}
                        </td>
                        <td>{{ $branch->phone ?? __('N/A') }}</td>
                        <td>{{ $branch->phone_alt ?? __('N/A') }}</td>
                        <td>
                            @if ($branch->listing?->image)
                                <img src="{{ asset('storage/' . $branch->listing->image) }}" width="70" alt="">
                            @else
                                <p>{{ __('No image') }}</p>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                            <a href="{{ route('admins.branches.duplicate', ['id' => $branch->id]) }}"
                                class="mx-1 btn btn-warning btn-sm">
                                <i class="fas fa-copy"></i>
                            </a>
                            <a href="{{ route('admins.branches.edit', $branch->id) }}"
                                class="mx-1 btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $branch->id }}"
                                action="{{ route('admins.branches.destroy', $branch->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $branch->id }}); event.preventDefault();">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">{{ __('No branches found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $branches->links() }}
    </div>
</div>

<script>
    function confirmDelete(branchId) {
        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('You will not be able to revert this! ,Branch Cashiers Will Also Deleted') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('Yes, delete it!') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + branchId).submit();
            }
        });
    }

</script>

