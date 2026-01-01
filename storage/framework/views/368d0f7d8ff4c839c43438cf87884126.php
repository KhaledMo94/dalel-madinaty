<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-6">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="<?php echo e(__('Search by name...')); ?>">
        </div>
        <div class="col-md-3">
            <select wire:model.live="optionFilter" class="form-control">
                <option value="all"><?php echo e(__('All Options')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->options ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($option->id); ?>"><?php echo e($option->getTranslation('name', app()->getLocale())); ?></option>
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
                    <th><?php echo e(__('Option')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($optionValues->currentPage() - 1) * $optionValues->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $optionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($optionValue->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td><?php echo e($optionValue->name ?? ''); ?> <br>
                            <?php echo e($optionValue->getTranslation('name', $rev_locale)); ?></td>
                        <td><?php echo e($optionValue->option->name ?? ''); ?> <br>
                            <?php echo e($optionValue->option->getTranslation('name', $rev_locale) ?? ''); ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo e(route('admins.option-values.edit', $optionValue->id)); ?>"
                                    class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-<?php echo e($optionValue->id); ?>"
                                    action="<?php echo e(route('admins.option-values.destroy', $optionValue->id)); ?>" method="POST"
                                    style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($optionValue->id); ?>); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center"><?php echo e(__('No option values found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($optionValues->links()); ?>

    </div>
</div>

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/option-values-index.blade.php ENDPATH**/ ?>