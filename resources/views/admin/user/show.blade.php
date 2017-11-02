@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">User Details</div>
                
                <div class="panel-body">
                    <div class="form-group">
                        <label>First</label>
                        <input type="text" name="first_name" class="form-control" readonly value="{{ $user->first_name }}"/>
                    </div>
                    <div class="form-group">
                        <label>Last</label>
                        <input type="text" name="last_name" class="form-control" readonly value="{{ $user->last_name }}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" readonly value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role_id" class="form-control" readonly>
                            @foreach( \App\Role::all() as $role )
                                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected="selected"': '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if( Auth::user()->isAdmin() )
                    <div class="panel-footer">
                        <form action="{{ route( 'users.edit', $user ) }}" method="get">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <div class="text-right">
                                <button class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
