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

    <h1 class="mb-3 text-gray-800 h3"><?php echo e(__('Comments for')); ?>: <?php echo e($listing->getTranslation('name', $locale)); ?></h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"><?php echo e(__('Listing Comments')); ?> (<?php echo e($comments->total()); ?>)</h6>
            <div>
                <a href="<?php echo e(route('admins.listings.show', $listing->id)); ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> <?php echo e(__('View Listing')); ?>

                </a>
                <a href="<?php echo e(route('admins.listings.index')); ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo e(__('Back to Listings')); ?>

                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Listing Info -->
            <div class="mb-4 pb-3 border-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="font-weight-bold"><?php echo e(__('Listing Information')); ?></h5>
                        <p class="mb-1"><strong><?php echo e(__('Name')); ?>:</strong> <?php echo e($listing->getTranslation('name', $locale)); ?></p>
                        <p class="mb-1">
                            <strong><?php echo e(__('Category')); ?>:</strong> 
                            <?php echo e($listing->category?->getTranslation('name', $locale) ?? __('Uncategorized')); ?>

                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if($listing->image): ?>
                            <img src="<?php echo e(asset('storage/' . $listing->image)); ?>" 
                                 alt="<?php echo e(__('Listing Image')); ?>" 
                                 class="rounded"
                                 style="max-width: 150px; max-height: 150px;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Add Comment Form -->
            <div class="mb-4 card">
                <div class="card-body">
                    <h6 class="font-weight-bold mb-3"><?php echo e(__('Add Comment')); ?></h6>
                    <form action="<?php echo e(route('admins.listings.comments.store', $listing->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <textarea name="comment" 
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
            <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mb-4 card comment-item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 font-weight-bold">
                                    <i class="fas fa-user"></i> <?php echo e($comment->user->name ?? __('Unknown User')); ?>

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
                                    <i class="fas fa-trash"></i> <?php echo e(__('Delete')); ?>

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
                                <h6 class="small font-weight-bold mb-2">
                                    <i class="fas fa-comments"></i> <?php echo e(__('Replies')); ?> (<?php echo e($comment->replies->count()); ?>)
                                </h6>
                                <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3 card bg-light">
                                        <div class="card-body py-2">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <div>
                                                    <h6 class="mb-1 small font-weight-bold">
                                                        <i class="fas fa-user"></i> <?php echo e($reply->user->name ?? __('Unknown User')); ?>

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
                    <i class="fas fa-info-circle"></i> <?php echo e(__('No comments yet. Be the first to comment!')); ?>

                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($comments->links()); ?>

            </div>
        </div>
    </div>

    <script>
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

<?php /**PATH C:\laragon\www\dalel-madinaty\resources\views/admin/listings/comments.blade.php ENDPATH**/ ?>