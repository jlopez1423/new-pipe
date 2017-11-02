@extends( 'layouts.app' )

@section( 'content' )
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks List</div>

                <div class="panel-body">

                    <table id="tasks-list" class="table table-striped">
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

                            @foreach ( $tasks as $task )
                                <tr>
                                    <td>
                                        <a href="/admin/tasks/{{ $task->id }}"> {{ $task->name }}</a>
                                    </td>
                                    <td>
                                        {{ $task->project->client->name }}
                                    </td>
                                    <td>
                                        {{ $task->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route( 'tasks.edit', $task ) }}" >Edit</a>
                                    </td>
                                    <td>
                                        {{ $task->work_hours }}
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
