<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row align-items-end">
        <div class="col-md-4">
            <label for="search" class="form-label font-weight-bold mb-1"><?php echo e(__('Search')); ?></label>
            <input type="text" id="search" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="<?php echo e(__('Search by content or listing name...')); ?>">
        </div>
        <div class="col-md-3">
            <label for="listingFilter" class="form-label font-weight-bold mb-1"><?php echo e(__('Listing')); ?></label>
            <select id="listingFilter" wire:model.live="listingFilter" class="form-control">
                <option value="all"><?php echo e(__('All Listings')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->listings ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($listing->id); ?>"><?php echo e($listing->getTranslation('name', app()->getLocale())); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
        <div class="col-md-2">
            <label for="startDateFilter" class="form-label font-weight-bold mb-1"><?php echo e(__('From')); ?></label>
            <input type="date" id="startDateFilter" wire:model.live="startDateFilter" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="endDateFilter" class="form-label font-weight-bold mb-1"><?php echo e(__('To')); ?></label>
            <input type="date" id="endDateFilter" wire:model.live="endDateFilter" class="form-control">
        </div>
        <div class="col-md-1">
            <!--[if BLOCK]><![endif]--><?php if($startDateFilter || $endDateFilter): ?>
                <button type="button" wire:click="clearDateFilters" class="btn btn-sm btn-secondary w-100"
                    title="<?php echo e(__('Clear Date Filters')); ?>">
                    <i class="fas fa-times"></i>
                </button>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('Content')); ?></th>
                    <th><?php echo e(__('Listing Name')); ?></th>
                    <th><?php echo e(__('Listing Logo')); ?></th>
                    <th><?php echo e(__('Start Date')); ?></th>
                    <th><?php echo e(__('End Date')); ?></th>
                    <th><?php echo e(__('Status')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($offers->currentPage() - 1) * $offers->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($offer->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($offer->image): ?>
                                <img src="<?php echo e(asset('storage/' . $offer->image)); ?>" alt="<?php echo e(__('Offer Image')); ?>"
                                    width="50px">
                            <?php else: ?>
                                <p><?php echo e(__('No Image')); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td>
                            <?php echo e($offer->getTranslation('content', app()->getLocale())); ?>

                            <br>
                            <?php echo e($offer->getTranslation('content', $rev_locale)); ?>

                        </td>
                        <td>
                            <?php echo e($offer->listing?->getTranslation('name', app()->getLocale()) ?? __('N/A')); ?>

                            <br>
                            <?php echo e($offer->listing?->getTranslation('name', $rev_locale) ?? ''); ?>

                        </td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($offer->listing?->image): ?>
                                <img src="<?php echo e(asset('storage/' . $offer->listing->image)); ?>" alt=""
                                    width="100px">
                            <?php else: ?>
                                <p><?php echo e(__('No image')); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td><?php echo e($offer->start_date ? $offer->start_date->format('Y-m-d H:i') : __('N/A')); ?></td>
                        <td><?php echo e($offer->end_date ? $offer->end_date->format('Y-m-d H:i') : __('N/A')); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($offer->is_active): ?>
                                <span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary"><?php echo e(__('Inactive')); ?></span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo e(route('admins.offers.show', $offer->id)); ?>"
                                    class="mx-1 btn btn-info btn-sm" title="<?php echo e(__('View')); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admins.offers.edit', $offer->id)); ?>"
                                    class="mx-1 btn btn-primary btn-sm" title="<?php echo e(__('Edit')); ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-<?php echo e($offer->id); ?>"
                                    action="<?php echo e(route('admins.offers.destroy', $offer->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($offer->id); ?>); event.preventDefault();"
                                        title="<?php echo e(__('Delete')); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center"><?php echo e(__('No offers found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($offers->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(offerId) {
        Swal.fire({
            title: "<?php echo e(__('Are you sure?')); ?>",
            text: "<?php echo e(__('You will not be able to revert this!')); ?>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?php echo e(__('Yes, delete it!')); ?>"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + offerId).submit();
            }
        });
    }
</script>
<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/livewire/offers-index.blade.php ENDPATH**/ ?>