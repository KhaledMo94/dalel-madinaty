@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-12">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="{{ __('Search by name or description...') }}">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('City Name') }}</th>
                    <th>{{ __('City Description') }}</th>
                    <th>{{ __('Areas Count') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($cities->currentPage() - 1) * $cities->perPage(); @endphp
                @forelse ($cities as $city)
                    <tr data-id="{{ $city->id }}">
                        <td>{{ ++$i }}</td>
                        @if (!is_null($city->image))
                            <td>
                                <img src="{{ asset('storage/' . $city->image) }}" alt=""
                                    class="w_200">
                            </td>
                        @else
                            <td>
                                <p>{{ __('No Image') }}</p>
                            </td>
                        @endif
                        <td>{{ $city->name }} <br> {{ $city->getTranslation('name', $rev_locale) }}</td>
                        <td>{{ strip_tags($city->description ?? '') }} <br>
                            {{ strip_tags($city->getTranslation('description', $rev_locale) ?? '') }}</td>
                        <td>{{ $city->areas_count }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                            <a href="{{ route('admins.cities.edit', $city->id) }}"
                                class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <form id="delete-form-{{ $city->id }}"
                                action="{{ route('admins.cities.destroy', $city->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="mx-1 btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $city->id }}); event.preventDefault();">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('No cities found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $cities->links() }}
    </div>
</div>

