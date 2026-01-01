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
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    ?>

    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Offer Details')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"><?php echo e(__('Offer Information')); ?></h6>
            <div>
                <a href="<?php echo e(route('admins.offers.edit', $offer->id)); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                </a>
                <a href="<?php echo e(route('admins.offers.index')); ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?>

                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        <?php if($offer->image): ?>
                            <img src="<?php echo e(asset('storage/' . $offer->image)); ?>" 
                                 alt="<?php echo e(__('Offer Image')); ?>" 
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; max-width: 100%;">
                        <?php else: ?>
                            <div class="alert alert-info">
                                <?php echo e(__('No image available')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Content (English)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($offer->getTranslation('content', 'en')); ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Content (Arabic)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($offer->getTranslation('content', 'ar')); ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Listing')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($offer->listing?->getTranslation('name', $locale) ?? __('N/A')); ?>

                            <br>
                            <small class="text-muted"><?php echo e($offer->listing?->getTranslation('name', $rev_locale) ?? ''); ?></small>
                        </p>
                    </div>
                </div>

                <?php if($offer->listing): ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Listing Logo')); ?></label>
                        <div>
                            <?php if($offer->listing->image): ?>
                                <img src="<?php echo e(asset('storage/' . $offer->listing->image)); ?>" 
                                     alt="<?php echo e(__('Listing Logo')); ?>" 
                                     class="rounded"
                                     style="max-width: 150px; max-height: 150px;">
                            <?php else: ?>
                                <p class="text-muted"><?php echo e(__('No image available')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Start Date')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($offer->start_date ? $offer->start_date->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('End Date')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($offer->end_date ? $offer->end_date->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Status')); ?></label>
                        <p class="form-control-plaintext">
                            <?php if($offer->is_active): ?>
                                <span class="badge badge-success badge-lg"><?php echo e(__('Active')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary badge-lg"><?php echo e(__('Inactive')); ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Created At')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($offer->created_at ? $offer->created_at->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Updated At')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($offer->updated_at ? $offer->updated_at->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admins.offers.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> <?php echo e(__('Back to List')); ?>

                    </a>
                    <div>
                        <a href="<?php echo e(route('admins.offers.edit', $offer->id)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> <?php echo e(__('Edit Offer')); ?>

                        </a>
                        <form action="<?php echo e(route('admins.offers.destroy', $offer->id)); ?>" 
                              id="delete-form-<?php echo e($offer->id); ?>" 
                              method="POST" 
                              class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="confirmDelete(<?php echo e($offer->id); ?>); event.preventDefault();">
                                <i class="fas fa-trash-alt"></i> <?php echo e(__('Delete Offer')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(offerId) {
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
                    document.getElementById('delete-form-' + offerId).submit();
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

<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/admin/offers/show.blade.php ENDPATH**/ ?>