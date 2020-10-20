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

use App\Http\Controllers\Blog\PostsController;

Route::get('/','WelcomeController@index')->name('welcome');
Route::get('blog/posts/{post}',[PostsController::class, 'show'])->name('blog.show');
Route::get('blog/categories/{category}',[PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[PostsController::class, 'tag'])->name('blog.tag');


Route::get('users/edit-profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/update-profile', 'UsersController@update')->name('users.update-profile');

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');;

Route::resource('categories', 'CategoriesController');
Route::resource('posts', 'PostsController');
Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
Route::put('restore-posts/{post}','PostsController@restore')->name('restore.posts');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('posts', 'PostsController');
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
    Route::put('restore-posts/{post}','PostsController@restore')->name('restore.posts');

    Route::get('pending-posts', 'PostsController@pending')->name('pending.posts');
    Route::get('user-pending-posts', 'PostsController@pendingPosTForUser')->name('pending.posts.user');
    Route::get('pending-posts-approve/{id}', 'PostsController@pendingApprove')->name('pending.approve');
    Route::get('pending-posts-remove/{id}', 'PostsController@pendingRemove')->name('pending.remove');



    Route::get('subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('subscriber/{subscriber}','SubscriberController@deleteSubscriberFunction')->name('subscriber.destroy');


});


Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('users', 'UsersController@index')->name('users.index');
    
    Route::post('user/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

