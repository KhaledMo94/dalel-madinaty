<x-dashboard.main-layout>

    <div class="card-body">
        <form class="my-3" action="{{ route('admins.option-values.update', $optionValue->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="option_id">{{ __('Option') }}</label>
                <select name="option_id" class="form-control" id="option_id" required>
                    <option value="">{{ __('Select Option') }}</option>
                    @foreach($options as $option)
                        <option value="{{ $option->id }}" {{ old('option_id', $optionValue->option_id) == $option->id ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name_ar">{{ __('Name In Arabic') }}</label>
                <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="{{ __('Name') }}"
                    required value="{{ old('name_ar', $optionValue->getTranslation('name', 'ar')) }}">
            </div>

            <div class="form-group">
                <label for="name_en">{{ __('Name In English') }}</label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="{{ __('Name') }}" required
                    value="{{ old('name_en', $optionValue->getTranslation('name', 'en')) }}">
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Update') }}</button>
        </form>

    </div>

</x-dashboard.main-layout>

