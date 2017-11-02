@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create User</div>

                <div class="panel-body">
                    <form action="/admin/users/" method="post">
                        <input type="hidden" name="id" />
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>First</label>
                            <input type="text" name="first_name" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Last</label>
                            <input type="text" name="last_name" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role_id" class="form-control" required="required">
                                @foreach( App\Role::all() as $role )
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required="required">
                                <option value="">Select One...</option>
                                @foreach( $user->getStatuses() as $status )
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button class="btn btn-success">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
