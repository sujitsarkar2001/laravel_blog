<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');

Route::get('profile/{username}', 'AuthorController@index')->name('author.profile');

Route::get('post', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');


Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('post/{post}', 'CommentController@store')->name('comment.store');
});

Route::get('/search', 'SearchController@index')->name('search.index');


Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']], function(){

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('update/profile', 'SettingsController@updateProfile')->name('update.profile');
    Route::put('update/password', 'SettingsController@updatePassword')->name('update.password');

    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');

    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
    
    Route::get('/authors', 'AuthorController@index')->name('author.index');
    Route::delete('/authors/{id}', 'AuthorController@destroy')->name('author.destroy');

    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
});

Route::group(['as'=>'author.', 'prefix'=>'author', 'namespace'=>'Author', 'middleware'=>['auth','author']], function(){

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('update/profile', 'SettingsController@updateProfile')->name('update.profile');
    Route::put('update/password', 'SettingsController@updatePassword')->name('update.password');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostController');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
    
});

View::composer('layouts.website.partials.footer', function($view){
    $categories = App\Category::all();
    $view->with('categories', $categories);
});