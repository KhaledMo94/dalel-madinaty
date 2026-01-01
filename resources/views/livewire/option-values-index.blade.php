@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-6">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="{{ __('Search by name...') }}">
        </div>
        <div class="col-md-3">
            <select wire:model.live="optionFilter" class="form-control">
                <option value="all">{{ __('All Options') }}</option>
                @foreach($this->options ?? [] as $option)
                    <option value="{{ $option->id }}">{{ $option->getTranslation('name', app()->getLocale()) }}</option>
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
                    <th>{{ __('Option') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($optionValues->currentPage() - 1) * $optionValues->perPage(); @endphp
                @forelse ($optionValues as $optionValue)
                    <tr data-id="{{ $optionValue->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $optionValue->name ?? '' }} <br>
                            {{ $optionValue->getTranslation('name', $rev_locale) }}</td>
                        <td>{{ $optionValue->option->name ?? '' }} <br>
                            {{ $optionValue->option->getTranslation('name', $rev_locale) ?? '' }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.option-values.edit', $optionValue->id) }}"
                                    class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $optionValue->id }}"
                                    action="{{ route('admins.option-values.destroy', $optionValue->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $optionValue->id }}); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{ __('No option values found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $optionValues->links() }}
    </div>
</div>

