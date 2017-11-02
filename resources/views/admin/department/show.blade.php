@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Departments
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @if( count( $departments ) )
                            @foreach( $departments as $department )
                                <li class="list-group-item">
                                    {{ $department->name }}
                                    <div class="pull-right action-buttons">
                                        <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                No departments found.
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Total Count <span class="label label-info">25</span></h6>
                        </div>
                        <div class="col-md-6">
                            <ul class="pagination pagination-sm pull-right">
                                <li class="disabled"><a href="#">«</a></li>
                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
