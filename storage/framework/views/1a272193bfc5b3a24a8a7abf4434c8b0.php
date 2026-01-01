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
        $locale = app()->getLocale();
    ?>
    <div class="card-body" data-aos="fade-up">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form class="my-3" action="<?php echo e(route('admins.branches.update', $branch->id)); ?>" method="post"
            enctype="application/x-www-form-urlencoded">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Address In Arabic')); ?></label>
                        <input type="text" name="address_ar" class="form-control"
                            value="<?php echo e(old('address_ar') ?? $branch->getTranslation('address', 'ar')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Address In English')); ?></label>
                        <input type="text" name="address_en" class="form-control"
                            value="<?php echo e(old('address_en') ?? $branch->getTranslation('address', 'en')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('City')); ?></label>
                        <select id="city_select" class="form-control select2 city-select">
                            <?php if($branch->area && $branch->area->city): ?>
                                <option value="<?php echo e($branch->area->city->id); ?>" selected>
                                    <?php echo e($branch->area->city->getTranslation('name', $locale)); ?>

                                </option>
                            <?php else: ?>
                                <option value=""><?php echo e(__('Select City')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Area')); ?></label>
                        <select name="area_id" id="area_select" class="form-control select2 area-select" required>
                            <?php if($branch->area): ?>
                                <option value="<?php echo e($branch->area_id); ?>" selected>
                                    <?php echo e($branch->area->getTranslation('name', $locale)); ?>

                                </option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Service Provider')); ?></label>
                        <select name="listing_id" class="form-control select2 service-provider-select"
                            required>
                            <option value="<?php echo e($branch->listing_id); ?>" selected>
                                <?php echo e($branch->listing->getTranslation('name', $locale)); ?>

                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Phone')); ?></label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone') ?? $branch->phone); ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Alternate Phone')); ?></label>
                        <input type="text" name="phone_alt" class="form-control" value="<?php echo e(old('phone_alt') ?? $branch->phone_alt); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Latitude')); ?></label>
                        <input type="text" name="latitude" class="form-control" value="<?php echo e(old('latitude') ?? $branch->latitude); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?php echo e(__('Longitude')); ?></label>
                        <input type="text" name="longitude" class="form-control" value="<?php echo e(old('longitude') ?? $branch->longitude); ?>">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><?php echo e(__('Update')); ?></button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.service-provider-select').select2({
                placeholder: "<?php echo e(__('Search for a listing')); ?>",
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
                            results: data.map(provider => ({
                                id: provider.id,
                                text: provider.name
                            }))
                        };
                    },
                    cache: true
                }
            });
            $('#city_select').select2({
                placeholder: "<?php echo e(__('Select City')); ?>",
                allowClear: true,
                ajax: {
                    url: "<?php echo e(route('admins.cities.search')); ?>",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(city => ({
                                id: city.id,
                                text: city.name
                            }))
                        };
                    },
                    cache: true
                }
            });

            $('#area_select').select2({
                placeholder: "<?php echo e(__('Select Area')); ?>",
                ajax: {
                    url: "<?php echo e(route('admins.areas.search')); ?>",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term,
                            city_id: $('#city_select').val()
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(area => ({
                                id: area.id,
                                text: area.name
                            }))
                        };
                    },
                    cache: true
                }
            });

            // Filter areas when city changes
            $('#city_select').on('change', function() {
                $('#area_select').val(null).trigger('change');
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/branches/edit.blade.php ENDPATH**/ ?>