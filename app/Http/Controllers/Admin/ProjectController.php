<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Project;
use App\Client;

class ProjectController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $projects->load('client');
		return view('admin.project.index', compact( 'projects') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.project.create', compact('clients') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create( $request->toArray() );
        $project->save();

    	return redirect()->route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show', compact( 'project' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.project.edit', compact('project','clients') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->fill( $request->toArray() );
        $project->save();

    	return redirect()->route('projects.index')->with('_flash_success', $project->name . ' Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ( $project )
        {
            $project->delete();
        }
        return redirect()->route('projects.index')->with('_flash_success','Project Deleted');
    }
}
