<x-dashboard.main-layout>
    @php
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    @endphp
    <div class="card-body">
        <form class="my-3" action="{{ route('admins.listings.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4 shadow card t-left">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="p1_tab" data-toggle="pill" href="#p1"
                                    role="tab" aria-controls="p1" aria-selected="true">{{ __('Main Section') }}
                                </a>
                                <a class="nav-link" id="p2_tab" data-toggle="pill" href="#p2" role="tab"
                                    aria-controls="p2" aria-selected="false">{{ __('Amenities, Category & Options') }}
                                </a>
                                <a class="nav-link" id="p3_tab" data-toggle="pill" href="#p3" role="tab"
                                    aria-controls="p3" aria-selected="false">{{ __('Files & Images') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- Tab 1 -->
                                <div class="tab-pane fade show active" id="p1" role="tabpanel"
                                    aria-labelledby="p1_tab">
                                    <h4 class="heading-in-tab">{{ __('Main Section') }}</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('Name In Arabic') }}</label>
                                                <input type="text" name="name_ar"
                                                    class="form-control @error('name_ar') is-invalid @enderror"
                                                    value="{{ old('name_ar') }}" autofocus>
                                                @error('name_ar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{ __('Name In English') }}</label>
                                                <input type="text" name="name_en"
                                                    class="form-control @error('name_en') is-invalid @enderror"
                                                    value="{{ old('name_en') }}" autofocus>
                                                @error('name_en')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Description In Arabic') }}</label>
                                        <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" cols="30"
                                            rows="10">{{ old('description_ar') }}</textarea>
                                        @error('description_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{ __('Description In English') }}</label>
                                        <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" cols="30"
                                            rows="10">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fb_link">{{ __('Facebook') }}</label>
                                        <input type="text" name="fb_link" id="fb_link" class="form-control social-link-input"
                                            value="{{ old('fb_link') }}" placeholder="https://www.facebook.com/yourpage">
                                        <div class="invalid-feedback d-none" id="fb_link_error"></div>
                                        <small class="form-text text-muted">{{ __('Optional') }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tt_link">{{ __('Tik Tok') }}</label>
                                        <input type="text" name="tt_link" id="tt_link" class="form-control social-link-input"
                                            value="{{ old('tt_link') }}" placeholder="https://www.tiktok.com/@yourprofile">
                                        <div class="invalid-feedback d-none" id="tt_link_error"></div>
                                        <small class="form-text text-muted">{{ __('Optional') }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="insta_link">{{ __('Instagram') }}</label>
                                        <input type="text" name="insta_link" id="insta_link" class="form-control social-link-input"
                                            value="{{ old('insta_link') }}" placeholder="https://www.instagram.com/yourprofile">
                                        <div class="invalid-feedback d-none" id="insta_link_error"></div>
                                        <small class="form-text text-muted">{{ __('Optional') }}</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="latitude">{{ __('Latitude') }}</label>
                                                <input type="text" name="latitude" id="latitude"
                                                    class="form-control" value="{{ old('latitude') }}"
                                                    placeholder="e.g., 30.0444">
                                                <small class="form-text text-muted">{{ __('Optional') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                                                        <div class="form-group">
                                                <label for="longitude">{{ __('Longitude') }}</label>
                                                <input type="text" name="longitude" id="longitude"
                                                    class="form-control" value="{{ old('longitude') }}"
                                                    placeholder="e.g., 31.2357">
                                                <small class="form-text text-muted">{{ __('Optional') }}</small>
                                            </div>
                                        </div>
                                            </div>

                                    <div class="form-group">
                                        <label for="status">{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="active" @selected(old('status', 'active') == 'active')>{{ __('Active') }}</option>
                                            <option value="inactive" @selected(old('status') == 'inactive')>{{ __('Inactive') }}</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <!-- // Tab 1 -->
                                <!-- Tab 2 -->
                                <div class="tab-pane fade" id="p2" role="tabpanel" aria-labelledby="p2_tab">
                                    <h4 class="heading-in-tab">{{ __('Category & Amenities') }}</h4>
                                    <div class="form-group" wire:ignore>
                                        <h5 class="font-bold text-gray-700">{{ __('Category') }}</h5>
                                        <select name="category_id" id="select_category"
                                            class="form-control @error('category_id') is-invalid @enderror">
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-4" style="display:none" id="amenities_section">
                                        <h5 class="font-bold text-gray-700">{{ __('Amenities') }}</h5>
                                        <select name="amenities_ids[]" id="select_amenities" class="form-control">
                                        </select>
                                    </div>
                                    <div class="mt-4" style="display:none" id="options_section">
                                        <h5 class="font-bold text-gray-700 mb-3">{{ __('Attributes / Options') }}</h5>
                                        <div id="category_options_container">
                                            <!-- Option fields will be dynamically added here -->
                                        </div>
                                    </div>
                                </div>
                                <!--// Tab 2 -->
                                <!-- Tab 3 -->
                                <div class="tab-pane fade" id="p3" role="tabpanel" aria-labelledby="p3_tab">
                                    <h4 class="heading-in-tab">{{ __('Files & Images') }}</h4>
                                    <div class="form-group">
                                        <label for="">{{ __('Featured Photo') }}</label>
                                        <div>
                                            <input type="file" name="image" accept="image/*"
                                                class="@error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('Banner Photo') }}</label>
                                        <div>
                                            <input type="file" name="banner_image" accept="image/*"
                                                class="@error('banner_image') is-invalid @enderror">
                                            @error('banner_image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="images">{{ __('Additional Images') }}</label>
                                        <div class="multiple-images-container">
                                            <div class="image-upload-item">
                                                <input type="file" name="images[]" class="image-input"
                                                    accept="image/*">
                                                <button type="button" class="btn btn-sm btn-danger remove-image-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-times"></i> {{ __('Remove') }}
                                                </button>
                                                <div class="image-preview" style="display: none;">
                                                    <img src="" alt="Preview"
                                                        style="max-width: 150px; max-height: 150px; margin-top: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-secondary mt-2"
                                            id="add-more-images">
                                            <i class="fas fa-plus"></i> {{ __('Add Another Image') }}
                                        </button>
                                        @error('images.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small
                                            class="form-text text-muted">{{ __('You can add multiple images one at a time') }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ __('Additional File') }}</label>
                                        <div>
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                </div>
                                <!-- // Tab 3 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Create') }}</button>
        </form>

    </div>
    <script>
        $(document).ready(function() {

            // ---------- SOCIAL MEDIA LINK VALIDATION ----------
            // Regex patterns for social media links
            const socialPatterns = {
                facebook: /^(https?:\/\/)?(www\.)?(facebook\.com|fb\.com)\/.+/i,
                instagram: /^(https?:\/\/)?(www\.)?instagram\.com\/.+/i,
                tiktok: /^(https?:\/\/)?(www\.|vm\.)?tiktok\.com\/.+/i
            };

            function validateSocialLink(input, pattern, errorElementId, platformName) {
                const value = input.val().trim();
                const inputGroup = input.closest('.form-group');
                const errorElement = $('#' + errorElementId);

                // Remove previous validation classes
                input.removeClass('is-valid is-invalid');
                errorElement.addClass('d-none').removeClass('d-block');

                // If empty, it's valid (nullable)
                if (value === '') {
                    return true;
                }

                // Check if URL matches pattern
                if (pattern.test(value)) {
                    input.addClass('is-valid');
                    errorElement.addClass('d-none').removeClass('d-block');
                    return true;
                } else {
                    input.addClass('is-invalid');
                    errorElement.text('{{ __("Please enter a valid") }} ' + platformName + ' {{ __("URL") }}')
                        .removeClass('d-none').addClass('d-block');
                    return false;
                }
            }

            // Facebook link validation
            $('#fb_link').on('input blur', function() {
                validateSocialLink(
                    $(this),
                    socialPatterns.facebook,
                    'fb_link_error',
                    'Facebook'
                );
            });

            // Instagram link validation
            $('#insta_link').on('input blur', function() {
                validateSocialLink(
                    $(this),
                    socialPatterns.instagram,
                    'insta_link_error',
                    'Instagram'
                );
            });

            // TikTok link validation
            $('#tt_link').on('input blur', function() {
                validateSocialLink(
                    $(this),
                    socialPatterns.tiktok,
                    'tt_link_error',
                    'TikTok'
                );
            });

            // Validate on page load if there are old values
            @if(old('fb_link'))
                validateSocialLink($('#fb_link'), socialPatterns.facebook, 'fb_link_error', 'Facebook');
            @endif
            @if(old('insta_link'))
                validateSocialLink($('#insta_link'), socialPatterns.instagram, 'insta_link_error', 'Instagram');
            @endif
            @if(old('tt_link'))
                validateSocialLink($('#tt_link'), socialPatterns.tiktok, 'tt_link_error', 'TikTok');
            @endif

            // ---------- CATEGORY SELECT2 ----------
            $('#select_category').select2({
                placeholder: "{{ __('Search for a Category') }}",
                width: '100%',
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
                }
            });

            // When category is selected
            $('#select_category').on('select2:select', function(e) {
                var categoryId = e.params.data.id;

                // Show amenities section
                $('#amenities_section').css('display', 'block');

                // Reset amenities select
                if ($('#select_amenities').hasClass("select2-hidden-accessible")) {
                    $('#select_amenities').val(null).trigger('change');
                    $('#select_amenities').select2('destroy');
                }

                // Fetch amenities for this category
                fetchAmenitiesByCategory(categoryId);

                // Fetch and display options for this category
                fetchCategoryOptions(categoryId);
            });

            // Clear options when category is cleared
            $('#select_category').on('select2:clear', function() {
                $('#options_section').css('display', 'none');
                $('#category_options_container').empty();
            });

            // ---------- FETCH AMENITIES ----------
            function fetchAmenitiesByCategory(category_id) {
                $('#select_amenities').select2({
                    placeholder: "{{ __('Search for Amenities') }}",
                    ajax: {
                        url: "{{ route('admins.amenities.search') }}",
                        dataType: 'json',
                        delay: 500,
                        data: function(params) {
                            return {
                                q: params.term,
                                categoryId: category_id
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(amenity => ({
                                    id: amenity.id,
                                    text: amenity.name
                                }))
                            };
                        },
                        cache: true
                    },
                    width: '100%',
                    multiple: true,
                });
            }

            // ---------- FETCH CATEGORY OPTIONS ----------
            function fetchCategoryOptions(categoryId) {
                $.ajax({
                    url: "{{ route('admins.listings.category-options') }}",
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(options) {
                        var container = $('#category_options_container');
                        container.empty();

                        if (options.length > 0) {
                            $('#options_section').css('display', 'block');

                            options.forEach(function(option) {
                                var optionHtml = '<div class="form-group mb-3">';
                                optionHtml += '<label class="font-weight-bold">' + option.name +
                                    '</label>';
                                optionHtml +=
                                    '<select name="option_value_ids[]" class="form-control option-value-select" data-option-id="' +
                                    option.id + '" multiple>';

                                option.values.forEach(function(value) {
                                    optionHtml += '<option value="' + value.id + '">' +
                                        value.name + '</option>';
                                });

                                optionHtml += '</select>';
                                optionHtml += '</div>';

                                container.append(optionHtml);
                            });

                            // Initialize select2 for option values
                            $('.option-value-select').select2({
                                placeholder: "{{ __('Select values') }}",
                                width: '100%',
                                allowClear: true,
                                multiple: true
                            });
                        } else {
                            $('#options_section').css('display', 'none');
                        }
                    },
                    error: function() {
                        $('#options_section').css('display', 'none');
                    }
                });
            }

            // ---------- MULTIPLE IMAGES HANDLING ----------
            function addImageInput() {
                var container = $('.multiple-images-container');
                var newItem = $('<div class="image-upload-item mt-2"></div>');
                newItem.html(`
                    <input type="file" name="images[]" class="image-input" accept="image/*">
                    <button type="button" class="btn btn-sm btn-danger remove-image-btn" style="display: none;">
                        <i class="fas fa-times"></i> {{ __('Remove') }}
                    </button>
                    <div class="image-preview" style="display: none;">
                        <img src="" alt="Preview" style="max-width: 150px; max-height: 150px; margin-top: 10px;">
                    </div>
                `);
                container.append(newItem);

                // Attach event handler to new input
                newItem.find('.image-input').on('change', function() {
                    handleImagePreview($(this));
                });

                // Attach remove handler
                newItem.find('.remove-image-btn').on('click', function() {
                    $(this).closest('.image-upload-item').remove();
                });
            }

            function handleImagePreview(input) {
                var item = input.closest('.image-upload-item');
                var file = input[0].files[0];
                var preview = item.find('.image-preview');
                var removeBtn = item.find('.remove-image-btn');

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        preview.find('img').attr('src', e.target.result);
                        preview.show();
                        removeBtn.show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.hide();
                    removeBtn.hide();
                }
            }

            // Handle existing image inputs
            $(document).on('change', '.image-input', function() {
                handleImagePreview($(this));
            });

            // Handle remove button
            $(document).on('click', '.remove-image-btn', function() {
                $(this).closest('.image-upload-item').remove();
            });

            // Add more images button
            $('#add-more-images').on('click', function() {
                addImageInput();
            });
        });
    </script>

    <style>
        .multiple-images-container .image-upload-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .multiple-images-container .image-input {
            margin-bottom: 5px;
        }
    </style>

</x-dashboard.main-layout>
