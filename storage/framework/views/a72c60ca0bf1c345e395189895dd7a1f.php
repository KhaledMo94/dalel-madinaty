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
    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Edit Banner')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"><?php echo e(__('Banner Information')); ?></h6>
        </div>
    <div class="card-body" data-aos="fade-up">
            <form action="<?php echo e(route('admins.banners.update', $banner->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

            <div class="form-group">
                    <label for="title_ar"><?php echo e(__('Banner Title In Arabic')); ?></label>
                    <input type="text" name="title_ar" id="title_ar" class="form-control <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('title_ar') ?? $banner->getTranslation('title','ar')); ?>">
                    <?php $__errorArgs = ['title_ar'];
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
                    <label for="title_en"><?php echo e(__('Banner Title In English')); ?></label>
                    <input type="text" name="title_en" id="title_en" class="form-control <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('title_en') ?? $banner->getTranslation('title','en')); ?>">
                    <?php $__errorArgs = ['title_en'];
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
                    <label><?php echo e(__('Current Image')); ?></label>
                <div>
                    <?php if($banner->image): ?>
                            <img src="<?php echo e(asset('storage/' . $banner->image)); ?>" class="img-thumbnail" style="max-width: 300px; max-height: 300px;" alt="<?php echo e(__('Banner Image')); ?>">
                    <?php else: ?>
                            <p class="text-muted"><?php echo e(__('No Image')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                    <label for="image"><?php echo e(__('Change Image')); ?></label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control-file <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted"><?php echo e(__('Leave empty to keep current image. Maximum file size: 5MB')); ?></small>
                </div>

                <div class="form-group">
                    <label for="listing_id"><?php echo e(__('Listing')); ?> <small class="text-muted">(<?php echo e(__('Optional')); ?>)</small></label>
                    <select name="listing_id" id="listing_id" class="form-control select2-ajax <?php $__errorArgs = ['listing_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value=""><?php echo e(__('Select a listing')); ?></option>
                        <?php if($banner->listing_id): ?>
                            <option value="<?php echo e($banner->listing_id); ?>" selected>
                                <?php echo e($banner->listing ? $banner->listing->getTranslation('name', app()->getLocale()) : __('Listing #') . $banner->listing_id); ?>

                            </option>
                        <?php endif; ?>
                    </select>
                    <?php $__errorArgs = ['listing_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="form-text text-muted"><?php echo e(__('Search and select a listing to link this banner')); ?></small>
            </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> <?php echo e(__('Update')); ?>

                    </button>
                    <a href="<?php echo e(route('admins.banners.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> <?php echo e(__('Cancel')); ?>

                    </a>
                </div>
        </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#listing_id').select2({
                placeholder: "<?php echo e(__('Search for a listing')); ?>",
                allowClear: true,
                ajax: {
                    url: "<?php echo e(route('admins.listings.search')); ?>",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(listing) {
                                return {
                                    id: listing.id,
                                    text: listing.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Pre-select the existing listing if it exists
            <?php if($banner->listing_id && $banner->listing): ?>
                var selectedListingId = <?php echo e($banner->listing_id); ?>;
                var selectedListingName = <?php echo json_encode($banner->listing->getTranslation('name', app()->getLocale()), 512) ?>;
                var option = new Option(selectedListingName, selectedListingId, true, true);
                $('#listing_id').append(option).trigger('change');
            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/banners/edit.blade.php ENDPATH**/ ?>