<?php


Route::get('threads.php', 'ThreadsController@index');
Route::get('threads.php/{channel}/{thread}', 'ThreadsController@show');
Route::delete('threads.php/{channel}/{thread}', 'ThreadsController@destroy');
Route::post('threads.php/{channel}/{thread}/replies', 'RepliesController@store');
Route::get('/home', 'HomeController@index');
Route::get('/logout', function (){
Auth::logout();
return redirect('http://danielklein18.com/threads.php');
});

Route::auth();
Route::post('register.php', 'LoginController@log')->name('register');
Route::post('/threads.php', 'ThreadsController@store');
Route::get('/threads/create', 'ThreadsController@create');
Route::get('threads.php/{channel}', 'ThreadsController@index');
Route::delete('/replies/{reply}', 'RepliesController@destroy');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
Route::post('threads.php/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');




