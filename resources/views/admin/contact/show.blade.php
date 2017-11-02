@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users List</div>

                    <div class="panel-body">

                        <table id="clients-list" class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Website</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $clients as $client)
                            <tr v-for="client in clients">
                                <td>
                                    {{ $client->id }}
                                </td>
                                <td>
                                    {{ $client->name }}
                                </td>
                                <td>
                                    <a target="_blank" href="{{ $client->website }}">Visit Website</a>
                                </td>
                                <td>
                                    {{ $client->status }}
                                </td>
                                <td>
                                    <a href="'<?php echo route( 'client.edit', '') . '/' . $client->id; ?>">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section( 'footer-scripts' )

    <script>
        var list = new Vue({
            el: '#clients-list',
            data: {
                clients: {!! $clients->toJson() !!}
            }
        });
    </script>

@endsection
