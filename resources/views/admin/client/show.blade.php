@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-title">{{ $client->name }}</h1>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Projects List</span>
                    @if( Auth::user()->isAdmin() )
                        <div class="actions pull-right">
                            <a href="{{ route('projects.create', array( "client_id" => $client->id ) ) }}" class="btn btn-success"><i class="fa fa-plus"></i> New Project</a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">

                    <table id="projects-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hours</th>
                                <th>Responsible</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $client->projects as $project )
                                <tr>
                                    <td>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </td>
                                    <td>
                                        {{ $project->work_hours }}
                                    </td>
                                    <td>
                                        {{ $project->users->implode('first_name', ',') }}
                                    </td>
                                    <td>
                                        {{ $project->status }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                @if ( Auth::user()->isAdmin() )
                    <div class="actions pull-right">

                        <form action="{{ route('clients.destroy', $client) }}" method="post" style="display:inline-block">
                            {{ method_field( 'DELETE' ) }}
                            {{ csrf_field() }}

                           <div class="form-group">
                               <button type="submit" class="btn btn-danger">Delete</button>
                           </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
