<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Client;
use App\Comment;
use App\Contact;
use App\Project;
use App\Task;
use App\User;

class General extends \App\Http\Controllers\Controller
{
	/**
	 * Search function for header
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @see $_GET['search'] search string
	 * @return array results of search
	 */
	public function search(Request $request)
	{
		\DB::enableQueryLog();
	    $search = '%' . $request->input('search') . '%';
		$results = array();

		$client  = Client::where('name', 'LIKE', $search)->orWhere('website', 'LIKE', $search)->get();
		$comment = Comment::where('body', 'LIKE', $search)->get();
		$contact = Contact::where('first_name', 'LIKE', $search)->orWhere('last_name', 'LIKE', $search)->orWhere('title', 'LIKE', $search)->orWhere('phone', 'LIKE', $search)->orWhere('email', 'LIKE', $search)->get();
		$project = Project::where('name', 'LIKE', $search)->orWhere('description', 'LIKE', $search)->get();
		$task    = Task::where('name', 'LIKE', $search)->orWhere('body', 'LIKE', $search)->get();
		$user    = User::where('first_name', 'LIKE', $search)->orWhere('last_name', 'LIKE', $search)->orWhere('email', 'LIKE', $search)->get();

		$results = array(
			"client"  => $client,
			"comment" => $comment,
			"contact" => $contact,
			"project" => $project,
			"task"    => $task,
			"user"    => $user
		);

		return $results;
	}

}
