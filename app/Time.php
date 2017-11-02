<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    //
    protected $table = 'time';

    protected $fillable = [ 'task_id', 'description', 'user_id', 'hours' ];

    public function task()
    {
        return $this->belongsTo( 'App\Task' );
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
