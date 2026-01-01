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
        $permissions_tr = [];
        foreach ($permissions as $value) {
            $permissions_tr[] = [
                'id' => $value->id,
                'name' => __(ucfirst($value->name)),
            ];
        }
        $user = $admin;
    ?>

    <div class="card-body">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Edit Admin')); ?></h1>

        <form class="my-3" action="<?php echo e(route('admins.admins.update', $user->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="name"><?php echo e(__('Name')); ?></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo e(__('Name')); ?>"
                    required value="<?php echo e(old('name') ?? $user->name); ?>">
            </div>

            <div class="form-group">
                <label for="email"><?php echo e(__('Email')); ?></label>
                <input type="email" name="email" class="form-control" id="email"
                    placeholder="<?php echo e(__('Email')); ?>" required value="<?php echo e(old('email') ?? $user->email); ?>">
            </div>

            <div class="form-group">
                <label for="password"><?php echo e(__('Password')); ?></label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="<?php echo e(__('Password')); ?>" value="<?php echo e(old('password')); ?>">
                <small
                    class="form-text text-danger"><?php echo e(__('Leave blank if you do not want to change the password')); ?></small>
            </div>

            <div class="form-group">
                <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    placeholder="<?php echo e(__('Confirm Password')); ?>" value="<?php echo e(old('password_confirmation')); ?>">
                <small
                    class="form-text text-danger"><?php echo e(__('Leave blank if you do not want to change the password')); ?></small>
            </div>

            <div class="form-group">
                <label for="status"><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active" <?php if((old('status') ?? $user->status) == 'active'): echo 'selected'; endif; ?>><?php echo e(__('Active')); ?></option>
                    <option value="inactive" <?php if((old('status') ?? $user->status) == 'inactive'): echo 'selected'; endif; ?>><?php echo e(__('Banned')); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="permissions"><?php echo e(__('Permissions')); ?> <span class="text-danger">*</span></label>
                <select name="permissions[]" class="form-control select2" id="permissions" required multiple>
                    <?php $__currentLoopData = $permissions_tr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($permission['id']); ?>" <?php if(in_array($permission['id'], old('permissions', $user->permissions->pluck('id')->toArray()))): echo 'selected'; endif; ?>>
                            <?php echo e($permission['name']); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <small class="form-text text-muted"><?php echo e(__('Select one or more permissions for this admin')); ?></small>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Existing Featured Photo')); ?></label>
                <div>
                    <img src="<?php echo e(asset('storage/' . $user->image)); ?>" class="w_200" alt="">
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="for"><?php echo e(__('Image')); ?></label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="<?php echo e(__('Image')); ?>">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Update Admin')); ?></button>
            <a href="<?php echo e(route('admins.admins.index')); ?>" class="btn btn-secondary btn-block"><?php echo e(__('Cancel')); ?></a>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Permissions
            $('#permissions').select2({
                placeholder: "<?php echo e(__('Select Permissions')); ?>",
                allowClear: false
            });
        });
    </script>

    <?php if(app()->getLocale() == 'ar'): ?>
        <style>
            .select2-results__option--selectable{
                display: flex
            }
        </style>
    <?php endif; ?>

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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/admins/edit.blade.php ENDPATH**/ ?>