<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\GeneralSetting;


// Registration disabled
// Route::post('register', [UserAuthController::class, 'register'])->middleware('throttle:10,1');
Route::post('login', [UserAuthController::class, 'login'])->middleware('throttle:5,1');
Route::get('cities', [CityController::class, 'allCities'])->middleware('throttle:30,1');
Route::get('cities/search', [CityController::class, 'search'])->middleware('throttle:30,1');
Route::get('banners', [BannerController::class, 'index'])->middleware('throttle:30,1');

Route::post('forgot-password', [OtpController::class, 'forgotPassword'])->middleware('throttle:30,1');
Route::post('reset-password', [OtpController::class, 'resetPassword'])->middleware('throttle:30,1');
Route::get('main-categories',[CategoryController::class , 'mainCategories']);
Route::get('sub-categories-by-main',[CategoryController::class , 'subCategories']);
Route::get('listing-by-categories',[CategoryController::class , 'listingsByCategory']);
Route::get('listing-by-main-category',[CategoryController::class , 'listingByMainCategory']);
Route::get('mobile/version',function(){
   return  GeneralSetting::select('key','value')->get();
});


Route::group([
    'middleware'            =>['auth:sanctum','throttle:100,1'],
],function(){
    Route::post('logout',[UserAuthController::class  , 'logout']);
    Route::get('user',[UserAuthController::class , 'user']);
    Route::post('send-verification-code',[OtpController::class , 'send']);
    Route::post('verify-code',[OtpController::class , 'verify']);
    Route::group([
        'middleware'            =>[
            'phone-verified-sanctum',
            'user-unbanned'
        ],
    ],function(){
        Route::put('update',[UserAuthController::class , 'update']);
        Route::put('update-tokens',[UserAuthController::class , 'updateTokens']);
        Route::delete('delete-account',[UserAuthController::class , 'deleteAccount']);
        //----------------------------------------------------------

        Route::get('all-amenities-by-categories',[AmenityController::class , 'allAmenities']);
        Route::get('single-listing',[ListingController::class , 'singleListing']);
        Route::get('search-listings',[ListingController::class , 'search']);
        Route::group([
            'middleware'        =>[
                'type:user',
            ],
        ],function(){
            Route::get('liked-listings',[ListingController::class , 'myListings']);
            Route::post('listings-toggle',[ListingController::class , 'likeToggle']);
            Route::get('nearby-offers',[OfferController::class , 'index']);
        });

        //---------------------------------------------------------
        
        Route::group([
            'middleware'        =>[
                'type:merchant',
                'payed',
            ],
        ],function(){
            Route::get('my-listing-with-branches',[ListingController::class , 'myListingWithBranches']);
            Route::post('offer/store',[OfferController::class , 'store']);
            Route::delete('offer/delete',[OfferController::class , 'delete']);
        });

        //-------------------------------------------------------
        Route::get('packages-listing',[PackageController::class , 'index']);
            Route::post('packages-subscribe',[PackageController::class , 'subscribe']);

        Route::group([
            'middleware'        =>[
                'type:merchant',
                'payed',
            ],
        ],function(){
            Route::post('listing/store',[ListingController::class , 'store']);
            Route::put('listing/update',[ListingController::class , 'update']);
            Route::get('my-packages-purchases',[PackageController::class , 'myPackagePurchases']);
            Route::get('my-active-packages-purchase',[PackageController::class , 'myActivePackagePurchase']);
        });
    });
});
Route::post('/payment/fawry/callback', [PackageController::class, 'handleFawryCallback']);