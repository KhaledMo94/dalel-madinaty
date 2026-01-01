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
            <select wire:model.live="statusFilter" class="form-control">
                <option value="all"><?php echo e(__('All Status')); ?></option>
                <option value="active"><?php echo e(__('Active')); ?></option>
                <option value="inactive"><?php echo e(__('Inactive')); ?></option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo e(__('Serial')); ?></th>
                    <th><?php echo e(__('Name')); ?></th>
                    <th><?php echo e(__('Description')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($categories->currentPage() - 1) * $categories->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr  data-id="<?php echo e($category->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td><?php echo e($category->name); ?> <br> <?php echo e($category->getTranslation('name',$rev_locale)); ?></td>
                        <td><?php echo e(strip_tags($category->description ?? '')); ?> <br> <?php echo e(strip_tags($category->getTranslation('description',$rev_locale) ?? '')); ?> </td>
                        <!--[if BLOCK]><![endif]--><?php if(!is_null($category->image)): ?>
                            <td><img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt=""
                                    class="w_200"></td>
                        <?php else: ?>
                            <td>
                                <p><?php echo e(__('No image')); ?></p>
                            </td>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <td>
                            <div class="d-flex justify-content-center">
                            <a href="<?php echo e(route('admins.main-categories.edit', $category->id)); ?>"
                                class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('admins.main-categories.destroy', $category->id)); ?>"
                                    method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                        onclick="confirmDelete(<?php echo e($category->id); ?>); event.preventDefault();"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center"><?php echo e(__('No categories found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($categories->links()); ?>

    </div>
</div>


<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/livewire/main-categories-index.blade.php ENDPATH**/ ?>