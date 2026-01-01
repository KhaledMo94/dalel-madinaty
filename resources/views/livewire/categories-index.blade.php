@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<div wire:id="{{ $this->getId() }}">
    <div class="mb-3 row">
        <div class="col-md-4">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="{{ __('Search by name or description...') }}">
        </div>
        <div class="col-md-3">
            <select wire:model.live="statusFilter" class="form-control">
                <option value="all">{{ __('All Status') }}</option>
                <option value="active">{{ __('Active') }}</option>
                <option value="inactive">{{ __('Inactive') }}</option>
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model.live="mainCategoryFilter" class="form-control">
                <option value="all">{{ __('All Main Categories') }}</option>
                @foreach($this->main_categories ?? [] as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->getTranslation('name', app()->getLocale()) }}</option>
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
                    <th>{{ __('Parent Category') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Options') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($categories->currentPage() - 1) * $categories->perPage(); @endphp
                @forelse ($categories as $category)
                    <tr data-id="{{ $category->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $category->name ?? '' }} <br>
                            {{ $category->getTranslation('name', app()->getLocale()) }}</td>
                        <td>{{ $category->mainCategory->name ?? '' }} <br>
                            {{ $category->mainCategory->getTranslation('name', $rev_locale) ?? '' }}</td>
                        <td>{{ strip_tags($category->description ?? '') }} <br>
                            {{ strip_tags($category->getTranslation('description', app()->getLocale()) ?? '') }}</td>
                        <td>
                            @if($category->options->count() > 0)
                                <div class="d-flex flex-wrap">
                                    @foreach($category->options as $option)
                                        <span class="badge badge-info mr-1 mb-1">
                                            {{ $option->getTranslation('name', app()->getLocale()) }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">{{ __('No options') }}</span>
                            @endif
                        </td>
                        @if (!is_null($category->image))
                            <td><img src="{{ asset('storage/' . $category->image) }}" alt=""
                                    class="w_200"></td>
                        @else
                            <td>
                                <p>{{ __('No image') }}</p>
                            </td>
                        @endif
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admins.categories.edit', $category->id) }}"
                                    class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admins.categories.destroy', $category->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $category->id }}); event.preventDefault();"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('No categories found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>

