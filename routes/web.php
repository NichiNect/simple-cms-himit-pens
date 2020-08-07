<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::get('/articles/create-new-article', 'ArticleController@create')->name('articles.create');
Route::post('/articles/create-new-article', 'ArticleController@store')->name('articles.store');

Route::get('/articles/{article:slug}', 'ArticleController@show')->name('articles.show');
Route::get('/articles/{article:slug}/edit-article', 'ArticleController@edit')->name('articles.edit');
Route::put('/articles/{article}/edit-article', 'ArticleController@update')->name('articles.update');

Route::delete('/articles{article:slug}/delete-article', 'ArticleController@destroy')->name('articles.destroy');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function() {
	// dashboard
	Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard.index');
	// user management
	Route::get('/admin/user-management', 'UserAdminController@index')->name('admin.users.index');
	Route::get('/admin/user-management/new', 'UserAdminController@create')->name('admin.users.create');
	Route::post('/admin/user-management/new', 'UserAdminController@store')->name('admin.users.store');
	Route::get('/admin/user-management/{id}/edit', 'UserAdminController@edit')->name('admin.users.edit');
	Route::patch('/admin/user-management/{id}/edit', 'UserAdminController@update')->name('admin.users.update');
	Route::delete('/admin/user-management/{id}/delete', 'UserAdminController@destroy')->name('admin.users.destroy');
	// article management
	Route::get('/admin/article-management', 'ArticleAdminController@index')->name('admin.articles.index');
});

Route::get('/asd', function() {
	return view('layouts.admin');
});