<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OptionValueController;
use App\Http\Controllers\Dashboard\AmenityController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\GeneralSettingController;
use App\Http\Controllers\Dashboard\MainCategoryController;
use App\Http\Controllers\Dashboard\SendPushNotification;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\ListingController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\PackageController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ListingBranchController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SaleCodeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as'            => 'admins.',
    'prefix'        => 'admin/',
    'middleware'    => ['auth', 'locale']
], function () {
    Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::put('edit-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('edit-password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('edit-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    //--------------------------------------------------

    Route::post('/language-switch', [GeneralSettingController::class, 'switchLanguage'])->name('language.switch');

    //---------------------------------------------------

    Route::resource('categories', CategoryController::class)->except('show')
        ->middleware('role-or-permission:super-admin,categories')
        ->names([
            'index'                                         => 'categories.index',
            'create'                                        => 'categories.create',
            'store'                                         => 'categories.store',
            'edit'                                          => 'categories.edit',
            'update'                                        => 'categories.update',
            'destroy'                                       => 'categories.destroy',
        ]);

    Route::put('categories/{id}/toggle', [CategoryController::class, 'toggleStatus'])
        ->middleware('role-or-permission:super-admin,categories')
        ->name('categories.toggle');
    Route::get('search-categories', [CategoryController::class, 'search'])
        ->name('categories.search');

    //------------------------------------------------------------

    Route::resource('main-categories', MainCategoryController::class)->except('show')
        ->middleware('role-or-permission:super-admin,categories')
        ->names([
            'index'                                         => 'main-categories.index',
            'create'                                        => 'main-categories.create',
            'store'                                         => 'main-categories.store',
            'edit'                                          => 'main-categories.edit',
            'update'                                        => 'main-categories.update',
            'destroy'                                       => 'main-categories.destroy',
        ]);

    Route::put('main-categories/{id}/toggle', [MainCategoryController::class, 'toggleStatus'])
        ->middleware('role-or-permission:super-admin,categories')
        ->name('main-categories.toggle');

    //------------------------------------------------------------

    Route::resource('listings', ListingController::class)
        ->middleware('role-or-permission:super-admin,listings')
        ->names([
            'index'                                         => 'listings.index',
            'create'                                        => 'listings.create',
            'store'                                         => 'listings.store',
            'show'                                          => 'listings.show',
            'edit'                                          => 'listings.edit',
            'update'                                        => 'listings.update',
            'destroy'                                       => 'listings.destroy',
        ]);

    // Comments routes
    Route::post('listings/{listing}/comments', [CommentController::class, 'store'])
        ->name('listings.comments.store')
        ->middleware('role-or-permission:super-admin,listings');
    
    Route::post('listings/{listing}/comments/{comment}/reply', [CommentController::class, 'reply'])
        ->name('listings.comments.reply')
        ->middleware('role-or-permission:super-admin,listings');
    
    Route::delete('listings/{listing}/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('listings.comments.destroy')
        ->middleware('role-or-permission:super-admin,listings');

    Route::get('listings/{listing}/comments', [ListingController::class, 'comments'])
        ->middleware('role-or-permission:super-admin,listings')
        ->name('listings.comments');
    Route::put('listings/{id}/toggle', [ListingController::class, 'toggleStatus'])
        ->middleware('role-or-permission:super-admin,listings')
        ->name('listings.toggle');
    Route::get('search-listings', [ListingController::class, 'search'])->name('listings.search');
    Route::get('category-options', [ListingController::class, 'getCategoryOptions'])->name('listings.category-options');

    //----------------------------------------------------------------

    Route::resource('users', UserController::class)->except(['show'])
        ->middleware('role-or-permission:super-admin,users')
        ->names([
            'index'                                 => 'users.index',
            'create'                                => 'users.create',
            'store'                                 => 'users.store',
            'edit'                                  => 'users.edit',
            'update'                                => 'users.update',
            'destroy'                               => 'users.destroy',
        ]);

    Route::resource('commenters', \App\Http\Controllers\Dashboard\CommenterController::class)
        ->middleware('role-or-permission:super-admin,users')
        ->names([
            'index'                                 => 'commenters.index',
            'create'                                => 'commenters.create',
            'store'                                 => 'commenters.store',
            'edit'                                  => 'commenters.edit',
            'update'                                => 'commenters.update',
            'destroy'                               => 'commenters.destroy',
        ]);

    Route::put('users/{id}/toggle', [UserController::class, 'toggleStatus'])
        ->middleware('role-or-permission:super-admin,users')
        ->name('users.toggle');
    Route::post('users/export', [UserController::class, 'export'])
        ->middleware('role-or-permission:super-admin,users')
        ->name('users.export');

    //----------------------------------------------------------------

    Route::resource('merchants', MerchantController::class)->except(['show', 'create', 'edit', 'update'])
        ->middleware('role-or-permission:super-admin,merchants')
        ->names([
            'index'                                 => 'merchants.index',
            'destroy'                               => 'merchants.destroy',
        ]);

    Route::put('merchants/{id}/toggle', [MerchantController::class, 'toggleStatus'])
        ->middleware('role-or-permission:super-admin,merchants')
        ->name('merchants.toggle');
    Route::post('merchants/export', [MerchantController::class, 'export'])
        ->middleware('role-or-permission:super-admin,merchants')
        ->name('merchants.export');

    //-------------------------------------------------

    Route::resource('amenities', AmenityController::class)->except('show')
        ->middleware('role-or-permission:super-admin,amenities')
        ->names([
            'index'                             => 'amenities.index',
            'create'                            => 'amenities.create',
            'edit'                              => 'amenities.edit',
            'update'                            => 'amenities.update',
            'destroy'                           => 'amenities.destroy',
        ]);
    Route::get('search-amenities', [AmenityController::class, 'search'])
        ->name('amenities.search');
    //-------------------------------------------

    Route::resource('cities', CityController::class)->except('show')
        ->middleware('role-or-permission:super-admin,cities')
        ->names([
            'index'                             => 'cities.index',
            'create'                            => 'cities.create',
            'store'                             => 'cities.store',
            'edit'                              => 'cities.edit',
            'update'                            => 'cities.update',
            'destroy'                           => 'cities.destroy',
        ]);
    Route::get('search-cities', [CityController::class, 'search'])
        ->name('cities.search');

    //-----------------------------------------------

    Route::resource('areas', AreaController::class)->except('show')
        ->middleware('role-or-permission:super-admin,areas')
        ->names([
            'index'                             => 'areas.index',
            'create'                            => 'areas.create',
            'store'                             => 'areas.store',
            'edit'                              => 'areas.edit',
            'update'                            => 'areas.update',
            'destroy'                           => 'areas.destroy',
        ]);
    Route::get('search-areas', [AreaController::class, 'search'])
        ->name('areas.search');

    //-----------------------------------------------

    Route::resource('options', OptionController::class)->except('show')
        ->middleware('role-or-permission:super-admin,options')
        ->names([
            'index'                             => 'options.index',
            'create'                            => 'options.create',
            'store'                             => 'options.store',
            'edit'                              => 'options.edit',
            'update'                            => 'options.update',
            'destroy'                           => 'options.destroy',
        ]);
    Route::get('search-options', [OptionController::class, 'search'])
        ->name('options.search');

    //-----------------------------------------------

    Route::resource('option-values', OptionValueController::class)->except('show')
        ->middleware('role-or-permission:super-admin,options')
        ->names([
            'index'                             => 'option-values.index',
            'create'                            => 'option-values.create',
            'store'                             => 'option-values.store',
            'edit'                              => 'option-values.edit',
            'update'                            => 'option-values.update',
            'destroy'                           => 'option-values.destroy',
        ]);

    //-----------------------------------------------

    Route::resource('banners', BannerController::class)->except('show')
        ->middleware('role-or-permission:super-admin,banners')
        ->names([
            'index'                             => 'banners.index',
            'create'                            => 'banners.create',
            'store'                             => 'banners.store',
            'edit'                              => 'banners.edit',
            'update'                            => 'banners.update',
            'destroy'                           => 'banners.destroy',
        ]);

    //--------------------------------------------------------------------------

    Route::get('admin/reports/sales-commission', [ReportsController::class, 'salesReport'])
        ->middleware('role-or-permission:super-admin,reports')
        ->name('reports.sales.index');
    Route::post('admin/reports/sales-commission/export', [ReportsController::class, 'exportSales'])
        ->middleware('role-or-permission:super-admin,reports')
        ->name('reports.sales.export');
    Route::get('admin/reports/listings', [ReportsController::class, 'listingReport'])
        ->middleware('role-or-permission:super-admin,reports')
        ->name('reports.listings.index');
    Route::post('admin/reports/listings/export', [ReportsController::class, 'exportListing'])
        ->middleware('role-or-permission:super-admin,reports')
        ->name('reports.listings.export');

    //----------------------------------------------------------------------------

    Route::resource('admins', AdminController::class)->except('show')
        ->middleware('role:super-admin')
        ->names([
            'index'                             => 'admins.index',
            'create'                            => 'admins.create',
            'store'                             => 'admins.store',
            'edit'                              => 'admins.edit',
            'update'                            => 'admins.update',
            'destroy'                           => 'admins.destroy',
        ]);

    Route::put('admins/{id}/toggle', [AdminController::class, 'toggleStatus'])
        ->middleware('role:super-admin')
        ->name('admins.toggle');

    //------------------------------------------------------------------

    Route::get('notify-users', [SendPushNotification::class, 'notifyUsers'])->name('notifications.user');
    Route::post('notify-users', [SendPushNotification::class, 'sendUsersNotification'])->name('notifications.user');
    // Route::get('notify-cashiers', [SendPushNotification::class, 'notifyCashiers'])->name('notifications.cashier');
    // Route::post('notify-cashiers', [SendPushNotification::class, 'sendCashierNotification'])->name('notifications.cashier');

    //----------------------------------------------------------

    Route::resource('listing-branches', ListingBranchController::class)
        ->except('show')
        ->middleware('role-or-permission:super-admin,branches')
        ->names([
            'index'                                         => 'branches.index',
            'create'                                        => 'branches.create',
            'store'                                         => 'branches.store',
            'edit'                                          => 'branches.edit',
            'update'                                        => 'branches.update',
            'destroy'                                       => 'branches.destroy',
        ]);
    Route::get('listing-branches/duplicate', [ListingBranchController::class, 'duplicate'])
        ->name('branches.duplicate');
    Route::get('search-branches', [ListingBranchController::class, 'searchBranches'])
        ->name('branches.search');

    //----------------------------------------------------------

    Route::resource('offers', OfferController::class)
        ->middleware('role-or-permission:super-admin,offers')
        ->names([
            'index'                                         => 'offers.index',
            'create'                                        => 'offers.create',
            'store'                                         => 'offers.store',
            'show'                                          => 'offers.show',
            'edit'                                          => 'offers.edit',
            'update'                                        => 'offers.update',
            'destroy'                                       => 'offers.destroy',
        ]);


    //--------------------------------------------------------------------

    Route::resource('sales-codes', SaleCodeController::class)->except('show')
        ->middleware('role-or-permission:super-admin,codes')
        ->names([
            'index'                                 => 'codes.index',
            'create'                                 => 'codes.create',
            'store'                                 => 'codes.store',
            'edit'                                 => 'codes.edit',
            'update'                                 => 'codes.update',
            'destroy'                                 => 'codes.destroy',
        ]);
    Route::get('sales-codes/sales/search',[SaleCodeController::class , 'search'])
        ->name('codes.search');


    //----------------------------------------------------------

    Route::resource('packages', PackageController::class)
        ->except(['show','create','store','delete'])
        ->middleware('role-or-permission:super-admin,packages');

});
