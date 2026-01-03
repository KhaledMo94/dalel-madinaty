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

    <div class="card-body">
        <form class="my-3" action="<?php echo e(route('admins.amenities.update', $amenity->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="name_ar"><?php echo e(__('Name In Arabic')); ?></label>
                <input type="text" name="name_ar" class="form-control" id="name_ar"
                    placeholder="<?php echo e(__('Name In Arabic')); ?>" required
                    value="<?php echo e(old('name_ar') ?? $amenity->getTranslation('name', 'ar')); ?>">
            </div>

            <div class="form-group">
                <label for="name_en"><?php echo e(__('Name In English')); ?></label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="<?php echo e(__('Name In English')); ?>" required
                    value="<?php echo e(old('name_en') ?? $amenity->getTranslation('name', 'en')); ?>">
            </div>
            <div class="form-group">
                <label for="description_ar"><?php echo e(__('Description In Arabic')); ?></label>
                <textarea name="description_ar" class="form-control" id="description_ar" rows="3"
                    placeholder="<?php echo e(__('Description In Arabic')); ?>" ><?php echo e(old('description_ar') ?? $amenity->getTranslation('description', 'ar')); ?></textarea>
            </div>
            <div class="form-group">
                <label for="description_en"><?php echo e(__('Description In English')); ?></label>
                <textarea name="description_en" class="form-control" id="description_en" rows="3"
                    placeholder="<?php echo e(__('Description In English')); ?>" ><?php echo e(old('description_en') ?? $amenity->getTranslation('description', 'en')); ?></textarea>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Categories')); ?> <small class="text-muted">(<?php echo e(__('Optional')); ?>)</small></label>
                <select name="category_ids[]" class="form-control" id="category_ids" multiple>
                </select>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Existing Image')); ?></label>
                <div>
                    <?php if($amenity->image): ?>
                        <img src="<?php echo e(asset('storage/' . $amenity->image)); ?>" class="w_200" alt="">
                    <?php else: ?>
                        <p><?php echo e(__('No Image')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="for"><?php echo e(__('Image')); ?></label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="<?php echo e(__('Image')); ?>">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Update')); ?></button>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            var selectedCategoryIds = <?php echo json_encode($amenity->categories->pluck('id')->toArray()); ?>;
            var selectedCategoryNames = <?php echo json_encode($amenity->categories->mapWithKeys(function($cat) {
                return [$cat->id => $cat->getTranslation('name', app()->getLocale())];
            })); ?>;

            $('#category_ids').select2({
                placeholder: "<?php echo e(__('Search for a Category')); ?>",
                allowClear: true,
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/amenities/edit.blade.php ENDPATH**/ ?>