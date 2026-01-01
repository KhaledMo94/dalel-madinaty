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
        <form class="my-3" action="<?php echo e(route('admins.areas.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name_ar"><?php echo e(__('Name In Arabic')); ?></label>
                <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="<?php echo e(__('Name')); ?>"
                    required value="<?php echo e(old('name_ar')); ?>">
            </div>

            <div class="form-group">
                <label for="name_en"><?php echo e(__('Name In English')); ?></label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="<?php echo e(__('Name')); ?>" required value="<?php echo e(old('name_en')); ?>">
            </div>

            <div class="form-group">
                <label for="description_ar"><?php echo e(__('Description In Arabic')); ?></label>
                <textarea name="description_ar" class="form-control" id="description_ar" placeholder="<?php echo e(__('Description in Arabic')); ?>"><?php echo e(old('description_ar')); ?></textarea>
            </div>

            <div class="form-group">
                <label for="description_en"><?php echo e(__('Description In English')); ?></label>
                <textarea name="description_en" class="form-control" id="description_en" placeholder="<?php echo e(__('Description in English')); ?>"><?php echo e(old('description_en')); ?></textarea>
            </div>

            <div class="form-group">
                <label for="city_id"><?php echo e(__('City')); ?></label>
                <select name="city_id" class="form-control" id="city_id" required>
                    <option value=""><?php echo e(__('Select City')); ?></option>
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city->id); ?>" <?php echo e(old('city_id') == $city->id ? 'selected' : ''); ?>>
                            <?php echo e($city->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div> 

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Create')); ?></button>
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

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/areas/create.blade.php ENDPATH**/ ?>