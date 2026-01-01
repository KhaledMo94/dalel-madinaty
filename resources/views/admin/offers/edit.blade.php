<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
    @endphp
    <h1 class="mb-3 text-gray-800 h3">{{ __('Edit Offer') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Offer Information') }}</h6>
        </div>
        <div class="card-body" data-aos="fade-up">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="my-3" action="{{ route('admins.offers.update', $offer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_en">{{ __('Content (English)') }}</label>
                            <input type="text" name="content_en" id="content_en" 
                                class="form-control @error('content_en') is-invalid @enderror" 
                                placeholder="{{ __('Content (English)') }}"
                                required value="{{ old('content_en', $offer->getTranslation('content', 'en')) }}" maxlength="150">
                            @error('content_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="content_ar">{{ __('Content (Arabic)') }}</label>
                            <input type="text" name="content_ar" id="content_ar" 
                                class="form-control @error('content_ar') is-invalid @enderror" 
                                placeholder="{{ __('Content (Arabic)') }}"
                                required value="{{ old('content_ar', $offer->getTranslation('content', 'ar')) }}" maxlength="150">
                            @error('content_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="listing_id">{{ __('Listing') }}</label>
                            <select name="listing_id" id="listing_id" 
                                class="form-control select2 listing-select @error('listing_id') is-invalid @enderror" 
                                style="width:100%" required>
                                @if($offer->listing)
                                    <option value="{{ $offer->listing_id }}" selected>
                                        {{ $offer->listing->getTranslation('name', $locale) }}
                                    </option>
                                @endif
                            </select>
                            @error('listing_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">{{ __('Start Date') }}</label>
                            <input type="datetime-local" name="start_date" id="start_date" 
                                class="form-control @error('start_date') is-invalid @enderror" 
                                required value="{{ old('start_date', $offer->start_date ? $offer->start_date->format('Y-m-d\TH:i') : '') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">{{ __('End Date') }}</label>
                            <input type="datetime-local" name="end_date" id="end_date" 
                                class="form-control @error('end_date') is-invalid @enderror" 
                                required value="{{ old('end_date', $offer->end_date ? $offer->end_date->format('Y-m-d\TH:i') : '') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label><br>

                            @if($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" 
                                     alt="{{ __('Offer Image') }}" 
                                     class="mb-3 rounded" 
                                     style="max-width: 200px; max-height: 200px;">
                            @else
                                <p class="text-muted">{{ __('No image uploaded') }}</p>
                            @endif

                            <input type="file" name="image" id="image" 
                                class="form-control @error('image') is-invalid @enderror" 
                                accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">{{ __('Maximum file size: 5MB. Leave empty to keep current image.') }}</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Update') }}
                    </button>
                    <a href="{{ route('admins.offers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Listing
            $('#listing_id').select2({
                placeholder: "{{ __('Search for a listing') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('admins.listings.search') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(listing => ({
                                id: listing.id,
                                text: listing.name
                            }))
                        };
                    },
                    cache: true
                }
            });

            // Pre-select existing listing
            @if($offer->listing)
                var listingOption = new Option("{{ $offer->listing->getTranslation('name', $locale) }}", "{{ $offer->listing_id }}", true, true);
                $('#listing_id').append(listingOption).trigger('change');
            @endif
        });
    </script>

</x-dashboard.main-layout>
