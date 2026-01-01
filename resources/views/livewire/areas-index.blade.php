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
        <div class="col-md-3">
            <select wire:model.live="cityFilter" class="form-control">
                <option value="all">{{ __('All Cities') }}</option>
                @foreach($this->cities ?? [] as $city)
                    <option value="{{ $city->id }}">{{ $city->getTranslation('name', app()->getLocale()) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($areas->currentPage() - 1) * $areas->perPage(); @endphp
                @forelse ($areas as $area)
                    <tr data-id="{{ $area->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $area->name ?? '' }} <br>
                            {{ $area->getTranslation('name', $rev_locale) }}</td>
                        <td>{{ $area->city->name ?? '' }} <br>
                            {{ $area->city->getTranslation('name', $rev_locale) ?? '' }}</td>
                        <td>{{ strip_tags($area->description ?? '') }} <br>
                            {{ strip_tags($area->getTranslation('description', $rev_locale) ?? '') }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.areas.edit', $area->id) }}"
                                    class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $area->id }}"
                                    action="{{ route('admins.areas.destroy', $area->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $area->id }}); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ __('No areas found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $areas->links() }}
    </div>
</div>

