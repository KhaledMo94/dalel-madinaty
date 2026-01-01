<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-4">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   class="form-control"
                   placeholder="<?php echo e(__('Search by address or listing name...')); ?>">
        </div>
        <div class="col-md-4">
            <select wire:model.live="cityFilter" class="form-control">
                <option value="all"><?php echo e(__('All Cities')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->cities ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>"><?php echo e($city->getTranslation('name', app()->getLocale())); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
        <div class="col-md-4">
            <select wire:model.live="areaFilter" class="form-control">
                <option value="all"><?php echo e(__('All Areas')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->filteredAreas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($area->id); ?>"><?php echo e($area->getTranslation('name', app()->getLocale())); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Address')); ?></th>
                    <th><?php echo e(__('Location')); ?></th>
                    <th><?php echo e(__('Listing')); ?></th>
                    <th><?php echo e(__('City')); ?></th>
                    <th><?php echo e(__('Area')); ?></th>
                    <th><?php echo e(__('Phone')); ?></th>
                    <th><?php echo e(__('Alternative Phone')); ?></th>
                    <th><?php echo e(__('Logo')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($branches->currentPage() - 1) * $branches->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($branch->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td>
                            <?php echo e($branch->getTranslation('address', app()->getLocale())); ?>

                            <br>
                            <?php echo e($branch->getTranslation('address', $rev_locale)); ?>

                        </td>
                        <td>
                            <a href="https://www.google.com/maps?q=<?php echo e($branch->latitude); ?>,<?php echo e($branch->longitude); ?>"
                                target="_blank">
                                <?php echo e(__('View on Map')); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo e($branch->listing?->getTranslation('name', app()->getLocale())); ?>

                            <br>
                            <?php echo e($branch->listing?->getTranslation('name', $rev_locale)); ?>

                        </td>
                        <td>
                            <?php echo e($branch->area?->city?->getTranslation('name', app()->getLocale()) ?? __('N/A')); ?>

                            <br>
                            <?php echo e($branch->area?->city?->getTranslation('name', $rev_locale) ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($branch->area?->getTranslation('name', app()->getLocale()) ?? __('N/A')); ?>

                            <br>
                            <?php echo e($branch->area?->getTranslation('name', $rev_locale) ?? ''); ?>

                        </td>
                        <td><?php echo e($branch->phone ?? __('N/A')); ?></td>
                        <td><?php echo e($branch->phone_alt ?? __('N/A')); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($branch->listing?->image): ?>
                                <img src="<?php echo e(asset('storage/' . $branch->listing->image)); ?>" width="70" alt="">
                            <?php else: ?>
                                <p><?php echo e(__('No image')); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                            <a href="<?php echo e(route('admins.branches.duplicate', ['id' => $branch->id])); ?>"
                                class="mx-1 btn btn-warning btn-sm">
                                <i class="fas fa-copy"></i>
                            </a>
                            <a href="<?php echo e(route('admins.branches.edit', $branch->id)); ?>"
                                class="mx-1 btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-<?php echo e($branch->id); ?>"
                                action="<?php echo e(route('admins.branches.destroy', $branch->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                    onclick="confirmDelete(<?php echo e($branch->id); ?>); event.preventDefault();">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10" class="text-center"><?php echo e(__('No branches found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($branches->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(branchId) {
        Swal.fire({
            title: "<?php echo e(__('Are you sure?')); ?>",
            text: "<?php echo e(__('You will not be able to revert this! ,Branch Cashiers Will Also Deleted')); ?>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(__('Yes, delete it!')); ?>"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + branchId).submit();
            }
        });
    }

</script>

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/branches-index.blade.php ENDPATH**/ ?>