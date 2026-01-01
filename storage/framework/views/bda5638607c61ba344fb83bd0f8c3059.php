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

        <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Edit Commenter')); ?></h1>

        <form class="my-3" action="<?php echo e(route('admins.commenters.update', $user->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="name"><?php echo e(__('Name')); ?></label>
                <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" placeholder="<?php echo e(__('Name')); ?>"
                    required value="<?php echo e(old('name', $user->name)); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="email"><?php echo e(__('Email')); ?></label>
                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email"
                    placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email', $user->email)); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="email_verified"><?php echo e(__('Email Verified')); ?></label>
                <select name="email_verified" class="form-control" id="email_verified">
                    <option value="1" <?php if(old('email_verified', $user->email_verified_at ? '1' : '0') == '1'): echo 'selected'; endif; ?>><?php echo e(__('Yes')); ?></option>
                    <option value="0" <?php if(old('email_verified', $user->email_verified_at ? '1' : '0') == '0'): echo 'selected'; endif; ?>><?php echo e(__('No')); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="country_code"><?php echo e(__('Country Code')); ?></label>
                <input type="text" name="country_code" id="country_code"
                    class="form-control <?php $__errorArgs = ['country_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="<?php echo e(__('Country Code')); ?>" required
                    value="<?php echo e(old('country_code', $user->country_code)); ?>">
                <?php $__errorArgs = ['country_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="phone_number"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="phone_number" id="phone_number"
                    class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="<?php echo e(__('Phone Number (e.g., 01234567890)')); ?>" required
                    value="<?php echo e(old('phone_number', $user->phone_number)); ?>">
                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="form-text text-muted"><?php echo e(__('Egyptian phone format: +20XXXXXXXXXX (e.g., +201234567890)')); ?></small>
            </div>

            <div class="form-group">
                <label for="password"><?php echo e(__('Password')); ?></label>
                <input type="password" name="password" id="password"
                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="<?php echo e(__('Leave blank to keep current password')); ?>">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="form-text text-muted"><?php echo e(__('Leave blank if you do not want to change the password')); ?></small>
            </div>

            <div class="form-group">
                <label for="phone_verified"><?php echo e(__('Phone Verified')); ?></label>
                <select name="phone_verified" class="form-control" id="phone_verified">
                    <option value="1" <?php if(old('phone_verified', $user->phone_verified_at ? '1' : '0') == '1'): echo 'selected'; endif; ?>><?php echo e(__('Yes')); ?></option>
                    <option value="0" <?php if(old('phone_verified', $user->phone_verified_at ? '1' : '0') == '0'): echo 'selected'; endif; ?>><?php echo e(__('No')); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="commenter_id"><?php echo e(__('Commenter Listing')); ?> <span class="text-danger">*</span></label>
                <select name="commenter_id" id="commenter_id" 
                    class="form-control select2 <?php $__errorArgs = ['commenter_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value=""><?php echo e(__('Select Listing')); ?></option>
                    <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($listing->id); ?>" <?php if((old('commenter_id') ?? $user->commenter_id) == $listing->id): echo 'selected'; endif; ?>>
                            <?php echo e($listing->getTranslation('name', app()->getLocale())); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['commenter_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="form-text text-muted"><?php echo e(__('Select the listing this commenter can reply to comments on')); ?></small>
            </div>

            <div class="form-group">
                <label for="status"><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active" <?php if((old('status') ?? $user->status) == 'active'): echo 'selected'; endif; ?>><?php echo e(__('Active')); ?></option>
                    <option value="inactive" <?php if((old('status') ?? $user->status) == 'inactive'): echo 'selected'; endif; ?>><?php echo e(__('Banned')); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for=""><?php echo e(__('Existing Featured Photo')); ?></label>
                <div>
                    <?php if($user->image): ?>
                        <img src="<?php echo e(asset('storage/' . $user->image)); ?>" class="w_200" alt="">
                    <?php else: ?>
                        <span class="text-muted"><?php echo e(__('No Image')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="for"><?php echo e(__('Image')); ?></label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="<?php echo e(__('Image')); ?>">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40"><?php echo e(__('Update Commenter')); ?></button>
            <a href="<?php echo e(route('admins.commenters.index')); ?>" class="btn btn-secondary btn-block"><?php echo e(__('Cancel')); ?></a>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Commenter Listing
            $('#commenter_id').select2({
                placeholder: "<?php echo e(__('Select Listing')); ?>",
                allowClear: false
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

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/commenters/edit.blade.php ENDPATH**/ ?>