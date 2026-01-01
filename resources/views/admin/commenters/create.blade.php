<x-dashboard.main-layout>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="mb-3 text-gray-800 h3">{{ __('Create Commenter') }}</h1>

        <form class="my-3" action="{{ route('admins.commenters.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{ __('Name') }}" required value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email_verified" class="">{{ __('Email Verified') }}</label>
                <select name="email_verified" class="form-control" id="email_verified">
                    <option value="1" @selected(old('email_verified') == true)>{{ __('Yes') }}</option>
                    <option value="0" @selected(old('email_verified') == false)>{{ __('No') }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="country_code">{{ __('Country Code') }}</label>
                <input type="text" name="country_code" id="country_code" 
                    class="form-control @error('country_code') is-invalid @enderror" 
                    placeholder="{{ __('Country Code') }}" required value="{{ old('country_code', '+20') }}">
                @error('country_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                <input type="text" name="phone_number" id="phone_number" 
                    class="form-control @error('phone_number') is-invalid @enderror" 
                    placeholder="{{ __('Phone Number (e.g., 01234567890)') }}" required 
                    value="{{ old('phone_number') }}">
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">{{ __('Egyptian phone format: +20XXXXXXXXXX (e.g., +201234567890)') }}</small>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="{{ __('Password') }}" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_verified">{{ __('Phone Verified') }}</label>
                <select name="phone_verified" class="form-control" id="phone_verified">
                    <option value="1" @selected(old('phone_verified') == true)>{{ __('Yes') }}</option>
                    <option value="0" @selected(old('phone_verified') == false)>{{ __('No') }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="commenter_id">{{ __('Commenter Listing') }} <span class="text-danger">*</span></label>
                <select name="commenter_id" id="commenter_id" 
                    class="form-control select2 @error('commenter_id') is-invalid @enderror" required>
                    <option value="">{{ __('Select Listing') }}</option>
                    @foreach($listings as $listing)
                        <option value="{{ $listing->id }}" @selected(old('commenter_id') == $listing->id)>
                            {{ $listing->getTranslation('name', app()->getLocale()) }}
                        </option>
                    @endforeach
                </select>
                @error('commenter_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">{{ __('Select the listing this commenter can reply to comments on') }}</small>
            </div>

            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active" @selected(old('status') == 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(old('status') == 'inactive')>{{ __('Banned') }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image" class="for">{{ __('Image') }}</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*" placeholder="{{ __('Image') }}">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Create Commenter') }}</button>
            <a href="{{ route('admins.commenters.index') }}" class="btn btn-secondary btn-block">{{ __('Cancel') }}</a>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Commenter Listing
            $('#commenter_id').select2({
                placeholder: "{{ __('Select Listing') }}",
                allowClear: false
            });
        });
    </script>

</x-dashboard.main-layout>

