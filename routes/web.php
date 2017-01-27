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

use  Illuminate\Http\Request;


Route::match(['post','get'],'/search','SearchController@search');

Route::get('/type_search','SearchController@search_by_typing');

Route::group(['middleware'=>'auth'],function(){

    Route::get('/home','UserController@home');

    Route::get('/profile/edit/','UserController@showProfileForm');

    Route::post('/profile/edit','UserController@updateProfile');

    Route::get('/gallery','UserController@showGallery');

    Route::post('/delete_gallery','UserController@deletePhotos');

    Route::post('/gallery_upload','UserController@uploadPhotos');

    Route::get('/reviews/{filter?}','UserController@getReviews');

    Route::get('/gallery/publish','UserController@publish');

    Route::post('/add/offdays','UserController@addOffDays');

    Route::get('remove/offdays','UserController@removeOffDays');
});// end of middleware=>auth grouping



Route::get('/detail/{company}','DetailsController@details');

Route::post('/client_mail','MailController@sendMail');

Route::post('/write_review','GuestController@writeReview');

Route::get('/wel',function(){
    return view('layouts.home');
});

Auth::routes();

Route::get('/', 'GuestController@index');

