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

Route::get('/', 'GuestController@index');

Route::post('/search','SearchController@search');

Route::get('/detail/{company}',function(App\User $company){
    
    
    foreach($company->categories as $cat)
        echo $cat;
    //return view('details')->with($company);
});

Auth::routes();
