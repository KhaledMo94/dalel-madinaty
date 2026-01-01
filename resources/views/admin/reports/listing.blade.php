<x-dashboard.main-layout>
    @php
        $rev_locale = app()->getLocale() == 'ar' ? 'en' : 'ar';
    @endphp
    <h1 class="mb-3 text-gray-800 h3">{{ __('Export Listings') }}</h1>

    <div class="card-body">
        <form action="{{ route('admins.reports.listings.export') }}" method="POST">
            @csrf

            <div id="category_wrapper" class="my-2 form-group">
                <label for="category">{{ __('Category') }}</label>
                <select name="category_ids[]" class="form-control" id="category" multiple></select>
                <small class="form-text text-muted">{{ __('Leave empty to export all categories') }}</small>
            </div>

            <div class="row">
                <div class="my-2 form-group col-md-6">
                    <label for="from">{{ __('From') }}</label>
                    <input type="date" name="from" class="form-control" id="from"
                        value="{{ old('from') }}">
                </div>
                <div class="my-2 form-group col-md-6">
                    <label for="to">{{ __('To') }}</label>
                    <input type="date" name="to" class="form-control" id="to"
                        value="{{ old('to') }}">
                </div>
            </div>

            <button type="submit" class="my-5 btn btn-success btn-block">{{ __('Export') }}</button>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: "{{ __('Search for a category') }}",
                width: '100%',
                ajax: {
                    url: "{{ route('admins.categories.search') }}",
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(category => ({
                                id: category.id,
                                text: category.name
                            }))
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

</x-dashboard.main-layout>
