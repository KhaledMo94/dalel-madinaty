<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
        $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
    @endphp

    <h1 class="mb-3 text-gray-800 h3">{{ __('Offer Details') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Offer Information') }}</h6>
            <div>
                <a href="{{ route('admins.offers.edit', $offer->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
                <a href="{{ route('admins.offers.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="text-center">
                        @if ($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}" 
                                 alt="{{ __('Offer Image') }}" 
                                 class="img-fluid rounded shadow"
                                 style="max-height: 400px; max-width: 100%;">
                        @else
                            <div class="alert alert-info">
                                {{ __('No image available') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Content (English)') }}</label>
                        <p class="form-control-plaintext">{{ $offer->getTranslation('content', 'en') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Content (Arabic)') }}</label>
                        <p class="form-control-plaintext">{{ $offer->getTranslation('content', 'ar') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Listing') }}</label>
                        <p class="form-control-plaintext">
                            {{ $offer->listing?->getTranslation('name', $locale) ?? __('N/A') }}
                            <br>
                            <small class="text-muted">{{ $offer->listing?->getTranslation('name', $rev_locale) ?? '' }}</small>
                        </p>
                    </div>
                </div>

                @if($offer->listing)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Listing Logo') }}</label>
                        <div>
                            @if ($offer->listing->image)
                                <img src="{{ asset('storage/' . $offer->listing->image) }}" 
                                     alt="{{ __('Listing Logo') }}" 
                                     class="rounded"
                                     style="max-width: 150px; max-height: 150px;">
                            @else
                                <p class="text-muted">{{ __('No image available') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Start Date') }}</label>
                        <p class="form-control-plaintext">
                            {{ $offer->start_date ? $offer->start_date->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('End Date') }}</label>
                        <p class="form-control-plaintext">
                            {{ $offer->end_date ? $offer->end_date->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Status') }}</label>
                        <p class="form-control-plaintext">
                            @if ($offer->is_active)
                                <span class="badge badge-success badge-lg">{{ __('Active') }}</span>
                            @else
                                <span class="badge badge-secondary badge-lg">{{ __('Inactive') }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Created At') }}</label>
                        <p class="form-control-plaintext">
                            {{ $offer->created_at ? $offer->created_at->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Updated At') }}</label>
                        <p class="form-control-plaintext">
                            {{ $offer->updated_at ? $offer->updated_at->format('Y-m-d H:i') : __('N/A') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admins.offers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
                    </a>
                    <div>
                        <a href="{{ route('admins.offers.edit', $offer->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> {{ __('Edit Offer') }}
                        </a>
                        <form action="{{ route('admins.offers.destroy', $offer->id) }}" 
                              id="delete-form-{{ $offer->id }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="confirmDelete({{ $offer->id }}); event.preventDefault();">
                                <i class="fas fa-trash-alt"></i> {{ __('Delete Offer') }}
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
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You will not be able to revert this!') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + offerId).submit();
                }
            });
        }
    </script>

</x-dashboard.main-layout>

