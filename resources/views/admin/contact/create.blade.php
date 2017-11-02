@extends('layouts.app')

@section('content')
	<?php /* @var \App\User $user */ ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ ( $client->id ? 'Edit' : 'Create' ) }} Client</div>

                    <div class="panel-body">

						<form action="{{ ( $client->id ? '/admin/client/edit/' : '/admin/client/create/' ) }}" method="post">
							<input type="hidden" name="id" value="{{ $client->id }}" />
							{{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}"/>
                            </div>
                            <div class="form-group">
                                <label>Tax Number</label>
                                <input type="text" name="tax_number" class="form-control" value="{{ $client->tax_number }}" />
                            </div>
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="website" class="form-control" value="{{ $client->website }}" />
                            </div>
                            <div class="form-group">
                                <label>Status</label>
								<select name="status" class="form-control">
									@foreach ( $client->statuses as $status )
										<option value="{{ $status }}" {{ ($status == $client->status )? 'selected="selected"':'' }}>{{ $status }}</option>
									@endforeach
								</select>
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-success">{{ ( $client->id ? 'Update' : 'Create' ) }}</button>
                            </div>
						</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
