<?php

use App\Task;

//Only if user is logged in
Route::group( [ 'prefix'=> 'admin', 'middleware'=>'auth', 'namespace' => 'Admin' ] , function(){

    Route::resource('clients', 'ClientController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');
    Route::resource('users', 'UserController');
    Route::resource('time', 'TimeController');
    Route::resource('templates', 'TemplateController');

    Route::post('/comments', 'CommentController@store')->name('comments.store');

    Route::get('task/time/{task}','TaskController@taskTime');
    Route::post('tasks/{task}/user/','TaskController@addNotificationUser');
    Route::delete('tasks/{task}/user/{user}','TaskController@removeNotificationUser');

    Route::get('/users/{user}/tasks','UserController@userTasks')->name('user_tasks');

    Route::get('/search', 'General@search');

    Route::get( '/reports/timeByProject', 'ReportController@timeByProject' );

} );

Route::get( '/', function() {
    return view( 'welcome' );
})->name( 'home' );

Route::get( '/', function(){
    return view( 'admin.dashboard');
})->middleware('auth')->name('admin.dashboard');



// define auth routes
Route::group( ['prefix' => 'auth', 'namespace' => 'Auth' ], function() {

    Route::get( '/login', 'LoginController@show' )->name( 'auth.login' );
    Route::get( '/login/google', 'LoginController@redirectToGoogle' )->name( 'auth.google.login' );
	Route::get( '/login/google/callback', 'LoginController@handleGoogleCallback');
    Route::get( '/logout', 'LoginController@logout' )->name( 'auth.logout' );

} );


Route::get( '/reports/time', 'ReportController@time' );
Route::get( '/reports/highcharts', 'ReportController@highcharts' );
