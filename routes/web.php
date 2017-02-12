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

Route::group([ 'middleware' => ['web']], function() {

Route::get('auth/login',['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('auth/login','Auth\LoginController@login');
 Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('auth/register','Auth\RegisterController@getRegister');
Route::post('auth/register','Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@reset');

Route::resource('categories','CategoryController',['except'=>['create']]);


Route::post('comments/{post_id}',['as'=>'comments.store','uses'=>'CommentsController@store']);

Route::get('comments/{id}/edit',['as'=>'comments.edit','uses'=>'CommentsController@edit']);

Route::put('comments/{id}',['as'=>'comments.update','uses'=>'CommentsController@update']);

Route::delete('comments/{id}',['as'=>'comments.destroy','uses'=>'CommentsController@destroy']);


Route::resource('tags','TagController',['except'=>['create']]);

Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');
Route::get('blog',['uses'=>'BlogController@getIndex','as'=>'blog.index']);

Route::get('/','PagesController@getIndex');
Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::resource('posts','PostController');

});
