@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-3">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="{{ __('Search by name, description, category...') }}">
        </div>
        <div class="col-md-3">
            <select wire:model.live="categoryFilter" class="form-control">
                <option value="all">{{ __('All Categories') }}</option>
                @foreach ($this->categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->getTranslation('name', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model.live="amenityFilter" class="form-control">
                <option value="all">{{ __('All Amenities') }}</option>
                @foreach ($this->amenities ?? [] as $amenity)
                    <option value="{{ $amenity->id }}">{{ $amenity->getTranslation('name', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Banner Image') }}</th>
                    <th>{{ __('File') }}</th>
                    <th>{{ __('Listing Name') }}</th>
                    <th>{{ __('Listing Category') }}</th>
                    <th>{{ __('Likes') }}</th>
                    <th>{{ __('Average Rating') }}</th>
                    <th>{{ __('Amenities') }}</th>
                    <th>{{ __('Options Count') }}</th>
                    <th>{{ __('Branches Count') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($listings->currentPage() - 1) * $listings->perPage(); @endphp
                @forelse ($listings as $listing)
                    <tr data-id="{{ $listing->id }}">
                        <td>{{ ++$i }}</td>
                        @if (!is_null($listing->image))
                            <td>
                                <img src="{{ asset('storage/' . $listing->image) }}" width="100px" alt=""
                                    class="">
                            </td>
                        @else
                            <td>
                                <p>{{ __('No Image') }}</p>
                            </td>
                        @endif

                        @if (!is_null($listing->banner_image))
                            <td>
                                <img src="{{ asset('storage/' . $listing->banner_image) }}" width="100px"
                                    alt="" class="">
                            </td>
                        @else
                            <td>
                                <p>{{ __('No Banner Image') }}</p>
                            </td>
                        @endif

                        @if (!is_null($listing->file))
                            <td>
                                <a href="{{ asset('storage/' . $listing->file) }}" target="_blank"
                                    class="btn btn-sm btn-primary">{{ __('View File') }}</a>
                            </td>
                        @else
                            <td>
                                <p>{{ __('No File') }}</p>
                            </td>
                        @endif

                        <td>
                            {{ $listing->getTranslation('name', app()->getLocale()) }}
                            <br>
                            {{ $listing->getTranslation('name', $rev_locale) }}
                        </td>

                        <td>
                            {{ $listing->category?->getTranslation('name', app()->getLocale()) ?? __('Uncategorized') }}
                            <br>
                            {{ $listing->category?->getTranslation('name', $rev_locale) ?? '' }}
                        </td>

                        <td>{{ $listing->users_count }}</td>
                        <td>
                            @if($listing->ratings_avg_rating)
                                <span class="badge badge-warning">
                                    <i class="fas fa-star"></i> {{ number_format($listing->ratings_avg_rating, 1) }}
                                </span>
                            @else
                                <span class="text-muted">{{ __('No Ratings') }}</span>
                            @endif
                        </td>
                        <td>
                            @foreach ($listing->amenities as $amenity)
                                <span
                                    class="badge badge-info">{{ $amenity->getTranslation('name', app()->getLocale()) }}</span>
                            @endforeach
                        </td>
                        <td>{{ $listing->option_values_count }}</td>
                        <td>{{ $listing->branches_count }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.listings.show', $listing->id) }}"
                                    class="mx-1 btn btn-info btn-sm"
                                    title="{{ __('View') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admins.listings.comments', $listing->id) }}"
                                    class="mx-1 btn btn-success btn-sm"
                                    title="{{ __('Comments') }}">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="{{ route('admins.listings.edit', $listing->id) }}"
                                    class="mx-1 btn btn-primary btn-sm"
                                    title="{{ __('Edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-{{ $listing->id }}"
                                    action="{{ route('admins.listings.destroy', $listing->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $listing->id }}); event.preventDefault();"
                                        title="{{ __('Delete') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">{{ __('No listings found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $listings->links() }}
    </div>
</div>

<script>
    function confirmDelete(listingId) {
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
                document.getElementById('delete-form-' + listingId).submit();
            }
        });
    }
</script>
