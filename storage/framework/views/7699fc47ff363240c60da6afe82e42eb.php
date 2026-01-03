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
    <?php
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    ?>
    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Banners')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="<?php echo e(route('admins.banners.create')); ?>" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i><?php echo e(__('Add New')); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Serial')); ?></th>
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Image')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-id="<?php echo e($banner->id); ?>">
                                <td><?php echo e(++$i); ?></td>
                                <td><?php echo e($banner->getTranslation('title',app()->getLocale()) ? $banner->getTranslation('title',app()->getLocale()) : __('No Title')); ?> <br> <?php echo e($banner->getTranslation('title',$rev_locale)); ?></td>
                                <?php if(!is_null($banner->image)): ?>
                                    <td><img src="<?php echo e(asset('storage/' . $banner->image)); ?>" alt=""
                                            class="w_200"></td>
                                <?php else: ?>
                                    <td>
                                        <p><?php echo e(__('No image')); ?></p>
                                    </td>
                                <?php endif; ?>
                                <td >
                                    <div class="d-flex justify-content-center">
                                        <a href="<?php echo e(route('admins.banners.edit', $banner->id)); ?>"
                                            class="mx-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form id="delete-form-<?php echo e($banner->id); ?>" action="<?php echo e(route('admins.banners.destroy', $banner->id)); ?>"
                                            method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                                onclick="confirmDelete(<?php echo e($banner->id); ?>); event.preventDefault(); ">
                                                <i class="fas fa-trash-alt"></i></button>
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
            <?php echo e($banners->links()); ?>

        </div>
    </div>

    <script>
        function confirmDelete($bannerId) {
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
                    document.getElementById('delete-form-' + $bannerId).submit();
                    document.querySelector('tr[data-id="' + $bannerId + '"]')?.remove();
                }
            });
        }
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/banners/index.blade.php ENDPATH**/ ?>