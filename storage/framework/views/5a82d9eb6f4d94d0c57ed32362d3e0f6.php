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
    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Users')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                
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
                            <th><?php echo e(__('Email Verified ?')); ?></th>
                            <th><?php echo e(__('Phone')); ?></th>
                            <th><?php echo e(__('Phone Verified ?')); ?></th>
                            <th><?php echo e(__('Liked Listing Count')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$i); ?></td>
                                <td><?php echo e($user->name); ?></td>
                                <td>
                                    <?php if($user->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $user->image)); ?>" alt="<?php echo e($user->name); ?>"
                                            width="70">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->email ?? __('No Email')); ?></td>
                                <td>
                                    <?php if($user->email_verified_at): ?>
                                        <span class="badge badge-success"><?php echo e(__('Yes')); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-danger"><?php echo e(__('No')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td style="direction: ltr"><?php echo e($user->phone ?? ''); ?></td>
                                <td>
                                    <?php if($user->phone_verified_at): ?>
                                        <span class="badge badge-success"><?php echo e(__('Yes')); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-danger"><?php echo e(__('No')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->listings_count); ?></td>
                                <td>
                                    <input type="checkbox" <?php if($user->status == 'active'): ?> checked <?php endif; ?>
                                        data-toggle="toggle" data-on="<?php echo e(__('Active')); ?>" data-off="<?php echo e(__('Banned')); ?>"
                                        data-onstyle="success" data-id = "<?php echo e($user->id); ?>"
                                        data-offstyle="danger">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        
                                        
                                        <form action="<?php echo e(route('admins.users.destroy', $user->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                                onclick="return confirm('<?php echo e(__('Are you sure?')); ?>')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="py-2 d-flex justify-content-center">
            
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('input[type="checkbox"]').on('change', function() {

                const checkbox = $(this);
                const id = checkbox.data('id');
                const url = <?php echo json_encode(route('admins.users.toggle', ['id' => ':id']), 512) ?>.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                    success: function(response) {
                    },
                    error: function(xhr) {
                    },
                });
            });
        });
    </script>

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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/users/index.blade.php ENDPATH**/ ?>