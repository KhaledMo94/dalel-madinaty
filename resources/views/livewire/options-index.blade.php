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
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Values Count') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($options->currentPage() - 1) * $options->perPage(); @endphp
                @forelse ($options as $option)
                    <tr data-id="{{ $option->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $option->name ?? '' }} <br>
                            {{ $option->getTranslation('name', $rev_locale) }}</td>
                        <td>{{ strip_tags($option->description ?? '') }} <br>
                            {{ strip_tags($option->getTranslation('description', $rev_locale) ?? '') }}</td>
                        <td>{{ $option->option_values_count }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.options.edit', $option->id) }}"
                                    class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $option->id }}"
                                    action="{{ route('admins.options.destroy', $option->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $option->id }}); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ __('No options found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $options->links() }}
    </div>
</div>

