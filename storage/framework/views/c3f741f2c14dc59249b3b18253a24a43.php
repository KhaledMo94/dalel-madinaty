<?php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
?>

<div wire:id="<?php echo e($this->getId()); ?>">
    <div class="mb-3 row">
        <div class="col-md-4">
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
        <div class="col-md-3">
            <select wire:model.live="mainCategoryFilter" class="form-control">
                <option value="all"><?php echo e(__('All Main Categories')); ?></option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->main_categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($mainCategory->id); ?>"><?php echo e($mainCategory->getTranslation('name', app()->getLocale())); ?></option>
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
                    <th><?php echo e(__('Parent Category')); ?></th>
                    <th><?php echo e(__('Description')); ?></th>
                    <th><?php echo e(__('Options')); ?></th>
                    <th><?php echo e(__('Image')); ?></th>
                    <th><?php echo e(__('Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = ($categories->currentPage() - 1) * $categories->perPage(); ?>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($category->id); ?>">
                        <td><?php echo e(++$i); ?></td>
                        <td><?php echo e($category->name ?? ''); ?> <br>
                            <?php echo e($category->getTranslation('name', app()->getLocale())); ?></td>
                        <td><?php echo e($category->mainCategory->name ?? ''); ?> <br>
                            <?php echo e($category->mainCategory->getTranslation('name', $rev_locale) ?? ''); ?></td>
                        <td><?php echo e(strip_tags($category->description ?? '')); ?> <br>
                            <?php echo e(strip_tags($category->getTranslation('description', app()->getLocale()) ?? '')); ?></td>
                        <td>
                            <!--[if BLOCK]><![endif]--><?php if($category->options->count() > 0): ?>
                                <div class="d-flex flex-wrap">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $category->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-info mr-1 mb-1">
                                            <?php echo e($option->getTranslation('name', app()->getLocale())); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php else: ?>
                                <span class="text-muted"><?php echo e(__('No options')); ?></span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </td>
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
                                <a href="<?php echo e(route('admins.categories.edit', $category->id)); ?>"
                                    class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('admins.categories.destroy', $category->id)); ?>"
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
                        <td colspan="7" class="text-center"><?php echo e(__('No categories found')); ?></td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="py-2 d-flex justify-content-center">
        <?php echo e($categories->links()); ?>

    </div>
</div>

<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/livewire/categories-index.blade.php ENDPATH**/ ?>