<?php
/*
 * File name: api.php

 * Author: DAS360
 * Copyright (c) 2022
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('provider')->group(function () {
    Route::post('login', 'API\EProvider\UserAPIController@login');
    Route::post('register', 'API\EProvider\UserAPIController@register');
    Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
    Route::get('user', 'API\EProvider\UserAPIController@user');
    Route::get('logout', 'API\EProvider\UserAPIController@logout');
    Route::get('settings', 'API\EProvider\UserAPIController@settings');
    Route::get('translations', 'API\TranslationAPIController@translations');
    Route::get('supported_locales', 'API\TranslationAPIController@supportedLocales');
});


Route::post('login', 'API\UserAPIController@login');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
Route::get('user', 'API\UserAPIController@user');
Route::get('logout', 'API\UserAPIController@logout');
Route::delete('delete', 'API\UserAPIController@delete');
Route::get('settings', 'API\UserAPIController@settings');
Route::get('translations', 'API\TranslationAPIController@translations');
Route::get('supported_locales', 'API\TranslationAPIController@supportedLocales');
Route::get('modules', 'API\ModuleAPIController@index');


Route::resource('e_provider_types', 'API\EProviderTypeAPIController');
Route::resource('e_providers', 'API\EProviderAPIController');
Route::resource('availability_hours', 'API\AvailabilityHourAPIController');
Route::resource('awards', 'API\AwardAPIController');
Route::resource('experiences', 'API\ExperienceAPIController');

Route::resource('faq_categories', 'API\FaqCategoryAPIController');
Route::resource('faqs', 'API\FaqAPIController');
Route::resource('custom_pages', 'API\CustomPageAPIController');

Route::resource('categories', 'API\CategoryAPIController');

Route::resource('e_services', 'API\EServiceAPIController');
Route::get('e_services/{id}/slots', 'API\EServiceAPIController@slots')->name('e_service.slots');
Route::resource('galleries', 'API\GalleryAPIController');
Route::get('e_service_reviews/{id}', 'API\EServiceReviewAPIController@show')->name('e_service_reviews.show');
Route::get('e_service_reviews', 'API\EServiceReviewAPIController@index')->name('e_service_reviews.index');

Route::resource('currencies', 'API\CurrencyAPIController');
Route::resource('slides', 'API\SlideAPIController')->except([
    'show'
]);
Route::resource('booking_statuses', 'API\BookingStatusAPIController')->except([
    'show'
]);
Route::resource('option_groups', 'API\OptionGroupAPIController');
Route::resource('options', 'API\OptionAPIController');

Route::middleware('auth:api')->group(function () {

    // Account Verification
    Route::post('account-verification/verify', 'API\AccountVerificationAPIController@verifyAccount')->name('account-verification.verifyAccount');
    Route::get('account-verification/resendCode', 'API\AccountVerificationAPIController@resendCode')->name('account-verification.resendCode');

    Route::group(['middleware' => ['role:provider']], function () {
        Route::prefix('provider')->group(function () {
            Route::post('users/{user}', 'API\UserAPIController@update');
            Route::get('dashboard', 'API\DashboardAPIController@provider');
            Route::get('e_providers', 'API\EProvider\EProviderAPIController@index')->name('provider.e_providers.index');
            Route::get('e_providers/{id}', 'API\EProvider\EProviderAPIController@show')->name('provider.e_providers.show');
            Route::resource('notifications', 'API\NotificationAPIController');
            Route::get('e_service_reviews', 'API\EServiceReviewAPIController@index')->name('provider.e_service_reviews.index');
            Route::get('e_services', 'API\EProvider\EServiceAPIController@index')->name('e_services.index');
            Route::post('e_services', 'API\EProvider\EServiceAPIController@store')->name('e_services.store');
            Route::get('e_services/{id}', 'API\EProvider\EServiceAPIController@show')->name('e_services.show');
            Route::put('e_services/{id}', 'API\EProvider\EServiceAPIController@update')->name('e_services.update');
            Route::delete('e_services/{id}', 'API\EProvider\EServiceAPIController@destroy')->name('e_services.destroy');
            Route::resource('availability_hours', 'API\EProvider\AvailabilityHourAPIController');
            Route::put('payments/{id}', 'API\PaymentAPIController@update')->name('payments.update');
            Route::post('bookings/{id}/customer_reviews', 'API\EProvider\CustomerReviewAPIController@store')->name('customer_reviews.store');
        });
    });
    Route::post('uploads/store', 'API\UploadAPIController@store');
    Route::post('uploads/clear', 'API\UploadAPIController@clear');
    Route::post('users/{user}', 'API\UserAPIController@update');

    Route::get('payments/byMonth', 'API\PaymentAPIController@byMonth')->name('payments.byMonth');
    Route::post('payments/wallets/{id}', 'API\PaymentAPIController@wallets')->name('payments.wallets');
    Route::post('payments/cash', 'API\PaymentAPIController@cash')->name('payments.cash');
    Route::resource('payment_methods', 'API\PaymentMethodAPIController')->only([
        'index'
    ]);
    Route::post('e_service_reviews', 'API\EServiceReviewAPIController@store')->name('e_service_reviews.store');


    Route::resource('favorites', 'API\FavoriteAPIController');
    Route::resource('addresses', 'API\AddressAPIController');

    Route::get('notifications/count', 'API\NotificationAPIController@count');
    Route::resource('notifications', 'API\NotificationAPIController');
    Route::resource('bookings', 'API\BookingAPIController');

    Route::resource('earnings', 'API\EarningAPIController');

    Route::resource('e_provider_payouts', 'API\EProviderPayoutAPIController');

    Route::resource('coupons', 'API\CouponAPIController')->except([
        'show'
    ]);
    Route::resource('wallets', 'API\WalletAPIController')->except([
        'show', 'create', 'edit'
    ]);
    Route::get('wallet_transactions', 'API\WalletTransactionAPIController@index')->name('wallet_transactions.index');

    Route::post('complains', 'API\ComplainAPIController@store')->name('complains.store');
});
