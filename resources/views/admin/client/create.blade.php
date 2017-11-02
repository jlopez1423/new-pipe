@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Create Client</div>

				<div class="panel-body">

					<form action="{{ route('clients.store') }}" method="post">

						{{ csrf_field() }}

						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Tax Number</label>
							<input type="text" name="tax_number" class="form-control" />
						</div>
						<div class="form-group">
							<label>Website</label>
							<input type="text" name="website" class="form-control" />
						</div>
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control" required>
								<option value="">Select One...</option>
								@foreach ( \App\Client::first()->statuses() as $status )
									<option value="{{ $status }}">{{ ucwords( $status ) }}</option>
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
