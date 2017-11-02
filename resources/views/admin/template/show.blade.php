@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">{{ $template->name }}</h1>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Template Items</span>
                    <div class="actions pull-right" style="display: block;">
                        <a href="" class="btn btn-success"><i class="fa fa-plus"></i> New Item</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="task-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Action Item</th>
                                <th>Created</th>
                                <th>Modified</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $template->actions as $action )
                                <tr>
                                    <td>{{ $action->pivot->id }}</td>
                                    <td>{{ $action->display_name }}</td>
                                    <td>{{ $action->pivot->created_at }}</td>
                                    <td>{{ $action->pivot->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
