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

Route::get('dashboard', 'DashboardController@index');
Route::get('create-category', 'CategoryController@create');
Route::post('post-category-form', 'CategoryController@store');
Route::get('all-categories', 'CategoryController@index')->name('category.index');
Route::get('edit-category/{id}', 'CategoryController@edit');
Route::post('update-category/{id}', 'CategoryController@update');
Route::delete('delete-category/{id}', 'CategoryController@destroy');

Route::get('get-blog-post-form', 'BlogPostController@create');
Route::get('all-blog-post', 'BlogPostController@index')->name('blog.index');
Route::post('store-blog-post', 'BlogPostController@store');
Route::get('edit-blog-post/{id}', 'BlogPostController@edit');
Route::post('update-blog-post/{id}', 'BlogPostController@update');
Route::delete('delete-blog-post/{id}', 'BlogPostController@destroy');

