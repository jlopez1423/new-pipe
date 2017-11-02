<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Comment;
use App\Task;
use App\Mail\CommentNotification;

class CommentController extends \App\Http\Controllers\Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::find( $request->input('task') );

        $comment = new Comment( $request->toArray() );
        $comment->user_id = $request->input('user_id');

        if ( $task->comments()->save( $comment ) )
        {
            \Mail::to( $task->notification_users )->queue( new CommentNotification( $task ) );
            return $task->load('comments');
        }
    }
}
