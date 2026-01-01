<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
    @endphp
    <h1 class="mb-3 text-gray-800 h3">{{ __('Duplicate Branch') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('Branch Information') }}</h6>
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
            <form class="my-3" action="{{ route('admins.branches.store') }}" method="post"
                enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Address In Arabic') }}</label>
                            <input type="text" name="address_ar" class="form-control @error('address_ar') is-invalid @enderror" 
                                value="{{ old('address_ar', $branch->getTranslation('address', 'ar')) }}">
                            @error('address_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Address In English') }}</label>
                            <input type="text" name="address_en" class="form-control @error('address_en') is-invalid @enderror" 
                                value="{{ old('address_en', $branch->getTranslation('address', 'en')) }}">
                            @error('address_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('City') }}</label>
                            <select id="city_select" class="form-control select2 city-select">
                                @if($branch->area && $branch->area->city)
                                    <option value="{{ $branch->area->city->id }}" selected>
                                        {{ $branch->area->city->getTranslation('name', $locale) }}
                                    </option>
                                @else
                                    <option value="">{{ __('Select City') }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Area') }}</label>
                            <select name="area_id" id="area_select" class="form-control select2 area-select @error('area_id') is-invalid @enderror" required>
                                @if($branch->area)
                                    <option value="{{ $branch->area_id }}" selected>
                                        {{ $branch->area->getTranslation('name', $locale) }}
                                    </option>
                                @endif
                            </select>
                            @error('area_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ __('Listing Name') }}</label>
                            <select name="listing_id" id="listing_id" class="form-control select2 service-provider-select @error('listing_id') is-invalid @enderror" required>
                                @if($branch->listing)
                                    <option value="{{ $branch->listing_id }}" selected>
                                        {{ $branch->listing->getTranslation('name', $locale) }}
                                    </option>
                                @endif
                            </select>
                            @error('listing_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', $branch->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ __('Alternate Phone') }}</label>
                            <input type="text" name="phone_alt" class="form-control @error('phone_alt') is-invalid @enderror" 
                                value="{{ old('phone_alt', $branch->phone_alt) }}">
                            @error('phone_alt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Latitude') }}</label>
                            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" 
                                value="{{ old('latitude', $branch->latitude) }}">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Longitude') }}</label>
                            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" 
                                value="{{ old('longitude', $branch->longitude) }}">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Create') }}
                    </button>
                    <a href="{{ route('admins.branches.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.service-provider-select').select2({
                placeholder: "{{ __('Search for a listing') }}",
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
                placeholder: "{{ __('Select City') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('admins.cities.search') }}",
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
                placeholder: "{{ __('Select Area') }}",
                ajax: {
                    url: "{{ route('admins.areas.search') }}",
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

</x-dashboard.main-layout>

