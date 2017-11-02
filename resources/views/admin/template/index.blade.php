@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Template List</div>

                <div class="panel-body">

                    <table id="template-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $templates as $template)
                                <tr>
                                    <td><a href="{{ route('templates.show', $template) }}">{{ $template->name }}</a></td>
                                    <td>{{ $template->created_at }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
