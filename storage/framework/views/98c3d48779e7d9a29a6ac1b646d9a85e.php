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

    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Listing Details')); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"><?php echo e(__('Listing Information')); ?></h6>
            <div>
                <a href="<?php echo e(route('admins.listings.edit', $listing->id)); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> <?php echo e(__('Edit')); ?>

                </a>
                <a href="<?php echo e(route('admins.listings.index')); ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo e(__('Back')); ?>

                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Main Image -->
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        <?php if($listing->image): ?>
                            <img src="<?php echo e(asset('storage/' . $listing->image)); ?>"
                                 alt="<?php echo e(__('Listing Image')); ?>"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; max-width: 100%;">
                        <?php else: ?>
                            <div class="alert alert-info">
                                <?php echo e(__('No image available')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Banner Image -->
                <?php if($listing->banner_image): ?>
                <div class="col-md-12 mb-4">
                    <label class="font-weight-bold"><?php echo e(__('Banner Image')); ?></label>
                    <div class="text-center">
                        <img src="<?php echo e(asset('storage/' . $listing->banner_image)); ?>"
                             alt="<?php echo e(__('Banner Image')); ?>"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px; max-width: 100%;">
                    </div>
                </div>
                <?php endif; ?>

                <!-- Basic Information -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Name (English)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->getTranslation('name', 'en')); ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Name (Arabic)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->getTranslation('name', 'ar')); ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Description (English)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->getTranslation('description', 'en')); ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Description (Arabic)')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->getTranslation('description', 'ar')); ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Category')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($listing->category?->getTranslation('name', $locale) ?? __('Uncategorized')); ?>

                            <br>
                            <small class="text-muted"><?php echo e($listing->category?->getTranslation('name', $rev_locale) ?? ''); ?></small>
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Status')); ?></label>
                        <p class="form-control-plaintext">
                            <?php if($listing->status == 'active'): ?>
                                <span class="badge badge-success badge-lg"><?php echo e(__('Active')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary badge-lg"><?php echo e(__('Inactive')); ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Location Information -->
                <?php if($listing->latitude && $listing->longitude): ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Latitude')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->latitude); ?></p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Longitude')); ?></label>
                        <p class="form-control-plaintext"><?php echo e($listing->longitude); ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Location on Map')); ?></label>
                        <p class="form-control-plaintext">
                            <a href="https://www.google.com/maps?q=<?php echo e($listing->latitude); ?>,<?php echo e($listing->longitude); ?>"
                               target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-map-marker-alt"></i> <?php echo e(__('View on Google Maps')); ?>

                            </a>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Social Media Links -->
                <?php if($listing->fb_link || $listing->tt_link || $listing->insta_link): ?>
                <div class="col-md-12">
                    <label class="font-weight-bold"><?php echo e(__('Social Media Links')); ?></label>
                    <div class="form-group">
                        <?php if($listing->fb_link): ?>
                            <p class="form-control-plaintext">
                                <strong><?php echo e(__('Facebook')); ?>:</strong>
                                <a href="<?php echo e($listing->fb_link); ?>" target="_blank"><?php echo e($listing->fb_link); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($listing->tt_link): ?>
                            <p class="form-control-plaintext">
                                <strong><?php echo e(__('TikTok')); ?>:</strong>
                                <a href="<?php echo e($listing->tt_link); ?>" target="_blank"><?php echo e($listing->tt_link); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if($listing->insta_link): ?>
                            <p class="form-control-plaintext">
                                <strong><?php echo e(__('Instagram')); ?>:</strong>
                                <a href="<?php echo e($listing->insta_link); ?>" target="_blank"><?php echo e($listing->insta_link); ?></a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- File -->
                <?php if($listing->file): ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('File')); ?></label>
                        <p class="form-control-plaintext">
                            <a href="<?php echo e(asset('storage/' . $listing->file)); ?>" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-file"></i> <?php echo e(__('View File')); ?>

                            </a>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Statistics -->
                <div class="col-md-12 mt-3">
                    <h5 class="mb-3"><?php echo e(__('Statistics')); ?></h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3><?php echo e($listing->branches_count ?? 0); ?></h3>
                                    <p class="mb-0"><?php echo e(__('Branches')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3><?php echo e($listing->amenities->count() ?? 0); ?></h3>
                                    <p class="mb-0"><?php echo e(__('Amenities')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3><?php echo e($listing->images->count() ?? 0); ?></h3>
                                    <p class="mb-0"><?php echo e(__('Images')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3><?php echo e($listing->users->count() ?? 0); ?></h3>
                                    <p class="mb-0"><?php echo e(__('Likes')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <?php if($listing->amenities->count() > 0): ?>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Amenities')); ?></label>
                        <div>
                            <?php $__currentLoopData = $listing->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-info badge-lg mr-2 mb-2">
                                    <?php echo e($amenity->getTranslation('name', $locale)); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Images Gallery -->
                <?php if($listing->images->count() > 0): ?>
                <div class="col-md-12 mt-3">
                    <label class="font-weight-bold"><?php echo e(__('Gallery Images')); ?></label>
                    <div class="row">
                        <?php $__currentLoopData = $listing->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 mb-3">
                                <img src="<?php echo e(asset('storage/' . $image->image)); ?>"
                                     alt="<?php echo e(__('Listing Image')); ?>"
                                     class="img-fluid rounded shadow"
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Timestamps -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Created At')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($listing->created_at ? $listing->created_at->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo e(__('Updated At')); ?></label>
                        <p class="form-control-plaintext">
                            <?php echo e($listing->updated_at ? $listing->updated_at->format('Y-m-d H:i') : __('N/A')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="mb-4 font-weight-bold"><?php echo e(__('Comments')); ?> (<?php echo e($listing->comments->count()); ?>)</h5>

                <!-- Add Comment Form -->
                <div class="mb-4 card">
                    <div class="card-body">
                        <form action="<?php echo e(route('admins.listings.comments.store', $listing->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="new_comment"><?php echo e(__('Add Comment')); ?></label>
                                <textarea name="comment" id="new_comment"
                                    class="form-control <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    rows="3"
                                    placeholder="<?php echo e(__('Write your comment here...')); ?>"
                                    required></textarea>
                                <?php $__errorArgs = ['comment'];
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-comment"></i> <?php echo e(__('Post Comment')); ?>

                            </button>
                        </form>
                    </div>
                </div>

                <!-- Comments List -->
                <?php $__empty_1 = true; $__currentLoopData = $listing->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-4 card comment-item">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 font-weight-bold">
                                        <?php echo e($comment->user->name ?? __('Unknown User')); ?>

                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> <?php echo e($comment->created_at->format('Y-m-d H:i')); ?>

                                    </small>
                                </div>
                                <form action="<?php echo e(route('admins.listings.comments.destroy', [$listing->id, $comment->id])); ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete this comment?')); ?>');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <p class="mb-2"><?php echo e($comment->comment); ?></p>

                            <!-- Reply Form (Hidden by default) -->
                            <div class="reply-form-container" style="display: none;" id="reply-form-<?php echo e($comment->id); ?>">
                                <form action="<?php echo e(route('admins.listings.comments.reply', [$listing->id, $comment->id])); ?>" method="POST" class="mt-2">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group mb-2">
                                        <textarea name="comment"
                                            class="form-control"
                                            rows="2"
                                            placeholder="<?php echo e(__('Write your reply here...')); ?>"
                                            required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-reply"></i> <?php echo e(__('Reply')); ?>

                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary cancel-reply" data-comment-id="<?php echo e($comment->id); ?>">
                                        <?php echo e(__('Cancel')); ?>

                                    </button>
                                </form>
                            </div>

                            <!-- Reply Button -->
                            <button type="button" class="btn btn-sm btn-outline-primary reply-btn" data-comment-id="<?php echo e($comment->id); ?>">
                                <i class="fas fa-reply"></i> <?php echo e(__('Reply')); ?>

                            </button>

                            <!-- Replies List -->
                            <?php if($comment->replies->count() > 0): ?>
                                <div class="mt-3 ml-4 replies-container" style="border-left: 3px solid #e0e0e0; padding-left: 1rem;">
                                    <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-3 card bg-light">
                                            <div class="card-body py-2">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <div>
                                                        <h6 class="mb-1 small font-weight-bold">
                                                            <?php echo e($reply->user->name ?? __('Unknown User')); ?>

                                                        </h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock"></i> <?php echo e($reply->created_at->format('Y-m-d H:i')); ?>

                                                        </small>
                                                    </div>
                                                    <form action="<?php echo e(route('admins.listings.comments.destroy', [$listing->id, $reply->id])); ?>"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('<?php echo e(__('Are you sure you want to delete this reply?')); ?>');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <p class="mb-0 small"><?php echo e($reply->comment); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert alert-info">
                        <?php echo e(__('No comments yet. Be the first to comment!')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admins.listings.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> <?php echo e(__('Back to List')); ?>

                    </a>
                    <div>
                        <a href="<?php echo e(route('admins.listings.edit', $listing->id)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> <?php echo e(__('Edit Listing')); ?>

                        </a>
                        <form action="<?php echo e(route('admins.listings.destroy', $listing->id)); ?>"
                              id="delete-form-<?php echo e($listing->id); ?>"
                              method="POST"
                              class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                    class="btn btn-danger"
                                    onclick="confirmDelete(<?php echo e($listing->id); ?>); event.preventDefault();">
                                <i class="fas fa-trash-alt"></i> <?php echo e(__('Delete Listing')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(listingId) {
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
                    document.getElementById('delete-form-' + listingId).submit();
                }
            });
        }

        // Reply button functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Show reply form
            document.querySelectorAll('.reply-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const replyForm = document.getElementById('reply-form-' + commentId);
                    if (replyForm) {
                        replyForm.style.display = 'block';
                        this.style.display = 'none';
                        replyForm.querySelector('textarea').focus();
                    }
                });
            });

            // Cancel reply
            document.querySelectorAll('.cancel-reply').forEach(function(button) {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const replyForm = document.getElementById('reply-form-' + commentId);
                    const replyBtn = document.querySelector('.reply-btn[data-comment-id="' + commentId + '"]');
                    if (replyForm) {
                        replyForm.style.display = 'none';
                        replyForm.querySelector('textarea').value = '';
                    }
                    if (replyBtn) {
                        replyBtn.style.display = 'inline-block';
                    }
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
<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/listings/show.blade.php ENDPATH**/ ?>