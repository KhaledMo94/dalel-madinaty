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
    <div class="card-body" data-aos="fade-up">
        <form class="my-3" action="<?php echo e(route('admins.categories.update', $category->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for=""><?php echo e(__('Category Name In Arabic')); ?></label>
                <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar') ?? $category->getTranslation('name','ar')); ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Category Name In English')); ?></label>
                <input type="text" name="name_en" class="form-control" value="<?php echo e(old('name_en') ?? $category->getTranslation('name','en')); ?>">
            </div>

            <div class="form-group">
                
                    <div class="form-group">
                        <label for=""><?php echo e(__('Parent Category')); ?></label>
                        <select name="parent_id" class="form-control">
                            <option value=""><?php echo e(__('No Parent')); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoryi->id); ?>" <?php if($categoryi->id == (old('parent_id') ?? $category->main_category_id)): echo 'selected'; endif; ?>>
                                    <?php echo e($categoryi->name); ?> - <?php echo e($categoryi->getTranslation('name',$rev_locale)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Options')); ?></label>
                <select name="option_ids[]" class="form-control" id="option_ids" multiple>
                    <?php $__currentLoopData = $category->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option->id); ?>" selected><?php echo e($option->getTranslation('name', app()->getLocale())); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Description In Arabic')); ?></label>
                <textarea name="description_ar" class="form-control"><?php echo e(old('description_ar') ?? $category->getTranslation('description','ar')); ?></textarea>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Description In English')); ?></label>
                <textarea name="description_en" class="form-control"><?php echo e(old('description_en') ?? $category->getTranslation('description','en')); ?></textarea>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-control">
                    <option value="active" <?php echo e(old('status', $category->status) == 'active' ? 'selected' : ''); ?>><?php echo e(__('Active')); ?></option>
                    <option value="inactive" <?php echo e(old('status', $category->status) == 'inactive' ? 'selected' : ''); ?>><?php echo e(__('Inactive')); ?></option>
                </select>
            </div>
            
            <div class="form-group">
                <label for=""><?php echo e(__('Existing Image')); ?></label>
                <div>
                    <?php if($category->image): ?>
                        <img src="<?php echo e(asset('storage/' . $category->image)); ?>" class="w_200" alt="">
                    <?php else: ?>
                        <p><?php echo e(__('No Image')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Change Photo')); ?></label>
                <div>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <button type="submit" class="btn btn-success"><?php echo e(__('Update')); ?></button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#option_ids').select2({
                placeholder: "<?php echo e(__('Search for Options')); ?>",
                width: '100%',
                ajax: {
                    url: "<?php echo e(route('admins.options.search')); ?>",
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>