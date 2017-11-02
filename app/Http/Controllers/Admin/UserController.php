<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User, View, Redirect, Validator;
use Illuminate\Validation\Rule;
use League\Flysystem\Exception;

class UserController extends \App\Http\Controllers\Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::withTrashed()->get();
		return view( 'admin.user.index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = User::getModel();
		return view( 'admin.user.create', compact( 'user' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$rules = User::getModel()->rules;

		$rules[ 'email' ][] = 'unique:users,email';

		$validator = Validator::make( $request->all(), $rules );

		if( $validator->fails() )
		{
			return redirect()->back()->withErrors( $validator->errors() )->withInput( $request->input() );
		}

		try
		{
			$user = User::create( $request->only( [
				'first_name',
				'last_name',
				'email',
				'role_id',
				'status',
			] ) );

			$user->save();

			return route( 'users.index' )->withAlertSuccess( 'User Created' );

		}
		catch (Exception $e)
		{
			return redirect()->back()->withAlertDanger( 'Unable to create user. Reason: ' . $e->getMessage() )->withInput( $request->input() );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
		return view( 'admin.user.show', compact( 'user' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
		return view( 'admin.user.edit', compact( 'user' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

		$user->fill( $request->toArray() );
		$user->save();

		return redirect()->back()->with( '_flash_success', 'User Updated' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = 'deleted';
        $user->save();
		$user->delete();

		session()->flash('_flash_success','User Deleted.');
		return redirect()->route( 'users.index' );
    }

	/**
     * Display the tasks associated with a specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
	public function userTasks(User $user)
	{
		$user = User::find( $user->id );
	    return view( 'admin.user.tasks', compact( 'user' ) );
	}


}
