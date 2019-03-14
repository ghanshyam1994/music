<?php

use App\Category;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Category::all();
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
//
Route::post('getcategories', 'API\ACategoryController@categories_list');
Route::post('getitems', 'API\AItemController@getitems');

// get cities
Route::any('getcities', 'API\AItemController@getcities');

// forget password
Route::post('password-reset', 'API\AUserController@password_reset');
Route::get('songs-list', 'API\SongsController@list_songs');
Route::get('add-device-token', 'API\SongsController@add_device_token');


Route::group(['middleware' => 'auth:api'], function() {

    Route::post('save-order', 'API\AOrderController@save_order');
    Route::post('update-order/{orderid}', 'API\AOrderController@update_order');
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{article}', 'ArticleController@update');
    Route::delete('articles/{article}', 'ArticleController@delete');


    // update user profile
    Route::post('update-profile', 'API\AUserController@update_profile');

    // get orders
    Route::get('get-orders/{orderid?}', 'API\AOrderController@get_orders');
});
