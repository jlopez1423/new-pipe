@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Project List</span>
                    @if ( Auth::user()->isAdmin() )
                    <div class="actions pull-right">
                        <a href="{{ route('projects.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> New Project</a>
                    </div>
                    @endif
                </div>

                <div class="panel-body">

                    <table id="users-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>Task Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ( $projects as $project )
                                <tr>
                                    <td>
                                        <a href="/admin/projects/{{ $project->id }}"> {{ $project->name }}</a>
                                    </td>
                                    <td>
                                        {{ $project->client->name }}
                                    </td>
                                    <td>
                                        {{ $project->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('projects.edit', $project ) }}" >Edit</a>
                                    </td>
                                    <td>
                                        {{ $project->work_hours }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
