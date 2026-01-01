<x-dashboard.main-layout>

    @php
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    @endphp
    <div class="card-body" data-aos="fade-up">
        <form class="my-3" action="{{ route('admins.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="">{{ __('Category Name In Arabic') }}</label>
                <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            </div>

            <div class="form-group">
                <label for="">{{ __('Category Name In English') }}</label>
                <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
            </div>

            <div class="form-group">
                <label for="">{{ __('Description In Arabic') }}</label>
                <textarea name="description_ar" class="form-control">{{ old('description_ar') }}</textarea>
            </div>

            <div class="form-group">
                <label for="">{{ __('Description In English') }}</label>
                <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="">{{ __('Parent Category') }}</label>
                    <select name="parent_id" class="select2" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == old('parent_id'))>
                                {{ $category->getTranslation('name', app()->getLocale()) }} -
                                {{ $category->getTranslation('name', $rev_locale) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="">{{ __('Options') }}</label>
                <select name="option_ids[]" class="form-control" id="option_ids" multiple>
                </select>
            </div>

            <div class="form-group">
                <label for="">{{ __('Status') }}</label>
                <select name="status" class="form-control">
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        {{ __('Active') }}</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="">{{ __('Change Photo') }}</label>
                <div>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#option_ids').select2({
                placeholder: "{{ __('Search for Options') }}",
                width: '100%',
                ajax: {
                    url: "{{ route('admins.options.search') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(option => ({
                                id: option.id,
                                text: option.name
                            }))
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

</x-dashboard.main-layout>
