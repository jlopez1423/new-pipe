@extends( 'layouts.app' )

@section( 'content' )
    <h1>{{ $user->first_name }}'s Tasks</h1>

    <table class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Task</th>
                <th>Client</th>
                <th>Project</th>
                <th>Work</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $user->tasks as $task )
                @if ( $task->user_id != Auth::user()->id )
                    @php continue; @endphp
                @endif
                <tr>
                    <td><a href="{{ route( 'tasks.show', $task ) }}">{{ $task->name }}</a></td>
                    <td>{{ $task->project->client->name  }}</td>
                    <td>{{ $task->project->name  }}</td>
                    <td>{{ $task->task_time  }}</td>
                    <td>{{ $task->start_date  }}</td>
                    <td>{{ $task->end_date  }}</td>
                    <td>{{ $task->status  }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
@endsection
