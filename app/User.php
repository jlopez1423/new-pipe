<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /*
	 * Using soft deletes to restrict deleted users from re-signing up
	 */
	use SoftDeletes;

    /*
     * Available statuses for a user
     */
    protected $statuses = ['pending','active','suspended','deleted'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'status', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Get a list of departments current user is associated to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany( 'App\Department' );
    }

    public function isAdmin()
	{
        return ( $this->role['name'] == 'Admin' );
	}

    public function role()
    {
        return $this->belongsTo( 'App\Role' );
    }

    public function projects()
    {
        return $this->belongsToMany( 'App\Project' );
    }

    public function tasks()
    {
        return $this->belongsToMany( 'App\Task' )->withTimestamps();
    }

    public function getStatuses()
    {
        return $this->statuses;
    }

    public function time()
    {
        return $this->hasManyThrough( 'App\Time', 'App\Task' );
    }



}
