<?php

namespace App\Observers;

use App\Comment;

class CommentObserver
{
    /**
     * Listen to the Comment created event.
     *
     * @param  Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
        //mail('bmiller@three29.com','Comment created','Isnt that veird?');
    }
}
