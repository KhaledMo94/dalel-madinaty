<x-dashboard.main-layout>

    <div class="card-body">
        <form class="my-3" action="{{ route('admins.options.update', $option->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name_ar">{{ __('Name In Arabic') }}</label>
                <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="{{ __('Name') }}"
                    required value="{{ old('name_ar', $option->getTranslation('name', 'ar')) }}">
            </div>

            <div class="form-group">
                <label for="name_en">{{ __('Name In English') }}</label>
                <input type="text" name="name_en" class="form-control" id="name_en"
                    placeholder="{{ __('Name') }}" required
                    value="{{ old('name_en', $option->getTranslation('name', 'en')) }}">
            </div>

            <div class="form-group">
                <label for="description_ar">{{ __('Description In Arabic') }}</label>
                <textarea name="description_ar" class="form-control" id="description_ar"
                    placeholder="{{ __('Description in Arabic') }}">{{ old('description_ar', $option->getTranslation('description', 'ar')) }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_en">{{ __('Description In English') }}</label>
                <textarea name="description_en" class="form-control" id="description_en"
                    placeholder="{{ __('Description in English') }}">{{ old('description_en', $option->getTranslation('description', 'en')) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-block mb_40">{{ __('Update') }}</button>
        </form>

    </div>

</x-dashboard.main-layout>

