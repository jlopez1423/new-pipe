@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">{{ $project->name }}</h1>
            <p>
                {!! $project->description !!}
            </p>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Task List</span>
                    <div class="actions pull-right" style="display: block;">
                        <a href="{{ route( 'tasks.create', array('project_id' => $project ) ) }}" class="btn btn-success"><i class="fa fa-plus"></i> New Task</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="task-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hours</th>
                                <th>Responsible</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $project->tasks as $task )
                                <tr>
                                    <td>
                                        <a href="{{ route( 'tasks.show', $task ) }}">{{ $task->name }}</a>
                                    </td>
                                    <td>
                                        {{ round( $task->task_time ) }}
                                    </td>
                                    <td>
                                        {{ $task->user ? $task->user->fullName(): '' }}
                                    </td>
                                    <td>
                                        {{ date('M dS, Y', strtotime( $task->start_date ) ) }}
                                    </td>
                                    <td>
                                        {{ date('M dS, Y', strtotime( $task->end_date ) ) }}
                                    </td>
                                    <td>
                                        @php
                                        switch( $task->status )
                                        {
                                            case 'pending':
                                            case 'in progress':
                                            $icon = 'gears blue';
                                            break;
                                            case 'stalled':
                                            $icon = 'exclamation-triangle red';
                                            break;
                                            case 'completed':
                                            $icon = 'flag-checkered green';
                                            break;
                                            case 'not started':
                                            $icon = 'low-vision';
                                            break;
                                        }
                                        @endphp
                                        <i class="fa fa-{{ $icon }}"></i>
                                        {{ $task->status }}
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
