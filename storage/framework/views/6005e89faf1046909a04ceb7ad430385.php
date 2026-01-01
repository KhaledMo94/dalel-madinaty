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

    <div class="card-body" data-aos="fade-up">
        <form class="my-3" action="<?php echo e(route('admins.main-categories.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for=""><?php echo e(__('Category Name In Arabic')); ?></label>
                <input type="text" name="name_ar" class="form-control" value="<?php echo e(old('name_ar')); ?>">
            </div>
            
            <div class="form-group">
                <label for=""><?php echo e(__('Category Name In English')); ?></label>
                <input type="text" name="name_en" class="form-control" value="<?php echo e(old('name_en')); ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Description In Arabic')); ?></label>
                <textarea name="description_ar" class="form-control"><?php echo e(old('description_ar')); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for=""><?php echo e(__('Description In English')); ?></label>
                <textarea name="description_en" class="form-control"><?php echo e(old('description_en')); ?></textarea>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-control">
                    <option value="active" <?php echo e(old('status', 'active') == 'active' ? 'selected' : ''); ?>><?php echo e(__('Active')); ?></option>
                    <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>><?php echo e(__('Inactive')); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Change Photo')); ?></label>
                <div>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>

            <button type="submit" class="btn btn-success"><?php echo e(__('Create')); ?></button>
        </form>
    </div>

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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/main-categories/create.blade.php ENDPATH**/ ?>