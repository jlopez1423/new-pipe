<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Task;
use App\Time;
use App\User;
use Validator;

class TaskController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['project.client'])->get();
    	return view( 'admin.task.index', compact( 'tasks' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
    	return view( 'admin.task.create', compact( 'users' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find( $request->user_id );
    	$task = Task::create( $request->toArray() );
        $task->notification_users()->save( $user );

    	return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $ids = DB::table('task_user')->select('user_id')->where('task_id', $task->id )->pluck('user_id');
        $users = User::whereNotIn('id', $ids->all() )->get();
        return view( 'admin.task.show', compact( 'task', 'users' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::withTrashed()->get();
        $task = Task::find( $task->id );
        return view( 'admin.task.edit', compact('task','users') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->fill( $request->toArray() );
        $task->save();

        return redirect()->route( 'tasks.show', $task );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task = Task::find( $task->id );
        $task->delete();

        return redirect()->route( 'tasks.index' );
    }

    /**
     * Custom Routes
     */


    /**
     * Return all the time entries for a specific task
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function taskTime(Task $task)
    {
        $task = $task->load('time');
        return view( 'admin.task.taskTime', compact( 'task' ) );
    }

    /**
     * Add a new relation between task and users
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function addNotificationUser(Request $request, Task $task)
    {
        if ( $request->user )
        {
            $user = User::find( $request->user );
            $user_pivot = $task->notification_users()->save( $user );
        }

        return redirect()->route('tasks.show', $task)->with('_flash_success','User added to task');
    }

    /**
     * Removes relationship between task and users
     *
     * @return \Illuminate\Http\Response
     */
    public function removeNotificationUser(Request $request)
    {
        $task = Task::find( $request->task );
        $user = User::find( $request->user );
        $task->notification_users()->detach( $user );
        return $task->load('notification_users');
        return redirect()->route('tasks.show', $task)->with('_flash_success','User removed from task');
    }




}
