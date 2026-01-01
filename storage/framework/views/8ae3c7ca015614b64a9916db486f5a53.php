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
        <form class="my-3" action="<?php echo e(route('admins.option-values.update', $optionValue->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="option_id"><?php echo e(__('Option')); ?></label>
                <select name="option_id" class="form-control" id="option_id" required>
                    <option value=""><?php echo e(__('Select Option')); ?></option>
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option->id); ?>" <?php echo e(old('option_id', $optionValue->option_id) == $option->id ? 'selected' : ''); ?>>
                            <?php echo e($option->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name_ar"><?php echo e(__('Name In Arabic')); ?></label>
                <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="<?php echo e(__('Name')); ?>"
                    required value="<?php echo e(old('name_ar', $optionValue->getTranslation('name', 'ar'))); ?>">
            </div>

            <div class="form-group">
                <label for="name_en"><?php echo e(__('Name In English')); ?></label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="<?php echo e(__('Name')); ?>" required
                    value="<?php echo e(old('name_en', $optionValue->getTranslation('name', 'en'))); ?>">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Update')); ?></button>
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

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/option-values/edit.blade.php ENDPATH**/ ?>