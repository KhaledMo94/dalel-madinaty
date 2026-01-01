<x-dashboard.main-layout>

    <div class="card-body">
        <form class="my-3" action="{{ route('admins.amenities.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name_ar">{{ __('Name In Arabic') }}</label>
                <input type="text" name="name_ar" class="form-control" id="name_ar"
                    placeholder="{{ __('Name In Arabic') }}" required value="{{ old('name_ar') }}">
            </div>

            <div class="form-group">
                <label for="name_en">{{ __('Name In English') }}</label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="{{ __('Name In English') }}" required value="{{ old('name_en') }}">
            </div>

            <div class="form-group">
                <label for="description_ar">{{ __('Description In Arabic') }}</label>
                <textarea name="description_ar" class="form-control" id="description_ar" rows="3"
                    placeholder="{{ __('Description In Arabic') }}" >{{ old('description_ar') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_en">{{ __('Description In English') }}</label>
                <textarea name="description_en" class="form-control" id="description_en" rows="3"
                    placeholder="{{ __('Description In English') }}" >{{ old('description_en') }}</textarea>
            </div>

            <div class="form-group">
                <label for="">{{ __('Categories') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                <select name="category_ids[]" class="form-control" id="category_ids" multiple>
                </select>
            </div>

            <div class="form-group">
                <label for="image" class="for">{{ __('Image') }}</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="{{ __('Image') }}">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Create') }}</button>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#category_ids').select2({
                placeholder: "{{ __('Search for a Category') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('admins.categories.search') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(category => ({
                                id: category.id,
                                text: category.name
                            }))
                        };
                    },
                    cache: true
                },
                multiple: true
            });
        });
    </script>
</x-dashboard.main-layout>
