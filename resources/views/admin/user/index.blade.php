@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users List
                    @if( Auth::user()->isAdmin() )
                        <div class="pull-right">
                            <a href="/admin/users/create" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">

                    <table id="users-list" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ( $users as $user )
                                <tr @if ( $user->status == 'deleted' ) style="color:rgba(0,0,0,0.2); text-decoration:line-through" @endif>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td >

                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->role->name }}
                                    </td>
                                    <td>
                                        {{ $user->status }}
                                    </td>
                                    <td>
                                        @if ( ! $user->trashed() )
                                            <a href="/admin/users/{{ $user->id }}/edit/" >Edit</a>
                                        @endif
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

    @section( 'footer' )

        <script>
        var list = new Vue({
            el: '#users-list',
            data: {
                users: {!! $users->toJson() !!}
            }
        });
        </script>

    @endsection
