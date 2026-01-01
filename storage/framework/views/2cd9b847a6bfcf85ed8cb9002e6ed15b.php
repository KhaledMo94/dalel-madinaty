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

    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Edit Profile')); ?></h1>

    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo e(route('admins.profile.update')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-4 shadow card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Name *')); ?></label>
                                    <input type="text" name="name" class="form-control"
                                        value="<?php echo e(Auth::user()->name); ?>" autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Email *')); ?></label>
                                    <input type="text" name="email" class="form-control"
                                        value="<?php echo e(Auth::user()->email); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Country Code')); ?></label>
                                    <input type="text" name="country_code" class="form-control"
                                        value="<?php echo e(Auth::user()->country_code); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Phone')); ?></label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="<?php echo e(Auth::user()->phone_number); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""><?php echo e(__('Profile Image')); ?></label>
                            <div>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->image)); ?>" id="existing-image" class="w_200" alt="">
                            </div>
                            <button type="button" id="remove-image" class="btn btn-outline-danger btn-sm"><?php echo e(__('Remove Image')); ?></button>
                            <input type="file" name="image" accept="image/*" />
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo e(__('Update')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#remove-image').click(function(){
                $('form').append('<input name="remove_image" type="hidden" value="1">');
                $('#existing-image').hide('slow'); 
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
<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/admin/profile-edit.blade.php ENDPATH**/ ?>