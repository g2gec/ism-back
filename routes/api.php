<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//  Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::post('apicontent', 'Bedsonline\BaseController@content');
//Route::get('test', 'Bedsonline\BaseController@get');
//Route::post('otra', 'Bedsonline\BaseController@testing');

// Recovery password
Route::post('send-email', 'RecoveryPasswordController@sendEmail')->name('send-password');
Route::post('customer/update-password', 'RecoveryPasswordController@updatePassword');

// Register customer
Route::post('customer/register', 'CustomerController@register');
Route::post('customer/confirm-register', 'CustomerController@confirmRegister');

// Edit customer
//Route::post('edit-customer', 'CustomerController@editCustomer');

// Register Providers
//Route::post('register-providers', 'CustomerController@supplierRegistration');

// Edit provider
//Route::post('edit-provider', 'ProviderController@editProvider');

Route::post('admin/sellers/filter-customers', 'SellerController@filterCustomers');
Route::post('admin/customer/register', 'AdminCustomerController@store');
Route::post('ratehawk', 'RatehwakController@ratehawk');
Route::post('pay-tdc', 'RatehwakController@payTDC');

Route::middleware(['cors'])->group(function () {
    Route::group(['prefix' => 'auth'], function () {

        // publicas para autenticarse y registrarse
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');

        // Register customer
        Route::post('register-customer', 'CustomerController@register');
        // Edit customer
        Route::post('edit-customer', 'CustomerController@editCustomer');
        // Register Providers
        Route::post('register-providers', 'CustomerController@supplierRegistration');
        // Edit provider
        Route::post('edit-provider', 'CustomerController@editProvider');

        Route::post('apicontent', 'CustomerController@content');
        Route::get('test', 'CustomerController@get');
        Route::post('otra', 'CustomerController@testing');

    });

    Route::group(['middleware' => 'auth:api'], function() {
        //cerrar session
         Route::get('logout', 'AuthController@logout');

        //consultar datos
            Route::get('user', 'AuthController@user');

        // Memberships
            Route::get('memberships', 'MembershipController@index');
            Route::post('membership/register', 'MembershipController@register');
            Route::get('membership/details/{id}', 'MembershipController@show');
            Route::post('membership/update', 'MembershipController@update');
            Route::get('membership/delete/{id}', 'MembershipController@destroy');

        // Admin customers
            Route::get('admin/customers', 'AdminCustomerController@index');

            Route::get('admin/customers/details/{id}', 'AdminCustomerController@show');
            Route::post('admin/customer/update', 'AdminCustomerController@update');
            Route::get('admin/customers/delete/{id}', 'AdminCustomerController@destroy');
            Route::get('admin/customers/supend/{id}', 'AdminCustomerController@suspend');
            Route::post('admin/customers/filters', 'AdminCustomerController@filters');

        // Sellers
            Route::get('admin/sellers', 'SellerController@index');
            Route::post('admin/sellers/register', 'SellerController@store');
            Route::get('admin/sellers/details/{id}', 'SellerController@show');
            Route::post('admin/sellers/update', 'SellerController@update');
            Route::get('admin/sellers/delete/{id}', 'SellerController@destroy');
            Route::get('admin/sellers/{id}/list-customers', 'SellerController@listCustomers');

            Route::post('sellers/messages/store', 'MotivationalMessagesController@store');
            Route::post('sellers/messages/show', 'MotivationalMessagesController@show');
            Route::post('sellers/messages/update', 'MotivationalMessagesController@update');
            Route::post('sellers/messages/status', 'MotivationalMessagesController@updateStatus');

        // Promotions
            Route::get('admin/promotions', 'PromotionController@index');
            Route::post('admin/promotions/register', 'PromotionController@store');
            Route::get('admin/promotions/details/{id}', 'PromotionController@show');
            Route::post('admin/promotions/update', 'PromotionController@update');
            Route::get('admin/promotions/delete/{id}', 'PromotionController@destroy');


        //Route::get('contacts', 'ChatMessageAPIController@contacts')->name('contacts');
        //Route::get('search', 'ChatMessageAPIController@search')->name('search');
        //Route::get('threads', 'ChatMessageAPIController@threads')->name('threads');
        //Route::get('motores', 'MotorAPIController@index')->name('motores');
        //Route::get('membresias', 'MembresiaAPIController@index')->name('membresias');
        Route::get('usuarios', 'AuthController@usuarios')->name('usuarios');
        Route::post('registerAsociado', 'AuthController@registerAsociado')->name('registerAsociado');

        //crear data
        //Route::post('sendTxt', 'ChatMessageAPIController@sendTxt')->name('sendTxt');
        //Route::post('createMembresia', 'MembresiaAPIController@storeMembresia')->name('createMembresia');

        // filtrar data especifica
        //Route::get('thread/{id}', 'ChatMessageAPIController@thread');
        //Route::get('visto/{id}', 'ChatMessageAPIController@visto');
        //Route::get('participants/{id}', 'ChatMessageAPIController@participants');

        // Chat
        // Route::get('conversation/{userId}/{friendId}', 'Chat\ChatController@getConversation');
        Route::get('conversation/{userId}/{friendId}', 'Chat\ChatController@getConversation');
        Route::get('users/{userId}', 'Chat\ChatController@getUsers');
        // Route::get('vendors/{userId}', 'Chat\ChatController@getVendors');
        Route::post('send-message', 'Chat\MessageController@sendMessage');
        Route::post('start-videocall', 'Chat\ChatController@startVideoCall');

        // Api ratehwak
        /*Route::post('general-filter', 'RatehwakController@generalFilter')->name('general-filter');
        Route::post('home-filter', 'RatehwakController@homeFilter')->name('home-filter');
        Route::post('hotels-search-by-start-rating', 'RatehwakController@filterStartRating')->name('hotels-search-by-start-rating');
        Route::post('search-by-ids', 'RatehwakController@filterById');*/
    });
});

// Api ratehwak
Route::post('general-filter', 'RatehwakController@generalFilter')->name('general-filter');
Route::post('home-filter', 'RatehwakController@homeFilter')->name('home-filter');
Route::post('hotels-search-by-start-rating', 'RatehwakController@filterStartRating')->name('hotels-search-by-start-rating');
Route::post('search-by-ids', 'RatehwakController@filterById');

// Routes Region
Route::get('list-regions', 'RatehwakController@listRegions')->name('list-regions');

/* Route::group(['prefix' => 'ism'], function () {

}); */


/* Route::resource('motors', 'MotorAPIController');

Route::resource('motor_membresias', 'MotorMembresiaAPIController');

Route::resource('membresias', 'MembresiaAPIController'); */

/* Route::resource('chat_messages', 'ChatMessageAPIController');

Route::resource('messages', 'MessageAPIController');

Route::resource('participant_messages', 'ParticipantMessageAPIController'); */
