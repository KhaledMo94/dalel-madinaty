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
        <div class="col-md-6">
            <select wire:model.live="categoryFilter" class="form-control">
                <option value="all"><?php echo e(__('All Categories')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name', app()->getLocale())); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Amenity Name')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('Amenity Description')); ?></th>
                    <th><?php echo e(__('Listings Count')); ?></th>
                    <th><?php echo e(__('Categories Count')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($amenities->currentPage() - 1) * $amenities->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e(++$i); ?></td>
                        <td>
                            <?php echo e($amenity->getTranslation('name', app()->getLocale())); ?><br>
                            <?php echo e($amenity->getTranslation('name', $rev_locale)); ?>

                        </td>
                        <!--[if BLOCK]><![endif]--><?php if(!is_null($amenity->image)): ?>
                            <td><img src="<?php echo e(asset('storage/' . $amenity->image)); ?>" alt=""
                                    class="w_200"></td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No image')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <td>
                            <?php echo e(strip_tags($amenity->getTranslation('description', app()->getLocale()) ?? '')); ?><br>
                            <?php echo e(strip_tags($amenity->getTranslation('description', $rev_locale) ?? '')); ?>

                        </td>
                        <td><?php echo e($amenity->listings_count); ?></td>
                        <td><?php echo e($amenity->categories_count); ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="<?php echo e(route('admins.amenities.edit', $amenity->id)); ?>"
                                    class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-<?php echo e($amenity->id); ?>" action="<?php echo e(route('admins.amenities.destroy', $amenity->id)); ?>"
                                    method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($amenity->id); ?>); event.preventDefault();">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center"><?php echo e(__('No amenities found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($amenities->links()); ?>

    </div>
</div>

<script>
    function confirmDelete(amenityId) {
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
                document.getElementById('delete-form-' + amenityId).submit();
            }
        });
    }
</script>

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/livewire/amenities-index.blade.php ENDPATH**/ ?>