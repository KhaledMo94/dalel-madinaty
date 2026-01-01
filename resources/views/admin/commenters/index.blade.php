<x-dashboard.main-layout>
    <h1 class="mb-3 text-gray-800 h3">{{ __('Commenters') }}</h1>
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">{{ __('All Commenters') }}</h6>
            <div>
                <a href="{{ route('admins.commenters.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> {{ __('Create Commenter') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('Serial') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Listing') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @forelse($users as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if ($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                            width="70">
                                    @else
                                        <span class="text-muted">{{ __('No Image') }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->email ?? __('No Email') }}</td>
                                <td style="direction: ltr">{{ $user->phone ?? ''}}</td>
                                <td>
                                    @if($user->commenterListing)
                                        <span class="badge badge-info">
                                            {{ $user->commenterListing->getTranslation('name', app()->getLocale()) }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning">{{ __('No Listing') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admins.commenters.edit', $user->id) }}"
                                            class="mx-1 btn btn-warning btn-sm" title="{{ __('Edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admins.commenters.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="mx-1 btn btn-danger btn-sm"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this commenter?') }}')"
                                                title="{{ __('Delete') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('No commenters found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-dashboard.main-layout>

