<?php

use App\Http\Controllers\Blog\PostsController;
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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('blog/posts/{post}', [PostsController::class, 'show'] )->name('blog.show');
Route::get('blog/categories/{category}', [PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}', [PostsController::class, 'tag'])->name('blog.tag');
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagsController');
    Route::get('trashed_posts', 'PostController@trash')->name('trashed_posts.index');
    Route::put('restore_posts/{post}', 'PostController@restore')->name('restore_posts.index');
});
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('users/profile', 'UsersController@editProfile')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@updateProfile')->name('users.update-profile');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

