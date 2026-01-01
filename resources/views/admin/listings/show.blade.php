<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    @endphp

    <h1 class="mb-3 text-gray-800 h3">{{ __('Listing Details') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Listing Information') }}</h6>
            <div>
                <a href="{{ route('admins.listings.edit', $listing->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a href="{{ route('admins.listings.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Main Image -->
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        @if ($listing->image)
                            <img src="{{ asset('storage/' . $listing->image) }}"
                                 alt="{{ __('Listing Image') }}"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; max-width: 100%;">
                        @else
                            <div class="alert alert-info">
                                {{ __('No image available') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Banner Image -->
                @if($listing->banner_image)
                <div class="col-md-12 mb-4">
                    <label class="font-weight-bold">{{ __('Banner Image') }}</label>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $listing->banner_image) }}"
                             alt="{{ __('Banner Image') }}"
                             class="img-fluid rounded shadow"
                             style="max-height: 300px; max-width: 100%;">
                    </div>
                </div>
                @endif

                <!-- Basic Information -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Name (English)') }}</label>
                        <p class="form-control-plaintext">{{ $listing->getTranslation('name', 'en') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Name (Arabic)') }}</label>
                        <p class="form-control-plaintext">{{ $listing->getTranslation('name', 'ar') }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Description (English)') }}</label>
                        <p class="form-control-plaintext">{{ $listing->getTranslation('description', 'en') }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Description (Arabic)') }}</label>
                        <p class="form-control-plaintext">{{ $listing->getTranslation('description', 'ar') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Category') }}</label>
                        <p class="form-control-plaintext">
                            {{ $listing->category?->getTranslation('name', $locale) ?? __('Uncategorized') }}
                            <br>
                            <small class="text-muted">{{ $listing->category?->getTranslation('name', $rev_locale) ?? '' }}</small>
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Status') }}</label>
                        <p class="form-control-plaintext">
                            @if ($listing->status == 'active')
                                <span class="badge badge-success badge-lg">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-secondary badge-lg">{{ __('Inactive') }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Location Information -->
                @if($listing->latitude && $listing->longitude)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Latitude') }}</label>
                        <p class="form-control-plaintext">{{ $listing->latitude }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Longitude') }}</label>
                        <p class="form-control-plaintext">{{ $listing->longitude }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Location on Map') }}</label>
                        <p class="form-control-plaintext">
                            <a href="https://www.google.com/maps?q={{ $listing->latitude }},{{ $listing->longitude }}"
                               target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-map-marker-alt"></i> {{ __('View on Google Maps') }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif

                <!-- Social Media Links -->
                @if($listing->fb_link || $listing->tt_link || $listing->insta_link)
                <div class="col-md-12">
                    <label class="font-weight-bold">{{ __('Social Media Links') }}</label>
                    <div class="form-group">
                        @if($listing->fb_link)
                            <p class="form-control-plaintext">
                                <strong>{{ __('Facebook') }}:</strong>
                                <a href="{{ $listing->fb_link }}" target="_blank">{{ $listing->fb_link }}</a>
                            </p>
                        @endif
                        @if($listing->tt_link)
                            <p class="form-control-plaintext">
                                <strong>{{ __('TikTok') }}:</strong>
                                <a href="{{ $listing->tt_link }}" target="_blank">{{ $listing->tt_link }}</a>
                            </p>
                        @endif
                        @if($listing->insta_link)
                            <p class="form-control-plaintext">
                                <strong>{{ __('Instagram') }}:</strong>
                                <a href="{{ $listing->insta_link }}" target="_blank">{{ $listing->insta_link }}</a>
                            </p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- File -->
                @if($listing->file)
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('File') }}</label>
                        <p class="form-control-plaintext">
                            <a href="{{ asset('storage/' . $listing->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-file"></i> {{ __('View File') }}
                            </a>
                        </p>
                    </div>
                </div>
                @endif

                <!-- Statistics -->
                <div class="col-md-12 mt-3">
                    <h5 class="mb-3">{{ __('Statistics') }}</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $listing->branches_count ?? 0 }}</h3>
                                    <p class="mb-0">{{ __('Branches') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $listing->amenities->count() ?? 0 }}</h3>
                                    <p class="mb-0">{{ __('Amenities') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $listing->images->count() ?? 0 }}</h3>
                                    <p class="mb-0">{{ __('Images') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $listing->users->count() ?? 0 }}</h3>
                                    <p class="mb-0">{{ __('Likes') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                @if($listing->amenities->count() > 0)
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Amenities') }}</label>
                        <div>
                            @foreach($listing->amenities as $amenity)
                                <span class="badge badge-info badge-lg mr-2 mb-2">
                                    {{ $amenity->getTranslation('name', $locale) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Images Gallery -->
                @if($listing->images->count() > 0)
                <div class="col-md-12 mt-3">
                    <label class="font-weight-bold">{{ __('Gallery Images') }}</label>
                    <div class="row">
                        @foreach($listing->images as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                     alt="{{ __('Listing Image') }}"
                                     class="img-fluid rounded shadow"
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Created At') }}</label>
                        <p class="form-control-plaintext">
                            {{ $listing->created_at ? $listing->created_at->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Updated At') }}</label>
                        <p class="form-control-plaintext">
                            {{ $listing->updated_at ? $listing->updated_at->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="mb-4 font-weight-bold">{{ __('Comments') }} ({{ $listing->comments->count() }})</h5>

                <!-- Add Comment Form -->
                <div class="mb-4 card">
                    <div class="card-body">
                        <form action="{{ route('admins.listings.comments.store', $listing->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="new_comment">{{ __('Add Comment') }}</label>
                                <textarea name="comment" id="new_comment"
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
                @forelse($listing->comments as $comment)
                    <div class="mb-4 card comment-item">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 font-weight-bold">
                                        {{ $comment->user->name ?? __('Unknown User') }}
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
                                        <i class="fas fa-trash"></i>
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
                                    @foreach($comment->replies as $reply)
                                        <div class="mb-3 card bg-light">
                                            <div class="card-body py-2">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <div>
                                                        <h6 class="mb-1 small font-weight-bold">
                                                            {{ $reply->user->name ?? __('Unknown User') }}
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
                        {{ __('No comments yet. Be the first to comment!') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admins.listings.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
                    </a>
                    <div>
                        <a href="{{ route('admins.listings.edit', $listing->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> {{ __('Edit Listing') }}
                        </a>
                        <form action="{{ route('admins.listings.destroy', $listing->id) }}"
                              id="delete-form-{{ $listing->id }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger"
                                    onclick="confirmDelete({{ $listing->id }}); event.preventDefault();">
                                <i class="fas fa-trash-alt"></i> {{ __('Delete Listing') }}
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
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You will not be able to revert this!') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Yes, delete it!') }}"
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

</x-dashboard.main-layout>
