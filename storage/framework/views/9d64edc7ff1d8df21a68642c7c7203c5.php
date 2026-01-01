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
    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Commenters')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"><?php echo e(__('All Commenters')); ?></h6>
            <div>
                <a href="<?php echo e(route('admins.commenters.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create Commenter')); ?>

                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Serial')); ?></th>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Image')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Phone')); ?></th>
                            <th><?php echo e(__('Listing')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(++$i); ?></td>
                                <td><?php echo e($user->name); ?></td>
                                <td>
                                    <?php if($user->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $user->image)); ?>" alt="<?php echo e($user->name); ?>"
                                            width="70">
                                    <?php else: ?>
                                        <span class="text-muted"><?php echo e(__('No Image')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->email ?? __('No Email')); ?></td>
                                <td style="direction: ltr"><?php echo e($user->phone ?? ''); ?></td>
                                <td>
                                    <?php if($user->commenterListing): ?>
                                        <span class="badge badge-info">
                                            <?php echo e($user->commenterListing->getTranslation('name', app()->getLocale())); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-warning"><?php echo e(__('No Listing')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo e($user->status == 'active' ? 'success' : 'danger'); ?>">
                                        <?php echo e(ucfirst($user->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="<?php echo e(route('admins.commenters.edit', $user->id)); ?>"
                                            class="mx-1 btn btn-warning btn-sm" title="<?php echo e(__('Edit')); ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admins.commenters.destroy', $user->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                                onclick="return confirm('<?php echo e(__('Are you sure you want to delete this commenter?')); ?>')"
                                                title="<?php echo e(__('Delete')); ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center"><?php echo e(__('No commenters found')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
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

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/commenters/index.blade.php ENDPATH**/ ?>