<?php

use Illuminate\Http\Request;

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

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'password'
// ], function () {
//     Route::post('create', 'PasswordResetAPIController@create');
//     Route::get('find/{token}', 'PasswordResetAPIController@find');
//     Route::post('reset', 'PasswordResetAPIController@reset');
// });
Route::get('products', 'ProductAPIController@index');
Route::get('products/{id}', 'ProductAPIController@show');
Route::get('products/{id}/favorite', 'ProductAPIController@toggleFavorite');

Route::get('outfits/{id}/favorite', 'OutfitAPIController@toggleFavorite');

Route::get('categories', 'CategoryAPIController@index');

// Product relations
Route::get('reviews', 'ReviewAPIController@index');
Route::post('reviews/{reviewableId}', 'ReviewAPIController@update');
Route::get('reviews/{productId}', 'ProductAPIController@reviews');
Route::resource('questions', 'QuestionAPIController');

// Blog
Route::resource('post_comments', 'PostCommentAPIController');

Route::post('followed_categories', 'FollowedCategoriesAPIController@update');

// Cart
Route::get('cart', 'CartAPIController@show');
Route::post('cart', 'CartAPIController@store');
Route::patch('cart', 'CartAPIController@update');
Route::post('cart/remove', 'CartAPIController@removeProduct');
Route::post('cart/coupon', 'CartAPIController@coupon');

Route::get('ubigeos/cities', 'UbigeoAPIController@cities');
Route::get('stores', 'UserStoreAPIController@index');
Route::get('stores/gallery/{storeId}', 'UserStoreAPIController@gallery');

Route::get('product_sizes/{productCategoryId}', 'ProductAPIController@sizes');

Route::group(['middleware' => ['auth:api']], function () {

    /**
     * User Related
     */
    Route::get('me', 'UserAPIController@me');

    Route::get('notifications', 'NotificationAPIController@index');
    Route::post('notifications/{notificationId}', 'NotificationAPIController@markAsRead'); // Mark as read and get new total of unread

    Route::post('fcm', 'UserAPIController@fcm');
    Route::get('cards', 'UserAPIController@cards');
    Route::post('add_card', 'UserAPIController@addCreditCard');
    Route::post('update_card', 'UserAPIController@updateCreditCard');
    Route::post('remove_card', 'UserAPIController@removeCreditCard');

    Route::get('collecting_method', 'UserAPIController@collecting_method');
    Route::post('/update_collecting_method/{methodId}', 'UserAPIController@updateCollectingMethod')->name('collectingMethod.update');
    Route::post('/remove_collecting_method/{methodId}', 'UserAPIController@removeCollectingMethod')->name('collectingMethod.remove');

    Route::resource('addresses', 'AddressAPIController');
    Route::post('images/store', 'ImageAPIController@store');
    Route::post('dashboard/images/store', 'Dashboard\ImageAPIController@store');
    Route::post('videos/store', 'VideoAPIController@store');
    Route::post('documents/store', 'DocumentAPIController@store');
    Route::post('media/store', 'MediaAPIController@store');
    Route::resource('orders', 'OrderAPIController');
    Route::post('shipping', 'CartAPIController@calculateShipping');

    // Historias 24 horas
    Route::resource('stories', 'StoryAPIController');

    Route::post('products', 'ProductAPIController@store');
    Route::put('products/{id}', 'ProductAPIController@update');

    Route::post('outfits', 'OutfitAPIController@store');
    Route::put('outfits/{id}', 'OutfitAPIController@update');

    Route::get('product_plans', 'ProductAPIController@plans');
    Route::post('products/{productId}/pay/{planId}', 'ProductAPIController@payPlan');

    Route::post('orders/pay/{orderId}', 'OrderAPIController@pay');
    Route::get('order_items/{orderItemId}/track', 'OrderItemAPIController@track');


    Route::get('ubigeos/states', 'UbigeoAPIController@states');
    Route::post('addresses/geocode', 'AddressAPIController@geocode');

    Route::post('stories/{storyId}/click', 'StoryAPIController@click');


    // Admin methods
    Route::prefix('admin')->middleware(['role:super-user'])->group(function () {

        // Change plans from admin
        Route::post('users/{userId}/plan', 'Admin\UserAPIController@changePlan');
        Route::post('products/{productId}/plan', 'Admin\ProductAPIController@changePlan');

        // Update product is_active state from admin
        Route::post('products/{productId}/toggleActive', 'Admin\ProductAPIController@toggleActive');
        Route::post('stories/{storyId}/toggleActive', 'Admin\StoryAPIController@toggleActive');
        Route::post('questions/{questionId}/toggleActive', 'Admin\QuestionAPIController@toggleActive');

        // Refund order
        Route::post('orders/{orderId}/refund', 'Admin\OrderAPIController@refund');
        // Provide admin comment / update
        Route::post('orders/{orderId}', 'Admin\OrderAPIController@update');

        Route::post('orders/{orderId}/delivered', 'Admin\OrderAPIController@markAsDelivered');

        // Admin update order item checkboxes in backoffice
        Route::post('order_items/{orderItemId}', 'Admin\OrderItemAPIController@update');

        Route::post('stores/{storeId}/toggleIsOfficial', 'Admin\UserStoreAPIController@toggleIsOfficial');
    });
});
