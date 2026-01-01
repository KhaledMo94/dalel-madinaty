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
        <form class="my-3" action="<?php echo e(route('admins.notifications.user')); ?>" method="post"
            enctype="application/x-www-form-urlencoded">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="title"><?php echo e(__('Title')); ?></label>
                <input type="text" name="title" class="form-control" id="title" placeholder="<?php echo e(__('title')); ?>"
                    required value="<?php echo e(old('title')); ?>">
            </div>

            <div class="form-group">
                <label for="description"><?php echo e(__('Description')); ?></label>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="<?php echo e(__('Description')); ?>"
                    required><?php echo e(old('description')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Send')); ?></button>
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
<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/admin/notifications/notify-users.blade.php ENDPATH**/ ?>