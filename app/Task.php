<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [ 'name', 'body', 'task_time', 'user_id', 'project_id', 'start_date', 'end_date' ];

    /**
     * Get all of the task's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->orderBy('created_at','desc');
    }

    public function project()
    {
        return $this->belongsTo( 'App\Project' );
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function time()
    {
        return $this->hasMany( 'App\Time' );
    }

    public function notification_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withTrashed();
    }



    public function timeTotal()
    {
        $total = 0.00;

        if ( count ( $this->time ) )
        {
            foreach( $this->time as $time )
            {
                $total += $time->hours;
            }
        }

        return $total;
    }

    public function getVariance()
    {
        return $this->task_time - $this->timeTotal();
    }


}
