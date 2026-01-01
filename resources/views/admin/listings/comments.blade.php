<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    @endphp

    <h1 class="mb-3 text-gray-800 h3">{{ __('Comments for') }}: {{ $listing->getTranslation('name', $locale) }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Listing Comments') }} ({{ $comments->total() }})</h6>
            <div>
                <a href="{{ route('admins.listings.show', $listing->id) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> {{ __('View Listing') }}
                </a>
                <a href="{{ route('admins.listings.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> {{ __('Back to Listings') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Listing Info -->
            <div class="mb-4 pb-3 border-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="font-weight-bold">{{ __('Listing Information') }}</h5>
                        <p class="mb-1"><strong>{{ __('Name') }}:</strong> {{ $listing->getTranslation('name', $locale) }}</p>
                        <p class="mb-1">
                            <strong>{{ __('Category') }}:</strong> 
                            {{ $listing->category?->getTranslation('name', $locale) ?? __('Uncategorized') }}
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        @if($listing->image)
                            <img src="{{ asset('storage/' . $listing->image) }}" 
                                 alt="{{ __('Listing Image') }}" 
                                 class="rounded"
                                 style="max-width: 150px; max-height: 150px;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Add Comment Form -->
            <div class="mb-4 card">
                <div class="card-body">
                    <h6 class="font-weight-bold mb-3">{{ __('Add Comment') }}</h6>
                    <form action="{{ route('admins.listings.comments.store', $listing->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" 
                                class="form-control @error('comment') is-invalid @enderror" 
                                rows="3" 
                                placeholder="{{ __('Write your comment here...') }}" 
                                required></textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-comment"></i> {{ __('Post Comment') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Comments List -->
            @forelse($comments as $comment)
                <div class="mb-4 card comment-item">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 font-weight-bold">
                                    <i class="fas fa-user"></i> {{ $comment->user->name ?? __('Unknown User') }}
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> {{ $comment->created_at->format('Y-m-d H:i') }}
                                </small>
                            </div>
                            <form action="{{ route('admins.listings.comments.destroy', [$listing->id, $comment->id]) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this comment?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                        <p class="mb-2">{{ $comment->comment }}</p>
                        
                        <!-- Reply Form (Hidden by default) -->
                        <div class="reply-form-container" style="display: none;" id="reply-form-{{ $comment->id }}">
                            <form action="{{ route('admins.listings.comments.reply', [$listing->id, $comment->id]) }}" method="POST" class="mt-2">
                                @csrf
                                <div class="form-group mb-2">
                                    <textarea name="comment" 
                                        class="form-control" 
                                        rows="2" 
                                        placeholder="{{ __('Write your reply here...') }}" 
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-reply"></i> {{ __('Reply') }}
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary cancel-reply" data-comment-id="{{ $comment->id }}">
                                    {{ __('Cancel') }}
                                </button>
                            </form>
                        </div>

                        <!-- Reply Button -->
                        <button type="button" class="btn btn-sm btn-outline-primary reply-btn" data-comment-id="{{ $comment->id }}">
                            <i class="fas fa-reply"></i> {{ __('Reply') }}
                        </button>

                        <!-- Replies List -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-3 ml-4 replies-container" style="border-left: 3px solid #e0e0e0; padding-left: 1rem;">
                                <h6 class="small font-weight-bold mb-2">
                                    <i class="fas fa-comments"></i> {{ __('Replies') }} ({{ $comment->replies->count() }})
                                </h6>
                                @foreach($comment->replies as $reply)
                                    <div class="mb-3 card bg-light">
                                        <div class="card-body py-2">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <div>
                                                    <h6 class="mb-1 small font-weight-bold">
                                                        <i class="fas fa-user"></i> {{ $reply->user->name ?? __('Unknown User') }}
                                                    </h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock"></i> {{ $reply->created_at->format('Y-m-d H:i') }}
                                                    </small>
                                                </div>
                                                <form action="{{ route('admins.listings.comments.destroy', [$listing->id, $reply->id]) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this reply?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <p class="mb-0 small">{{ $reply->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> {{ __('No comments yet. Be the first to comment!') }}
                </div>
            @endforelse

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $comments->links() }}
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

</x-dashboard.main-layout>

