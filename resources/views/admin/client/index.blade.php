@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="panel-title">Clients List</span>
                    @if( Auth::user()->isAdmin() )
                        <div class="actions pull-right">
                            <a href="{{ route('clients.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> New Client</a>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <table id="clients-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $clients as $client)
                                <tr>
                                    <td>
                                        <a href="{{ route('clients.show', $client) }}">{{ $client->name }}</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{ $client->website }}">{{ $client->website }}</a>
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
