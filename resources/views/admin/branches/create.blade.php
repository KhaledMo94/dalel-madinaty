<x-dashboard.main-layout>

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
                        <input type="text" name="address_ar" class="form-control" value="{{ old('address_ar')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Address In English') }}</label>
                        <input type="text" name="address_en" class="form-control" value="{{ old('address_en') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('City') }}</label>
                        <select id="city_select" class="form-control select2 city-select">
                            <option value="">{{ __('Select City') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Area') }}</label>
                        <select name="area_id" id="area_select" class="form-control select2 area-select" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Listing Name') }}</label>
                        <select name="listing_id" id="listing_id" class="form-control select2 service-provider-select @error('listing_id') is-invalid @enderror" required>
                        </select>
                        @error('listing_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">{{ __('Alternate Phone') }}</label>
                        <input type="text" name="phone_alt" class="form-control" value="{{ old('phone_alt') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Latitude') }}</label>
                        <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Longitude') }}</label>
                        <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
        </form>
    </div>

    <script>
    $(document).ready(function () {
        $('.service-provider-select').select2({
            placeholder: "{{ __('Search for a service provider') }}",
            ajax: {
                url: "{{ route('admins.listings.search') }}",
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
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
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
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
                data: function (params) {
                    return {
                        q: params.term,
                        city_id: $('#city_select').val()
                    };
                },
                processResults: function (data) {
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
