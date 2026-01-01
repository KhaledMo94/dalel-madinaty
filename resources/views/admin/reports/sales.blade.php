<x-dashboard.main-layout>
    @php
        $rev_locale = app()->getLocale() == 'ar' ? 'en' : 'ar';
    @endphp
    <h1 class="mb-3 text-gray-800 h3">{{ __('Export Sales Code Actions') }}</h1>

    <div class="card-body">
        <form action="{{ route('admins.reports.sales.export') }}" method="POST">
            @csrf

            <div id="category_wrapper" class="my-2 form-group">
                <label for="category">{{ __('Sales Codes') }}</label>
                <select name="sales_codes_ids[]" class="form-control" id="sales_code" multiple></select>
                <small class="form-text text-muted">{{ __('Leave empty to export all sales codes') }}</small>
            </div>

            <div class="row">
                <div class="my-2 form-group col-md-6">
                    <label for="from">{{ __('From') }}</label>
                    <input type="date" name="from" class="form-control" id="from" required
                        value="{{ old('from') }}">
                </div>
                <div class="my-2 form-group col-md-6">
                    <label for="to">{{ __('To') }}</label>
                    <input type="date" name="to" class="form-control" id="to" required
                        value="{{ old('to') }}">
                </div>
            </div>

            <button type="submit" class="my-5 btn btn-success btn-block">{{ __('Export') }}</button>
        </form>

    </div>

    <script>
        $(document).ready(function() {
            $('#sales_code').select2({
                placeholder: "{{ __('Search for sales codes') }}",
                width: '100%',
                ajax: {
                    url: "{{ route('admins.codes.search') }}",
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
