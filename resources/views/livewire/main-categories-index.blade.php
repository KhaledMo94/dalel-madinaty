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
            <select wire:model.live="statusFilter" class="form-control">
                <option value="all">{{ __('All Status') }}</option>
                <option value="active">{{ __('Active') }}</option>
                <option value="inactive">{{ __('Inactive') }}</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('Serial') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($categories->currentPage() - 1) * $categories->perPage(); @endphp
                @forelse ($categories as $category)
                    <tr  data-id="{{ $category->id }}">
                        <td>{{ ++$i }}</td>
                        <td>{{ $category->name }} <br> {{ $category->getTranslation('name',$rev_locale) }}</td>
                        <td>{{ strip_tags($category->description ?? '') }} <br> {{ strip_tags($category->getTranslation('description',$rev_locale) ?? '') }} </td>
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
                            <a href="{{ route('admins.main-categories.edit', $category->id) }}"
                                class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admins.main-categories.destroy', $category->id) }}"
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
                        <td colspan="5" class="text-center">{{ __('No categories found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>


