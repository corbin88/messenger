<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/message/{id}', 'MessageController@store');

Route::get('/home', 'HomeController@index');

Route::get('/conversations', 'ConversationController@index');

//You need to use conversation id for conversations and not user id

Route::post('/conversations/{userID}', 'ConversationController@startConversation');

Route::get('/conversations/{userID}', 'ConversationController@show');

