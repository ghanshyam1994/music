<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::group(['middleware' => ['auth']], function () {

    // Route::get('change', 'HomeController@password_change');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/{slug}', 'HomeController@index')->name('user.profile');

    // manage categories
    Route::get('/categories', 'CategoryController@manage_category')->name('categories');

    Route::get('/add-category', 'CategoryController@add')->name('add.category');
    Route::post('/store-category', 'CategoryController@store_category')->name('store.category');

    Route::get('/edit-category/{id}', 'CategoryController@category_edit')->name('category-edit');
    Route::post('/update-category/{id}', 'CategoryController@category_update')->name('category-update');

    Route::get('/delete-category/{id}', 'CategoryController@delete_category')->name('delete.category');


    // manage subcategory

    Route::get('/sub-categories', 'CategoryController@manage_subcategory')->name('subcategories');

    Route::get('/add-subcategory', 'CategoryController@subcategroy_add')->name('add.subcategory');
    Route::post('/store-subcategory', 'CategoryController@store_subcategory')->name('store.subcategory');

    Route::get('/edit-subcategory/{id}', 'CategoryController@subcategory_edit')->name('subcategory-edit');
    Route::post('/update-subcategory/{id}', 'CategoryController@subcategory_update')->name('subcategory-update');

    Route::get('/delete-subcategory/{id}', 'CategoryController@delete_subcategory')->name('delete.subcategory');


    // manage items
    Route::get('/manage-items', 'ItemController@manage_items')->name('manage-items');

    Route::get('/add-item', 'ItemController@add_item')->name('add-item');
    Route::post('/store-item', 'ItemController@store_item')->name('store-item');

    Route::get('/edit-item/{itemid}', 'ItemController@edit_item')->name('item-edit');
    Route::post('/update-item/{itemid}', 'ItemController@update_item')->name('update-item');

    Route::get('/delete-item/{itemid}', 'ItemController@delete_item')->name('delete-item');

    // manage songs
    Route::get('/manage-songs', 'MySongsController@manage_songs')->name('manage-songs');


    Route::get('/ajax-subcategory/{caetgoryid}', 'MySongsController@list_subcategory')->name('ajax-subcategory');

    Route::get('/add-song', 'MySongsController@add')->name('add-song');
    Route::post('/store-song', 'MySongsController@store')->name('store-song');

    Route::get('/edit-song/{songid}', 'MySongsController@edit')->name('item-song');
    Route::post('/update-song/{songid}', 'MySongsController@update')->name('update-song');

    Route::get('/delete-song/{songid}', 'MySongsController@delete')->name('delete-song');


    // manage order
    Route::get('/manage-orders', 'OrderController@manage_order')->name('manage-orders');



    //manage users
    Route::get('/manage-users', 'UserController@manage_users')->name('manage-users');


    // get category type
    Route::get('/get-category-type/{id}', 'CategoryController@categroy_type')->name('categroy-type');

    // manage store location
    Route::get('/manage-store-location', 'StoreLocationController@manage_store_location')->name('manage-store-location');
    Route::get('/add-store-location', 'StoreLocationController@add_store_location')->name('add-store-location');
    Route::post('/store-store-locaiton', 'StoreLocationController@store_store_location')->name('store-store-location');
    Route::get('/edit-store-loation/{storeid}', 'StoreLocationController@edit_store_location')->name('edit-store-location');
    Route::post('/update-store-location/{storeid}', 'StoreLocationController@update_store_location')->name('update-store-location');
    Route::get('/delete-store-location/{storeid}', 'StoreLocationController@delete_store_location')->name('delete-store-location');
    Route::get('/uploadfile','UploadFileController@index');
    Route::post('/uploadfile','UploadFileController@showUploadFile');

});
