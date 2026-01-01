<x-dashboard.main-layout>

    @php
        $locale = app()->getLocale();
    @endphp
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
        <form class="my-3" action="{{ route('admins.branches.update', $branch->id) }}" method="post"
            enctype="application/x-www-form-urlencoded">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Address In Arabic') }}</label>
                        <input type="text" name="address_ar" class="form-control"
                            value="{{ old('address_ar') ?? $branch->getTranslation('address', 'ar') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Address In English') }}</label>
                        <input type="text" name="address_en" class="form-control"
                            value="{{ old('address_en') ?? $branch->getTranslation('address', 'en') }}">
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
                        <select name="area_id" id="area_select" class="form-control select2 area-select" required>
                            @if($branch->area)
                                <option value="{{ $branch->area_id }}" selected>
                                    {{ $branch->area->getTranslation('name', $locale) }}
                                </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Service Provider') }}</label>
                        <select name="listing_id" class="form-control select2 service-provider-select"
                            required>
                            <option value="{{ $branch->listing_id }}" selected>
                                {{ $branch->listing->getTranslation('name', $locale) }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') ?? $branch->phone }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Alternate Phone') }}</label>
                        <input type="text" name="phone_alt" class="form-control" value="{{ old('phone_alt') ?? $branch->phone_alt }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Latitude') }}</label>
                        <input type="text" name="latitude" class="form-control" value="{{ old('latitude') ?? $branch->latitude}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Longitude') }}</label>
                        <input type="text" name="longitude" class="form-control" value="{{ old('longitude') ?? $branch->longitude }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
        </form>
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
