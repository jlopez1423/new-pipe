<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $fillable = [
		'name',
		'tax_number',
		'website',
		'logo',
		'status',
		'note'
	];

	public static $statuses = [
		'active' => 'active',
		'inactive' => 'inactive'
	];

	public $rules = [
		'name' => [ 'required' ]
	];

	/**
     * Get a list of contacts associated to the given client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany( 'App\Contact' );
    }

	/**
     * Get all of the client's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

	public function projects()
	{
	    return $this->hasMany( 'App\Project' );
	}

	public function statuses()
	{
	    return self::$statuses;
	}


}
