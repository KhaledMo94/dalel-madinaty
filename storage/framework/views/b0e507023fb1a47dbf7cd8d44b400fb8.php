<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-3">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="<?php echo e(__('Search by name, description, category...')); ?>">
        </div>
        <div class="col-md-3">
            <select wire:model.live="categoryFilter" class="form-control">
                <option value="all"><?php echo e(__('All Categories')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name', app()->getLocale())); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model.live="amenityFilter" class="form-control">
                <option value="all"><?php echo e(__('All Amenities')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->amenities ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($amenity->id); ?>"><?php echo e($amenity->getTranslation('name', app()->getLocale())); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('Banner Image')); ?></th>
                    <th><?php echo e(__('File')); ?></th>
                    <th><?php echo e(__('Listing Name')); ?></th>
                    <th><?php echo e(__('Listing Category')); ?></th>
                    <th><?php echo e(__('Likes')); ?></th>
                    <th><?php echo e(__('Average Rating')); ?></th>
                    <th><?php echo e(__('Amenities')); ?></th>
                    <th><?php echo e(__('Options Count')); ?></th>
                    <th><?php echo e(__('Branches Count')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($listings->currentPage() - 1) * $listings->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($listing->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <!--[if BLOCK]><![endif]--><?php if(!is_null($listing->image)): ?>
                            <td>
                                <img src="<?php echo e(asset('storage/' . $listing->image)); ?>" width="100px" alt=""
                                    class="">
                            </td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No Image')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!--[if BLOCK]><![endif]--><?php if(!is_null($listing->banner_image)): ?>
                            <td>
                                <img src="<?php echo e(asset('storage/' . $listing->banner_image)); ?>" width="100px"
                                    alt="" class="">
                            </td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No Banner Image')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!--[if BLOCK]><![endif]--><?php if(!is_null($listing->file)): ?>
                            <td>
                                <a href="<?php echo e(asset('storage/' . $listing->file)); ?>" target="_blank"
                                    class="btn btn-sm btn-primary"><?php echo e(__('View File')); ?></a>
                            </td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No File')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <td>
                            <?php echo e($listing->getTranslation('name', app()->getLocale())); ?>

                            <br>
                            <?php echo e($listing->getTranslation('name', $rev_locale)); ?>

                        </td>

                        <td>
                            <?php echo e($listing->category?->getTranslation('name', app()->getLocale()) ?? __('Uncategorized')); ?>

                            <br>
                            <?php echo e($listing->category?->getTranslation('name', $rev_locale) ?? ''); ?>

                        </td>

                        <td><?php echo e($listing->users_count); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($listing->ratings_avg_rating): ?>
                                <span class="badge badge-warning">
                                    <i class="fas fa-star"></i> <?php echo e(number_format($listing->ratings_avg_rating, 1)); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-muted"><?php echo e(__('No Ratings')); ?></span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $listing->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span
                                    class="badge badge-info"><?php echo e($amenity->getTranslation('name', app()->getLocale())); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
                        <td><?php echo e($listing->option_values_count); ?></td>
                        <td><?php echo e($listing->branches_count); ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo e(route('admins.listings.show', $listing->id)); ?>"
                                    class="mx-1 btn btn-info btn-sm"
                                    title="<?php echo e(__('View')); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admins.listings.comments', $listing->id)); ?>"
                                    class="mx-1 btn btn-success btn-sm"
                                    title="<?php echo e(__('Comments')); ?>">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="<?php echo e(route('admins.listings.edit', $listing->id)); ?>"
                                    class="mx-1 btn btn-primary btn-sm"
                                    title="<?php echo e(__('Edit')); ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-<?php echo e($listing->id); ?>"
                                    action="<?php echo e(route('admins.listings.destroy', $listing->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($listing->id); ?>); event.preventDefault();"
                                        title="<?php echo e(__('Delete')); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="12" class="text-center"><?php echo e(__('No listings found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($listings->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(listingId) {
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
                document.getElementById('delete-form-' + listingId).submit();
            }
        });
    }
</script>
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/listings-index.blade.php ENDPATH**/ ?>