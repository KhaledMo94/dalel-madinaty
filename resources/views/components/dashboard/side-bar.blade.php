<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text">
            <div class="logo-container">
                <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') }}">
            </div>
            <div class="logo-text">
                {{ config('app.name', 'Dashboard') }}
            </div>
        </div>
    </a>

    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Dashboard -->
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}" data-tooltip="{{ __('Dashboard') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>

    @hasrole('admin|super-admin')
        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('categories'))
            <li class="nav-item {{ Route::is('admins.categories.*') || Route::is('admins.main-categories.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Categories Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategories"
                    aria-expanded="true" aria-controls="collapsecategories">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('Categories Section') }}</span>
                </a>
                <div id="collapsecategories"
                    class="collapse {{ Route::is('admins.categories.*') || Route::is('admins.main-categories.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item"
                            href="{{ route('admins.main-categories.index') }}">{{ __('Main Categories') }}</a>
                        <a class="collapse-item" href="{{ route('admins.categories.index') }}">{{ __('Sub Categories') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.main-categories.create') }}">{{ __('Create Main Category') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.categories.create') }}">{{ __('Create Sub Category') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('listings'))
            <li class="nav-item {{ Route::is('admins.listings.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Listings Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselistings"
                    aria-expanded="true" aria-controls="collapselistings">
                    <i class="fas fa-fw fa-list"></i>
                    <span>{{ __('Listings Section') }}</span>
                </a>
                <div id="collapselistings" class="collapse {{ Route::is('admins.listings.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.listings.index') }}">{{ __('All Listings') }}</a>
                        <a class="collapse-item" href="{{ route('admins.listings.create') }}">{{ __('Create Listing') }}</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ Route::is('admins.branches.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Branches Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebranches"
                    aria-expanded="true" aria-controls="collapsebranches">
                    <i class="fas fa-fw fa-code-branch"></i>
                    <span>{{ __('Branches Section') }}</span>
                </a>
                <div id="collapsebranches" class="collapse {{ Route::is('admins.branches.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.branches.index') }}">{{ __('Listing branches') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.branches.create') }}">{{ __('Create Listing Branch') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('users'))
            <li class="nav-item {{ Route::is('admins.users.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Users Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseusers"
                    aria-expanded="true" aria-controls="collapseusers">
                    <i class="fas fa-fw fa-users"></i>
                    <span>{{ __('Users Section') }}</span>
                </a>
                <div id="collapseusers" class="collapse {{ Route::is('admins.users.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.users.index') }}">{{ __('All Users') }}</a>
                        <a class="collapse-item" href="{{ route('admins.users.create') }}">{{ __('Create User') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('cities'))
            <li class="nav-item {{ Route::is('admins.cities.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Cities Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecities"
                    aria-expanded="true" aria-controls="collapsecities">
                    <i class="fas fa-fw fa-city"></i>
                    <span>{{ __('Cities Section') }}</span>
                </a>
                <div id="collapsecities" class="collapse {{ Route::is('admins.cities.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.cities.index') }}">{{ __('All Cities') }}</a>
                        <a class="collapse-item" href="{{ route('admins.cities.create') }}">{{ __('Create New City') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('areas'))
            <li class="nav-item {{ Route::is('admins.areas.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Areas Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseareas"
                    aria-expanded="true" aria-controls="collapseareas">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>{{ __('Areas Section') }}</span>
                </a>
                <div id="collapseareas" class="collapse {{ Route::is('admins.areas.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.areas.index') }}">{{ __('All Areas') }}</a>
                        <a class="collapse-item" href="{{ route('admins.areas.create') }}">{{ __('Create New Area') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('banners'))
            <li class="nav-item {{ Route::is('admins.banners.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Banners Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebanners"
                    aria-expanded="true" aria-controls="collapsebanners">
                    <i class="fas fa-fw fa-image"></i>
                    <span>{{ __('Banners Section') }}</span>
                </a>
                <div id="collapsebanners" class="collapse {{ Route::is('admins.banners.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.banners.index') }}">{{ __('All Banners') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.banners.create') }}">{{ __('Create New Banner') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('options'))
            <li class="nav-item {{ Route::is('admins.options.*') || Route::is('admins.option-values.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Options Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseoptions"
                    aria-expanded="true" aria-controls="collapseoptions">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ __('Options Section') }}</span>
                </a>
                <div id="collapseoptions" class="collapse {{ Route::is('admins.options.*') || Route::is('admins.option-values.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.options.index') }}">{{ __('All Options') }}</a>
                        <a class="collapse-item" href="{{ route('admins.options.create') }}">{{ __('Create Option') }}</a>
                        <a class="collapse-item" href="{{ route('admins.option-values.index') }}">{{ __('All Option Values') }}</a>
                        <a class="collapse-item" href="{{ route('admins.option-values.create') }}">{{ __('Create Option Value') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('amenities'))
            <li class="nav-item {{ Route::is('admins.amenities.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Amenities Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseamenities"
                    aria-expanded="true" aria-controls="collapseamenities">
                    <i class="fas fa-fw fa-star"></i>
                    <span>{{ __('Amenities Section') }}</span>
                </a>
                <div id="collapseamenities" class="collapse {{ Route::is('admins.amenities.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.amenities.index') }}">{{ __('All Amenities') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.amenities.create') }}">{{ __('Create Amenity') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('notifications'))
            <li class="nav-item {{ Route::is('admins.notifications.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Notifications Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifications"
                    aria-expanded="true" aria-controls="collapseNotifications">
                    <i class="fas fa-fw fa-bell"></i>
                    <span>{{ __('Notifications Section') }}</span>
                </a>
                <div id="collapseNotifications" class="collapse {{ Route::is('admins.notifications.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item"
                            href="{{ route('admins.notifications.user') }}">{{ __('Users Notifications') }}</a>
                        {{-- <a class="collapse-item"
                            href="{{ route('admins.notifications.cashier') }}">{{ __('Providers Notifications') }}</a> --}}
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('offers'))
            <li class="nav-item {{ Route::is('admins.offers.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Offers Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseoffers"
                    aria-expanded="true" aria-controls="collapseoffers">
                    <i class="fas fa-fw fa-gift"></i>
                    <span>{{ __('Offers Section') }}</span>
                </a>
                <div id="collapseoffers" class="collapse {{ Route::is('admins.offers.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.offers.index') }}">{{ __('All Offers') }}</a>
                        <a class="collapse-item" href="{{ route('admins.offers.create') }}">{{ __('Create Offer') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('commenters'))
            <li class="nav-item {{ Route::is('admins.commenters.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Commenters Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecommenters"
                    aria-expanded="true" aria-controls="collapsecommenters">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>{{ __('Commenters Section') }}</span>
                </a>
                <div id="collapsecommenters" class="collapse {{ Route::is('admins.commenters.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.commenters.index') }}">{{ __('All Commenters') }}</a>
                        <a class="collapse-item" href="{{ route('admins.commenters.create') }}">{{ __('Create Commenter') }}</a>
                    </div>
                </div>
            </li>
        @endif

        @role('super-admin')
            <li class="nav-item {{ Route::is('admins.admins.*') ? 'active' : '' }}"
                data-tooltip="{{ __('Admins Section') }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseadmins"
                    aria-expanded="true" aria-controls="collapseadmins">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>{{ __('Admins Section') }}</span>
                </a>
                <div id="collapseadmins" class="collapse {{ Route::is('admins.admins.*') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{ route('admins.admins.index') }}">{{ __('All Admins') }}</a>
                        <a class="collapse-item"
                            href="{{ route('admins.admins.create') }}">{{ __('Create New Admin') }}</a>
                    </div>
                </div>
            </li>
        @endrole
    @endhasrole

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggle Button at Bottom -->
    <div class="sidebar-toggle-bottom" id="sidebarToggleModern">
        <i class="fas fa-chevron-left"></i>
    </div>
</ul>
