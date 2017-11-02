<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','description','client_id','work_hours','start_date','end_date','status'];

    /**
     * Get a list of tasks associated to the given project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->hasMany( 'App\Task' );
    }

    public function client()
	{
	    return $this->belongsTo( 'App\Client' );
	}

    public function users()
    {
        return $this->belongsToMany( 'App\User' );
    }


}
