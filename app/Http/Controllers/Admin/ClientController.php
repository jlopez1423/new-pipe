<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Client;
use View;
use Redirect;
use Validator;


class ClientController extends \App\Http\Controllers\Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$clients = Client::all();
		return view('admin.client.index', compact( 'clients') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.client.create', compact('client') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$client = Client::create( $request->all() );

		if ( $client->save() )
		{
			return redirect()->route('clients.show', $client )->with('_flash_success', 'Client Created!');
		}

		return redirect()->back()->with('_flash_error','Client NOT Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
		return view( 'admin.client.show', compact('client') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
		return view( 'admin.client.edit', compact('client') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
		$client->fill( $request->all() );
		if ( $client->save() )
		{
			return redirect()->back()->with('_flash_success', 'Client Updated!!!');
		}

		return redirect()->back()->with('_flash_error','Client NOT Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
		$client->delete();
		return redirect()->route('clients.index')->with('_flash_success', 'Client Deleted.');
    }
}
