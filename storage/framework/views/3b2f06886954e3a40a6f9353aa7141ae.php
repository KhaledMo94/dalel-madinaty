<?php if (isset($component)) { $__componentOriginal5be5918a4b8edd99a309dbd2815ca889 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5be5918a4b8edd99a309dbd2815ca889 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.main-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.main-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    ?>
    <div class="card-body">
        <form class="my-3" action="<?php echo e(route('admins.listings.update', $listing->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-4 shadow card t-left">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="p1_tab" data-toggle="pill" href="#p1"
                                    role="tab" aria-controls="p1" aria-selected="true"><?php echo e(__('Main Section')); ?>

                                </a>
                                <a class="nav-link" id="p2_tab" data-toggle="pill" href="#p2" role="tab"
                                    aria-controls="p2" aria-selected="false"><?php echo e(__('Amenities & Category')); ?>

                                </a>
                                <a class="nav-link" id="p3_tab" data-toggle="pill" href="#p3" role="tab"
                                    aria-controls="p3" aria-selected="false"><?php echo e(__('Files & Images')); ?>

                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- Tab 1 -->
                                <div class="tab-pane fade show active" id="p1" role="tabpanel"
                                    aria-labelledby="p1_tab">
                                    <h4 class="heading-in-tab"><?php echo e(__('Main Section')); ?></h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><?php echo e(__('Name In Arabic')); ?></label>
                                                <input type="text" name="name_ar" class="form-control"
                                                    value="<?php echo e(old('name_ar') ?? $listing->getTranslation('name', 'ar')); ?>"
                                                    autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><?php echo e(__('Name In English')); ?></label>
                                                <input type="text" name="name_en" class="form-control"
                                                    value="<?php echo e(old('name_en') ?? $listing->getTranslation('name', 'en')); ?>"
                                                    autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Description In Arabic')); ?></label>
                                        <textarea name="description_ar" class="form-control" cols="30" rows="10"><?php echo e(old('description_ar') ?? $listing->getTranslation('description', 'ar')); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Description In English')); ?></label>
                                        <textarea name="description_en" class="form-control" cols="30" rows="10"><?php echo e(old('description_en') ?? $listing->getTranslation('description', 'en')); ?></textarea>
                                    </div>
                                    
                                                                        <div class="form-group">
                                        <label for=""><?php echo e(__('Facebook')); ?></label>
                                        <input type="text" name="fb_link" class="form-control"
                                                value="<?php echo e(old('fb_link') ?? $listing->fb_link); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Tik Tok')); ?></label>
                                                <input type="text" name="tt_link" class="form-control"
                                                    value="<?php echo e(old('tt_link') ?? $listing->tt_link); ?>" >
                                            </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Instagram')); ?></label>
                                        <input type="text" name="insta_link" class="form-control"
                                            value="<?php echo e(old('insta_link') ?? $listing->insta_link); ?>">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="latitude"><?php echo e(__('Latitude')); ?></label>
                                                <input type="text" name="latitude" id="latitude" class="form-control"
                                                    value="<?php echo e(old('latitude') ?? $listing->latitude); ?>" placeholder="e.g., 30.0444">
                                                <small class="form-text text-muted"><?php echo e(__('Optional')); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="longitude"><?php echo e(__('Longitude')); ?></label>
                                                <input type="text" name="longitude" id="longitude" class="form-control"
                                                    value="<?php echo e(old('longitude') ?? $listing->longitude); ?>" placeholder="e.g., 31.2357">
                                                <small class="form-text text-muted"><?php echo e(__('Optional')); ?></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?></label>
                                        <select name="status" id="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                            <option value="active" <?php if((old('status') ?? $listing->status) == 'active'): echo 'selected'; endif; ?>><?php echo e(__('Active')); ?></option>
                                            <option value="inactive" <?php if((old('status') ?? $listing->status) == 'inactive'): echo 'selected'; endif; ?>><?php echo e(__('Inactive')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>
                                <!-- // Tab 1 -->
                                <!-- Tab 2 -->
                                <div class="tab-pane fade" id="p2" role="tabpanel" aria-labelledby="p2_tab">
                                    <h4 class="heading-in-tab"><?php echo e(__('Category & Amenities')); ?></h4>
                                    <div class="form-group" wire:ignore>
                                        <h5 class="font-bold text-gray-700"><?php echo e(__('Category')); ?></h5>
                                        <select name="category_id" id="select_category" class="form-control">
                                            <option selected value="<?php echo e($listing->category_id); ?>">
                                                <?php echo e($listing->category?->getTranslation('name', app()->getLocale())); ?>

                                            </option>
                                        </select>
                                    </div>
                                    <div class="mt-4" id="amenities_section">
                                        <h5 class="font-bold text-gray-700"><?php echo e(__('Amenities')); ?></h5>
                                        <select name="amenities_ids[]" id="select_amenities" class="form-control" multiple>
                                            <?php $__currentLoopData = $listing->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option selected value="<?php echo e($amenity->id); ?>">
                                                    <?php echo e($amenity->getTranslation('name', app()->getLocale())); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mt-4" style="display:none" id="options_section">
                                        <h5 class="font-bold text-gray-700 mb-3"><?php echo e(__('Attributes / Options')); ?></h5>
                                        <div id="category_options_container">
                                            <!-- Option fields will be dynamically added here -->
                                        </div>
                                    </div>
                                </div>
                                <!--// Tab 2 -->
                                <!-- Tab 3 -->
                                <div class="tab-pane fade" id="p3" role="tabpanel" aria-labelledby="p3_tab">
                                    <h4 class="heading-in-tab"><?php echo e(__('Files & Images')); ?></h4>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Existing Image')); ?></label>
                                        <div>
                                            <?php if($listing->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $listing->image)); ?>"
                                                    class="w_200" alt="">
                                            <?php else: ?>
                                                <p><?php echo e(__('No Image')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Featured Photo')); ?></label>
                                        <div>
                                            <input type="file" name="image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Existing Banner Image')); ?></label>
                                        <div>
                                            <?php if($listing->banner_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $listing->banner_image)); ?>" class="w_200"
                                                    alt="">
                                            <?php else: ?>
                                                <p><?php echo e(__('No Image')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Banner Photo')); ?></label>
                                        <div>
                                            <input type="file" name="banner_image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Existing File')); ?></label>
                                        <div>
                                            <?php if($listing->file): ?>
                                                <a href="<?php echo e(asset('storage/' . $listing->file)); ?>" target="_blank"
                                                    class="btn btn-sm btn-primary"><?php echo e(__('View File')); ?></a>
                                            <?php else: ?>
                                                <p><?php echo e(__('No Image')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Additional File')); ?></label>
                                        <div>
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="images"><?php echo e(__('Listing Images')); ?></label>
                                        
                                        <?php if($listing->images->count() > 0): ?>
                                            <div class="existing-images-container mb-3">
                                                <h6><?php echo e(__('Existing Images')); ?></h6>
                                                <div class="row">
                                                    <?php $__currentLoopData = $listing->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-3 mb-3 existing-image-item" data-image-id="<?php echo e($image->id); ?>">
                                                            <div class="position-relative border rounded p-2">
                                                                <img src="<?php echo e(asset('storage/' . $image->image)); ?>" 
                                                                     alt="Listing Image" 
                                                                     class="img-fluid rounded"
                                                                     style="max-height: 150px; width: 100%; object-fit: cover;">
                                                                <input type="hidden" name="existing_images_ids[]" value="<?php echo e($image->id); ?>" class="existing-image-input">
                                                                <button type="button" class="btn btn-sm btn-danger position-absolute remove-existing-image" 
                                                                        style="top: 5px; right: 5px;"
                                                                        data-image-id="<?php echo e($image->id); ?>">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="new-images-container">
                                            <h6><?php echo e(__('Add New Images')); ?></h6>
                                            <div id="image-upload-container">
                                                <div class="image-upload-item border p-3 mb-2 rounded">
                                                    <input type="file" name="images[]" class="image-input form-control-file" accept="image/*">
                                                    <button type="button" class="btn btn-sm btn-danger remove-image-btn mt-2" style="display: none;">
                                                        <i class="fas fa-times"></i> <?php echo e(__('Remove')); ?>

                                                    </button>
                                                    <div class="image-preview mt-2" style="display: none;">
                                                        <img src="" alt="Preview" style="max-width: 150px; max-height: 150px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-images">
                                                <i class="fas fa-plus"></i> <?php echo e(__('Add Another Image')); ?>

                                            </button>
                                            <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <small class="form-text text-muted"><?php echo e(__('You can add multiple images one at a time')); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <!-- // Tab 3 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Update')); ?></button>
        </form>

    </div>
    <script>
        $(document).ready(function() {

            // ---------- CATEGORY SELECT2 ----------
            $('#select_category').select2({
                placeholder: "<?php echo e(__('Search for a Category')); ?>",
                width: '100%',
                ajax: {
                    url: "<?php echo e(route('admins.categories.search')); ?>",
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
            
            // Load options for existing category on page load
            var initialCategoryId = $('#select_category').val();
            if(initialCategoryId) {
                fetchAmenitiesByCategory(initialCategoryId);
                fetchCategoryOptions(initialCategoryId);
            }

            // ---------- FETCH AMENITIES ----------
            function fetchAmenitiesByCategory(category_id) {
                $('#select_amenities').select2({
                    placeholder: "<?php echo e(__('Search for Amenities')); ?>",
                    ajax: {
                        url: "<?php echo e(route('admins.amenities.search')); ?>",
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
                    url: "<?php echo e(route('admins.listings.category-options')); ?>",
                    method: 'GET',
                    data: { category_id: categoryId },
                    success: function(options) {
                        var container = $('#category_options_container');
                        container.empty();
                        
                        if (options.length > 0) {
                            $('#options_section').css('display', 'block');
                            
                            // Get existing option values for this listing
                            var existingOptionValueIds = <?php echo json_encode($listing->optionValues->pluck('id')->toArray(), 15, 512) ?>;
                            
                            options.forEach(function(option) {
                                var optionHtml = '<div class="form-group mb-3">';
                                optionHtml += '<label class="font-weight-bold">' + option.name + '</label>';
                                optionHtml += '<select name="option_value_ids[]" class="form-control option-value-select" data-option-id="' + option.id + '" multiple>';
                                
                                option.values.forEach(function(value) {
                                    var selected = existingOptionValueIds.includes(value.id) ? 'selected' : '';
                                    optionHtml += '<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>';
                                });
                                
                                optionHtml += '</select>';
                                optionHtml += '</div>';
                                
                                container.append(optionHtml);
                            });
                            
                            // Initialize select2 for option values
                            $('.option-value-select').select2({
                                placeholder: "<?php echo e(__('Select values')); ?>",
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

            // ---------- LISTING IMAGES MANAGEMENT ----------
            // Remove existing image
            $(document).on('click', '.remove-existing-image', function() {
                var imageItem = $(this).closest('.existing-image-item');
                var imageId = $(this).data('image-id');
                
                // Remove the hidden input so it won't be included in form submission
                imageItem.find('.existing-image-input').remove();
                // Hide the image item with animation
                imageItem.fadeOut(300, function() {
                    $(this).remove();
                });
            });

            // Multiple image upload functionality
            var imageUploadItemTemplate = `
                <div class="image-upload-item border p-3 mb-2 rounded">
                    <input type="file" name="images[]" class="image-input form-control-file" accept="image/*">
                    <button type="button" class="btn btn-sm btn-danger remove-image-btn mt-2" style="display: none;">
                        <i class="fas fa-times"></i> <?php echo e(__('Remove')); ?>

                    </button>
                    <div class="image-preview mt-2" style="display: none;">
                        <img src="" alt="Preview" style="max-width: 150px; max-height: 150px;">
                    </div>
                </div>
            `;

            $('#add-more-images').on('click', function() {
                $('#image-upload-container').append(imageUploadItemTemplate);
            });

            $('#image-upload-container').on('change', '.image-input', function() {
                var input = this;
                var previewContainer = $(this).siblings('.image-preview');
                var removeButton = $(this).siblings('.remove-image-btn');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.find('img').attr('src', e.target.result);
                        previewContainer.show();
                        removeButton.show();
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    previewContainer.hide();
                    removeButton.hide();
                    previewContainer.find('img').attr('src', '');
                }
            });

            $('#image-upload-container').on('click', '.remove-image-btn', function() {
                $(this).closest('.image-upload-item').remove();
                // If all image inputs are removed, add one empty input back
                if ($('#image-upload-container .image-upload-item').length === 0) {
                    $('#image-upload-container').append(imageUploadItemTemplate);
                }
            });
        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5be5918a4b8edd99a309dbd2815ca889)): ?>
<?php $attributes = $__attributesOriginal5be5918a4b8edd99a309dbd2815ca889; ?>
<?php unset($__attributesOriginal5be5918a4b8edd99a309dbd2815ca889); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5be5918a4b8edd99a309dbd2815ca889)): ?>
<?php $component = $__componentOriginal5be5918a4b8edd99a309dbd2815ca889; ?>
<?php unset($__componentOriginal5be5918a4b8edd99a309dbd2815ca889); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/listings/edit.blade.php ENDPATH**/ ?>