<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard')); ?>">
        <div class="sidebar-brand-text">
            <div class="logo-container">
                <img src="<?php echo e(asset(config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>">
            </div>
            <div class="logo-text">
                <?php echo e(config('app.name', 'Dashboard')); ?>

            </div>
        </div>
    </a>

    <!-- Divider -->
    

    <!-- Dashboard -->
    <li class="nav-item <?php echo e(Route::is('dashboard') ? 'active' : ''); ?>" data-tooltip="<?php echo e(__('Dashboard')); ?>">
        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span><?php echo e(__('Dashboard')); ?></span>
        </a>
    </li>

    <?php if (\Illuminate\Support\Facades\Blade::check('hasrole', 'admin|super-admin')): ?>
        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('categories')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.categories.*') || Route::is('admins.main-categories.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Categories Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategories"
                    aria-expanded="true" aria-controls="collapsecategories">
                    <i class="fas fa-fw fa-folder"></i>
                    <span><?php echo e(__('Categories Section')); ?></span>
                </a>
                <div id="collapsecategories"
                    class="collapse <?php echo e(Route::is('admins.categories.*') || Route::is('admins.main-categories.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.main-categories.index')); ?>"><?php echo e(__('Main Categories')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.categories.index')); ?>"><?php echo e(__('Sub Categories')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.main-categories.create')); ?>"><?php echo e(__('Create Main Category')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.categories.create')); ?>"><?php echo e(__('Create Sub Category')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('listings')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.listings.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Listings Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselistings"
                    aria-expanded="true" aria-controls="collapselistings">
                    <i class="fas fa-fw fa-list"></i>
                    <span><?php echo e(__('Listings Section')); ?></span>
                </a>
                <div id="collapselistings" class="collapse <?php echo e(Route::is('admins.listings.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.listings.index')); ?>"><?php echo e(__('All Listings')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.listings.create')); ?>"><?php echo e(__('Create Listing')); ?></a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php echo e(Route::is('admins.branches.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Branches Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebranches"
                    aria-expanded="true" aria-controls="collapsebranches">
                    <i class="fas fa-fw fa-code-branch"></i>
                    <span><?php echo e(__('Branches Section')); ?></span>
                </a>
                <div id="collapsebranches" class="collapse <?php echo e(Route::is('admins.branches.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.branches.index')); ?>"><?php echo e(__('Listing branches')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.branches.create')); ?>"><?php echo e(__('Create Listing Branch')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('users')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.users.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Users Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseusers"
                    aria-expanded="true" aria-controls="collapseusers">
                    <i class="fas fa-fw fa-users"></i>
                    <span><?php echo e(__('Users Section')); ?></span>
                </a>
                <div id="collapseusers" class="collapse <?php echo e(Route::is('admins.users.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.users.index')); ?>"><?php echo e(__('All Users')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.users.create')); ?>"><?php echo e(__('Create User')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('cities')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.cities.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Cities Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecities"
                    aria-expanded="true" aria-controls="collapsecities">
                    <i class="fas fa-fw fa-city"></i>
                    <span><?php echo e(__('Cities Section')); ?></span>
                </a>
                <div id="collapsecities" class="collapse <?php echo e(Route::is('admins.cities.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.cities.index')); ?>"><?php echo e(__('All Cities')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.cities.create')); ?>"><?php echo e(__('Create New City')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('areas')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.areas.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Areas Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseareas"
                    aria-expanded="true" aria-controls="collapseareas">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span><?php echo e(__('Areas Section')); ?></span>
                </a>
                <div id="collapseareas" class="collapse <?php echo e(Route::is('admins.areas.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.areas.index')); ?>"><?php echo e(__('All Areas')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.areas.create')); ?>"><?php echo e(__('Create New Area')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('banners')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.banners.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Banners Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebanners"
                    aria-expanded="true" aria-controls="collapsebanners">
                    <i class="fas fa-fw fa-image"></i>
                    <span><?php echo e(__('Banners Section')); ?></span>
                </a>
                <div id="collapsebanners" class="collapse <?php echo e(Route::is('admins.banners.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.banners.index')); ?>"><?php echo e(__('All Banners')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.banners.create')); ?>"><?php echo e(__('Create New Banner')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('options')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.options.*') || Route::is('admins.option-values.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Options Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseoptions"
                    aria-expanded="true" aria-controls="collapseoptions">
                    <i class="fas fa-fw fa-cog"></i>
                    <span><?php echo e(__('Options Section')); ?></span>
                </a>
                <div id="collapseoptions" class="collapse <?php echo e(Route::is('admins.options.*') || Route::is('admins.option-values.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.options.index')); ?>"><?php echo e(__('All Options')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.options.create')); ?>"><?php echo e(__('Create Option')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.option-values.index')); ?>"><?php echo e(__('All Option Values')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.option-values.create')); ?>"><?php echo e(__('Create Option Value')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('amenities')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.amenities.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Amenities Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseamenities"
                    aria-expanded="true" aria-controls="collapseamenities">
                    <i class="fas fa-fw fa-star"></i>
                    <span><?php echo e(__('Amenities Section')); ?></span>
                </a>
                <div id="collapseamenities" class="collapse <?php echo e(Route::is('admins.amenities.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.amenities.index')); ?>"><?php echo e(__('All Amenities')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.amenities.create')); ?>"><?php echo e(__('Create Amenity')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('notifications')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.notifications.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Notifications Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifications"
                    aria-expanded="true" aria-controls="collapseNotifications">
                    <i class="fas fa-fw fa-bell"></i>
                    <span><?php echo e(__('Notifications Section')); ?></span>
                </a>
                <div id="collapseNotifications" class="collapse <?php echo e(Route::is('admins.notifications.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.notifications.user')); ?>"><?php echo e(__('Users Notifications')); ?></a>
                        
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('offers')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.offers.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Offers Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseoffers"
                    aria-expanded="true" aria-controls="collapseoffers">
                    <i class="fas fa-fw fa-gift"></i>
                    <span><?php echo e(__('Offers Section')); ?></span>
                </a>
                <div id="collapseoffers" class="collapse <?php echo e(Route::is('admins.offers.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.offers.index')); ?>"><?php echo e(__('All Offers')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.offers.create')); ?>"><?php echo e(__('Create Offer')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('super-admin') || auth()->user()->can('commenters')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.commenters.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Commenters Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecommenters"
                    aria-expanded="true" aria-controls="collapsecommenters">
                    <i class="fas fa-fw fa-comments"></i>
                    <span><?php echo e(__('Commenters Section')); ?></span>
                </a>
                <div id="collapsecommenters" class="collapse <?php echo e(Route::is('admins.commenters.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.commenters.index')); ?>"><?php echo e(__('All Commenters')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('admins.commenters.create')); ?>"><?php echo e(__('Create Commenter')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'super-admin')): ?>
            <li class="nav-item <?php echo e(Route::is('admins.admins.*') ? 'active' : ''); ?>"
                data-tooltip="<?php echo e(__('Admins Section')); ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseadmins"
                    aria-expanded="true" aria-controls="collapseadmins">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span><?php echo e(__('Admins Section')); ?></span>
                </a>
                <div id="collapseadmins" class="collapse <?php echo e(Route::is('admins.admins.*') ? 'show' : ''); ?>"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="<?php echo e(route('admins.admins.index')); ?>"><?php echo e(__('All Admins')); ?></a>
                        <a class="collapse-item"
                            href="<?php echo e(route('admins.admins.create')); ?>"><?php echo e(__('Create New Admin')); ?></a>
                    </div>
                </div>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggle Button at Bottom -->
    <div class="sidebar-toggle-bottom" id="sidebarToggleModern">
        <i class="fas fa-chevron-left"></i>
    </div>
</ul>
<?php /**PATH /home/khaled/projects/dalel-madinaty/resources/views/components/dashboard/side-bar.blade.php ENDPATH**/ ?>