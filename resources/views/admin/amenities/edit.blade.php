<x-dashboard.main-layout>

    <div class="card-body">
        <form class="my-3" action="{{ route('admins.amenities.update', $amenity->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name_ar">{{ __('Name In Arabic') }}</label>
                <input type="text" name="name_ar" class="form-control" id="name_ar"
                    placeholder="{{ __('Name In Arabic') }}" required
                    value="{{ old('name_ar') ?? $amenity->getTranslation('name', 'ar') }}">
            </div>

            <div class="form-group">
                <label for="name_en">{{ __('Name In English') }}</label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="{{ __('Name In English') }}" required
                    value="{{ old('name_en') ?? $amenity->getTranslation('name', 'en') }}">
            </div>
            <div class="form-group">
                <label for="description_ar">{{ __('Description In Arabic') }}</label>
                <textarea name="description_ar" class="form-control" id="description_ar" rows="3"
                    placeholder="{{ __('Description In Arabic') }}" >{{ old('description_ar') ?? $amenity->getTranslation('description', 'ar') }}</textarea>
            </div>
            <div class="form-group">
                <label for="description_en">{{ __('Description In English') }}</label>
                <textarea name="description_en" class="form-control" id="description_en" rows="3"
                    placeholder="{{ __('Description In English') }}" >{{ old('description_en') ?? $amenity->getTranslation('description', 'en') }}</textarea>
            </div>

            <div class="form-group">
                <label for="">{{ __('Categories') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                <select name="category_ids[]" class="form-control" id="category_ids" multiple>
                </select>
            </div>

            <div class="form-group">
                <label for="">{{ __('Existing Image') }}</label>
                <div>
                    @if ($amenity->image)
                        <img src="{{ asset('storage/' . $amenity->image) }}" class="w_200" alt="">
                    @else
                        <p>{{ __('No Image') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="for">{{ __('Image') }}</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="{{ __('Image') }}">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Update') }}</button>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            var selectedCategoryIds = {!! json_encode($amenity->categories->pluck('id')->toArray()) !!};
            var selectedCategoryNames = {!! json_encode($amenity->categories->mapWithKeys(function($cat) {
                return [$cat->id => $cat->getTranslation('name', app()->getLocale())];
            })) !!};

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

            // Pre-select existing categories
            if (selectedCategoryIds.length > 0) {
                selectedCategoryIds.forEach(function(categoryId) {
                    var categoryName = selectedCategoryNames[categoryId] || '';
                    var option = new Option(categoryName, categoryId, true, true);
                    $('#category_ids').append(option);
                });
                $('#category_ids').trigger('change');
            }
        });
    </script>

</x-dashboard.main-layout>
