<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/test', 'Chat\TestController@test');

Route::get('/chat', 'Chat\ChatController@index');

Route::get('/channel/chat-top/{channelId}', 'Chat\ChatController@chatTop');

Route::get('/channel/messages/{channelId}/{pageNumber?}', 'Chat\ChannelController@messages');

Route::get('/channel/markread/{channelId}', 'Chat\ChannelController@markMessagesRead');

Route::post('/uploads/file', 'Chat\UploadController@fileUpload')->name('file.upload');

Route::get('images/{filename}', 'Chat\FileController@imageDownload');

Route::get('files/{filename}', 'Chat\FileController@fileDownload');