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

    
Route::get('/',[
    'uses' => 'UserController@getLogin',
    'as' => 'login'
]);

Route::get('/signup', function () {
    return view('pages.register');
});

Route::get('/dashboard',[
    'uses' => 'UserController@getDashboard',
    'as' => 'dashboard',
    'middleware' => ['auth','role:teacher']
]);

Route::post('/signin',[
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::post('/signup',[
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/uploadfile',[
    'uses' => 'UserController@postUpload',
    'as' => 'upload'
]);

Route::post('/createPost', [
    'uses' => 'UserController@postCreatePost',
    'as' => 'postCreatePost'
]);

Route::get('/getPost/{postID}',[
    'uses' => 'UserController@getPost',
    'as' => 'getPost',
    'middleware' => 'auth'
]);

Route::get('/getupload/{filename}',[
    'uses' => 'UserController@getUpload',
    'as' => 'getupload',
    'middleware' => 'auth'
]);

Route::get('/logout',[
    'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::get('/sdashboard',[
    'uses' => 'UserController@getStudentDash',
    'as' => 'sdashboard',
    'middleware' => 'auth'
]);

Route::get('/deletefile/{uploadid}',[
    'uses' => 'UserController@getDelete',
    'as' => 'deletefile',
    'middleware' => 'auth'
]);


    
    




