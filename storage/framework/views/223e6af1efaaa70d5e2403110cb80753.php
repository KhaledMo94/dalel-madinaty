<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-12">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="<?php echo e(__('Search by name or description...')); ?>">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('City Name')); ?></th>
                    <th><?php echo e(__('City Description')); ?></th>
                    <th><?php echo e(__('Areas Count')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($cities->currentPage() - 1) * $cities->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($city->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <!--[if BLOCK]><![endif]--><?php if(!is_null($city->image)): ?>
                            <td>
                                <img src="<?php echo e(asset('storage/' . $city->image)); ?>" alt=""
                                    class="w_200">
                            </td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No Image')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <td><?php echo e($city->name); ?> <br> <?php echo e($city->getTranslation('name', $rev_locale)); ?></td>
                        <td><?php echo e(strip_tags($city->description ?? '')); ?> <br>
                            <?php echo e(strip_tags($city->getTranslation('description', $rev_locale) ?? '')); ?></td>
                        <td><?php echo e($city->areas_count); ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                            <a href="<?php echo e(route('admins.cities.edit', $city->id)); ?>"
                                class="mx-1 btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <form id="delete-form-<?php echo e($city->id); ?>"
                                action="<?php echo e(route('admins.cities.destroy', $city->id)); ?>" method="POST"
                                style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" class="mx-1 btn btn-danger btn-sm"
                                    onclick="confirmDelete(<?php echo e($city->id); ?>); event.preventDefault();">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center"><?php echo e(__('No cities found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($cities->links()); ?>

    </div>
</div>

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/cities-index.blade.php ENDPATH**/ ?>