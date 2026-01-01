<x-dashboard.main-layout>
    <h1 class="mb-3 text-gray-800 h3">{{ __('Areas') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
            <div class="float-right d-inline">
                <a href="{{ route('admins.areas.create') }}" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i>{{ __('Add New') }}</a>
            </div>
        </div>
        <div class="card-body">
            @livewire('areas-index', ['cities' => $cities])
        </div>
    </div>

    <script>
        function confirmDelete(areaId) {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You will not be able to revert this!') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + areaId).submit();
                    document.querySelector('tr[data-id="' + areaId + '"]')?.remove();
                }
            });
        }
    </script>
</x-dashboard.main-layout>

