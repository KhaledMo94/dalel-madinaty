<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-6">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="<?php echo e(__('Search by name or description...')); ?>">
        </div>
        <div class="col-md-3">
            <select wire:model.live="cityFilter" class="form-control">
                <option value="all"><?php echo e(__('All Cities')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->cities ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->getTranslation('name', app()->getLocale())); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Name')); ?></th>
                    <th><?php echo e(__('City')); ?></th>
                    <th><?php echo e(__('Description')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($areas->currentPage() - 1) * $areas->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($area->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td><?php echo e($area->name ?? ''); ?> <br>
                            <?php echo e($area->getTranslation('name', $rev_locale)); ?></td>
                        <td><?php echo e($area->city->name ?? ''); ?> <br>
                            <?php echo e($area->city->getTranslation('name', $rev_locale) ?? ''); ?></td>
                        <td><?php echo e(strip_tags($area->description ?? '')); ?> <br>
                            <?php echo e(strip_tags($area->getTranslation('description', $rev_locale) ?? '')); ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo e(route('admins.areas.edit', $area->id)); ?>"
                                    class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-<?php echo e($area->id); ?>"
                                    action="<?php echo e(route('admins.areas.destroy', $area->id)); ?>" method="POST"
                                    style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($area->id); ?>); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center"><?php echo e(__('No areas found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($areas->links()); ?>

    </div>
</div>

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/areas-index.blade.php ENDPATH**/ ?>