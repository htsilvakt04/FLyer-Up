
<?php

Route::get('/', 'FlyersController@index');

Route::resource("flyers", "FlyersController");
Route::get("/flyers/delete/{id}", "FlyersController@destroy");
Route::get("{zip}/{street}", "FlyersController@show");
Route::post("{zip}/{street}/photos", ["as" => "store_photo_path", "uses" => "PhotosController@store"]);
Route::delete("photos/{id}", "PhotosController@destroy");

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout');
