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

// Auth
Route::get('login')->name('login')->uses('Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');
Route::post('logout')->name('logout')->uses('Auth\LoginController@logout');

// Dashboard
Route::get('/')->name('dashboard')->uses('DashboardController')->middleware('auth');

// Photos
Route::get('photos')->name('photos')->uses('PhotosController@index')->middleware('remember', 'auth');
Route::get('photos/create')->name('photos.create')->uses('PhotosController@create')->middleware('auth');
Route::post('photos')->name('photos.store')->uses('PhotosController@store')->middleware('auth');
Route::get('photos/{photo}/edit')->name('photos.edit')->uses('PhotosController@edit')->middleware('auth');
Route::put('photos/{photo}')->name('photos.update')->uses('PhotosController@update')->middleware('auth');
Route::delete('photos/{photo}')->name('photos.destroy')->uses('PhotosController@destroy')->middleware('auth');
Route::put('photos/{photo}/restore')->name('photos.restore')->uses('PhotosController@restore')->middleware('auth');


// categories
Route::get('categories')->name('categories')->uses('CategoriesController@index')->middleware('remember', 'auth');
Route::get('categories/create')->name('categories.create')->uses('CategoriesController@create')->middleware('auth');
Route::post('categories')->name('categories.store')->uses('CategoriesController@store')->middleware('auth');
Route::get('categories/{category}/edit')->name('categories.edit')->uses('CategoriesController@edit')->middleware('auth');
Route::put('categories/{category}')->name('categories.update')->uses('CategoriesController@update')->middleware('auth');
Route::delete('categories/{category}')->name('categories.destroy')->uses('CategoriesController@destroy')->middleware('auth');
Route::put('categories/{category}/restore')->name('categories.restore')->uses('CategoriesController@restore')->middleware('auth');

// secteurs
Route::get('secteurs')->name('secteurs')->uses('SecteurController@index')->middleware('remember', 'auth');
Route::get('secteurs/create')->name('secteurs.create')->uses('SecteurController@create')->middleware('auth');
Route::post('secteurs')->name('secteurs.store')->uses('SecteurController@store')->middleware('auth');
Route::get('secteurs/{secteur}/edit')->name('secteurs.edit')->uses('SecteurController@edit')->middleware('auth');
Route::put('secteurs/{secteur}')->name('secteurs.update')->uses('SecteurController@update')->middleware('auth');
Route::delete('secteurs/{secteur}')->name('secteurs.destroy')->uses('SecteurController@destroy')->middleware('auth');
Route::put('secteurs/{secteur}/restore')->name('secteurs.restore')->uses('SecteurController@restore')->middleware('auth');


// Users
Route::get('users')->name('users')->uses('UsersController@index')->middleware('remember', 'auth');
Route::get('users/create')->name('users.create')->uses('UsersController@create')->middleware('auth');
Route::post('users')->name('users.store')->uses('UsersController@store')->middleware('auth');
Route::get('users/{user}/edit')->name('users.edit')->uses('UsersController@edit')->middleware('auth');
Route::put('users/{user}')->name('users.update')->uses('UsersController@update')->middleware('auth');
Route::delete('users/{user}')->name('users.destroy')->uses('UsersController@destroy')->middleware('auth');
Route::put('users/{user}/restore')->name('users.restore')->uses('UsersController@restore')->middleware('auth');

// Images
Route::get('/img/{path}', 'ImagesController@show')->where('path', '.*');

// Organizations
Route::get('organizations')->name('organizations')->uses('OrganizationsController@index')->middleware('remember', 'auth');
Route::get('organizations/create')->name('organizations.create')->uses('OrganizationsController@create')->middleware('auth');
Route::post('organizations')->name('organizations.store')->uses('OrganizationsController@store')->middleware('auth');
Route::get('organizations/{organization}/edit')->name('organizations.edit')->uses('OrganizationsController@edit')->middleware('auth');
Route::put('organizations/{organization}')->name('organizations.update')->uses('OrganizationsController@update')->middleware('auth');
Route::delete('organizations/{organization}')->name('organizations.destroy')->uses('OrganizationsController@destroy')->middleware('auth');
Route::put('organizations/{organization}/restore')->name('organizations.restore')->uses('OrganizationsController@restore')->middleware('auth');

// Contacts
Route::get('contacts')->name('contacts')->uses('ContactsController@index')->middleware('remember', 'auth');
Route::get('contacts/create')->name('contacts.create')->uses('ContactsController@create')->middleware('auth');
Route::post('contacts')->name('contacts.store')->uses('ContactsController@store')->middleware('auth');
Route::get('contacts/{contact}/edit')->name('contacts.edit')->uses('ContactsController@edit')->middleware('auth');
Route::put('contacts/{contact}')->name('contacts.update')->uses('ContactsController@update')->middleware('auth');
Route::delete('contacts/{contact}')->name('contacts.destroy')->uses('ContactsController@destroy')->middleware('auth');
Route::put('contacts/{contact}/restore')->name('contacts.restore')->uses('ContactsController@restore')->middleware('auth');

// Reports
Route::get('reports')->name('reports')->uses('ReportsController')->middleware('auth');

// 500 error
Route::get('500', function () {
    echo $fail;
});
