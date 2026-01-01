@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-6">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="{{ __('Search by name or description...') }}">
        </div>
        <div class="col-md-6">
            <select wire:model.live="categoryFilter" class="form-control">
                <option value="all">{{ __('All Categories') }}</option>
                @foreach($this->categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->getTranslation('name', app()->getLocale()) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Amenity Name') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Amenity Description') }}</th>
                    <th>{{ __('Listings Count') }}</th>
                    <th>{{ __('Categories Count') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($amenities->currentPage() - 1) * $amenities->perPage(); @endphp
                @forelse ($amenities as $amenity)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                            {{ $amenity->getTranslation('name', app()->getLocale()) }}<br>
                            {{ $amenity->getTranslation('name', $rev_locale) }}
                        </td>
                        @if (!is_null($amenity->image))
                            <td><img src="{{ asset('storage/' . $amenity->image) }}" alt=""
                                    class="w_200"></td>
                        @else
                            <td>
                                <p>{{ __('No image') }}</p>
                            </td>
                        @endif
                        <td>
                            {{ strip_tags($amenity->getTranslation('description', app()->getLocale()) ?? '') }}<br>
                            {{ strip_tags($amenity->getTranslation('description', $rev_locale) ?? '') }}
                        </td>
                        <td>{{ $amenity->listings_count }}</td>
                        <td>{{ $amenity->categories_count }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admins.amenities.edit', $amenity->id) }}"
                                    class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $amenity->id }}" action="{{ route('admins.amenities.destroy', $amenity->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $amenity->id }}); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('No amenities found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $amenities->links() }}
    </div>
</div>

<script>
    function confirmDelete(amenityId) {
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
                document.getElementById('delete-form-' + amenityId).submit();
            }
        });
    }
</script>

