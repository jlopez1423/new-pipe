<?php

use Illuminate\Http\Request;
use App\Task;
use App\Client;
use App\Project;
use App\User;
use App\Time;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group( [ 'prefix'=> 'tasks' ] , function(){

    Route::get('/', function (Task $task) {
        return App\Task::all();
    });

    Route::get('/{task}', function (Task $task) {
        return $task->load(['user','notification_users']);
    });

});


Route::group( [ 'prefix'=> 'projects' ] , function(){

    Route::get('/', function (Project $project) {
        return App\Project::all()->load('tasks');
    });

    Route::get('/{project}', function (Project $project) {
        return $project->load(['tasks.user','tasks.notification_users']);
    });

});

Route::group( [ 'prefix'=> 'clients' ] , function(){

    Route::get('/', function (Client $client) {
        return App\Client::all();
    });

    Route::get('/{client}', function (Client $client) {
        return $client;
    });

});


Route::group( [ 'prefix'=> 'users' ] , function(){

    Route::get('/', function (User $user) {
        return App\User::all();
    });

    Route::get('/{user}', function (User $user) {
        return $user;
    });

});

Route::group( [ 'prefix'=> 'reports' ] , function(){
    Route::get('/time', 'APIController@time');
});
