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