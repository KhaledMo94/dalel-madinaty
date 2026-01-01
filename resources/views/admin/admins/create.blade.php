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

        <h1 class="mb-3 text-gray-800 h3">{{ __('Create Admin') }}</h1>

        <form class="my-3" action="{{ route('admins.admins.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('Name') }}"
                    required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" class="form-control" id="email"
                    placeholder="{{ __('Email') }}" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="{{ __('Password') }}" required value="{{ old('password') }}">
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" class="form-control"
                    id="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                    value="{{ old('password_confirmation') }}">
            </div>


            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="active" @selected(old('status') == 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(old('status') == 'inactive')>{{ __('Banned') }}</option>
                </select>
            </div>
            @php
                $permissions_tr = [];
                foreach ($permissions as $value) {
                    $permissions_tr[] = [
                        'id' => $value->id,
                        'name' => __(ucfirst($value->name)),
                    ];
                }
            @endphp

            <div class="form-group">
                <label for="permissions">{{ __('Permissions') }} <span class="text-danger">*</span></label>
                <select name="permissions[]" class="form-control select2" id="permissions" required multiple>
                    @foreach ($permissions_tr as $permission)
                        <option value="{{ $permission['id'] }}" @selected(in_array($permission['id'], old('permissions', [])))>
                            {{ $permission['name'] }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">{{ __('Select one or more permissions for this admin') }}</small>
            </div>

            <div class="form-group">
                <label for="image" class="for">{{ __('Image') }}</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*"
                    placeholder="{{ __('Image') }}">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Create Admin') }}</button>
            <a href="{{ route('admins.admins.index') }}" class="btn btn-secondary btn-block">{{ __('Cancel') }}</a>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Permissions
            $('#permissions').select2({
                placeholder: "{{ __('Select Permissions') }}",
                allowClear: false
            });
        });
    </script>

    @if (app()->getLocale() == 'ar')
        <style>
            .select2-results__option--selectable{
                display: flex
            }
        </style>
    @endif
</x-dashboard.main-layout>
