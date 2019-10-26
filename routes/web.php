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

Route::get('/', function () {
    return redirect(route('login'));
});

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@userLogout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'AuthAdmin\LoginController@logout')->name('user.logout');

//inventory
Route::prefix('inventory')->group(function(){
    Route::get('json', 'InventoriesController@json')->name('inventory.json');
    Route::get('/', 'InventoriesController@index')->name('inventory.index');
    Route::get('add', 'InventoriesController@add')->name('inventory.add');
    Route::post('store', 'InventoriesController@store')->name('inventory.store');
    Route::get('edit/{id}', 'InventoriesController@edit')->name('inventory.edit');
    Route::post('update', 'InventoriesController@update')->name('inventory.update');
    Route::post('destroy/{id}', 'InventoriesController@destroy')->name('inventory.destroy');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::post('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    //users inventory
    Route::get('user-inventory/json', 'UserInventoryController@json')->name('user.iventory.json');
    Route::get('user-inventory', 'UserInventoryController@index')->name('user.iventory.index');
    Route::get('user-inventory/get', 'UserInventoryController@get')->name('user.iventory.get');
    Route::post('user-inventory/update', 'UserInventoryController@update')->name('user.iventory.update');

    //users management
    Route::get('user-management/json', 'UserManagementController@json')->name('user.management.json');
    Route::get('user-management', 'UserManagementController@index')->name('user.management.index');
    Route::get('user-management/{id}', 'UserManagementController@edit')->name('user.management.edit');
    Route::post('user-management/update', 'UserManagementController@update')->name('user.management.update');

    //update admin informaiton
    Route::get('detail/{id}', 'AdminController@edit')->name('admin.edit');
    Route::post('update', 'AdminController@update')->name('admin.update');
});

Route::get('mail-action/approved/{id}', 'ApiController@actionApprove')->name('mail-action.approved');
Route::get('mail-action/reject/{id}', 'ApiController@actionReject')->name('mail-action.reject');
Route::get('mail-action', 'ApiController@index')->name('mail-action');


