@extends('layouts.app')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
@endsection

@section('content')
    <div id="app">
        <form action="" method="get" class="">
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
            <div class="form-group">
                <label>Workspace</label>
                <select name="workspace_id" class="form-control">
                    <option value="">Select One...</option>
                    @foreach ( array_column( $results, 'workspaceName', 'workspaceID') as $id => $workspace )
                        <option value="{{ $id }}">{{ $workspace }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Project</label>
                <select name="project_id" class="form-control">
                    <option value="">Select One...</option>
                    @foreach ( array_column( $results, 'projectName', 'projectID') as $id => $project )
                        <option value="{{ $id }}">{{ $project }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Search" class="btn btn-primary">
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Workspace</th>
                    <th>Project Name</th>
                    <th>Task Name</th>
                    <th>User Name</th>
                    <th>Created Date</th>
                    <th>Hours</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result )
                    <tr>
                        <td><a href="/reports/timeByProject/?workspace_id={{ $result->workspaceID }}">{{ $result->workspaceName }}</a></td>
                        <td><a href="/reports/timeByProject/?project_id={{ $result->projectID }}">{{ $result->projectName }}</a></td>
                        <td>{{ $result->taskName }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ date( "m/d/Y", strtotime( $result->workDate ) ) }}</td>
                        <td>{{ date('H:i', mktime(0, $result->amount ) ) }} hours</td>
                        <td>{{ $result->description or '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="container">
        <div id="chart"></div>
    </div>
@endsection
