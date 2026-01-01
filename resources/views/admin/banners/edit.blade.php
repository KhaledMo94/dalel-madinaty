<x-dashboard.main-layout>
    <h1 class="mb-3 text-gray-800 h3">{{ __('Edit Banner') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Banner Information') }}</h6>
        </div>
    <div class="card-body" data-aos="fade-up">
            <form action="{{ route('admins.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <div class="form-group">
                    <label for="title_ar">{{ __('Banner Title In Arabic') }}</label>
                    <input type="text" name="title_ar" id="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="{{ old('title_ar') ?? $banner->getTranslation('title','ar') }}">
                    @error('title_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            
            <div class="form-group">
                    <label for="title_en">{{ __('Banner Title In English') }}</label>
                    <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') ?? $banner->getTranslation('title','en') }}">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-group">
                    <label>{{ __('Current Image') }}</label>
                <div>
                    @if ($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" class="img-thumbnail" style="max-width: 300px; max-height: 300px;" alt="{{ __('Banner Image') }}">
                    @else
                            <p class="text-muted">{{ __('No Image') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                    <label for="image">{{ __('Change Image') }}</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control-file @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">{{ __('Leave empty to keep current image. Maximum file size: 5MB') }}</small>
                </div>

                <div class="form-group">
                    <label for="listing_id">{{ __('Listing') }} <small class="text-muted">({{ __('Optional') }})</small></label>
                    <select name="listing_id" id="listing_id" class="form-control select2-ajax @error('listing_id') is-invalid @enderror">
                        <option value="">{{ __('Select a listing') }}</option>
                        @if($banner->listing_id)
                            <option value="{{ $banner->listing_id }}" selected>
                                {{ $banner->listing ? $banner->listing->getTranslation('name', app()->getLocale()) : __('Listing #') . $banner->listing_id }}
                            </option>
                        @endif
                    </select>
                    @error('listing_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">{{ __('Search and select a listing to link this banner') }}</small>
            </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Update') }}
                    </button>
                    <a href="{{ route('admins.banners.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                    </a>
                </div>
        </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
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
            @if($banner->listing_id && $banner->listing)
                var selectedListingId = {{ $banner->listing_id }};
                var selectedListingName = @json($banner->listing->getTranslation('name', app()->getLocale()));
                var option = new Option(selectedListingName, selectedListingId, true, true);
                $('#listing_id').append(option).trigger('change');
            @endif
        });
    </script>
</x-dashboard.main-layout>
