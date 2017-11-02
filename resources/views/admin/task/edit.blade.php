@extends( 'layouts.app' )

@section( 'content' )
	<div class="container">

		<div class="row">

			<div class="row">
				<form method="POST" action="{{ route('tasks.update', $task) }}">
					{{ method_field('PUT') }}
					{{ csrf_field() }}

					<div class="form-group">

						<label for="title">Task Title:</label>
						<input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>

					</div>

					<div class="form-group">

						<label for="body">Body</label>
						<textarea name="body" id="body" class="form-control" required>{{ $task->body }}</textarea>

					</div>

					<div class="form-group">

						<label for="user">Responsible</label>
						<select type="text" class="form-control" id="user" name="user" required>
						<option value="default">Select Responsible</option>

							@foreach( $users as $user ):
								<option value="{{ $user->id }}" {{ $user->trashed() ? 'disabled':'' }} {{ ( $user->id == $task->user_id )? 'selected="selected"':'' }}> {{ $user->first_name . ' ' . $user->last_name }}</option>
							@endforeach

						</select>
					</div>

					<div class="row">
						<div class="form-group col-sm-4">
							<label for="task_time">Time</label>
							<input type="number" step="any" class="form-control" id="task_time" name="task_time" value="{{ $task->task_time }}" required>
						</div>
						{{-- start date --}}
						<div class="form-group col-sm-4">
							<label for=start_date>Start Date</label>
							<input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}" required>
						</div>
						{{-- end date --}}
						<div class="form-group col-sm-4">
							<label for=end_date>End Date</label>
							<input type="date" class="form-control" id="end_date" name="end_date" value="{{ $task->end_date }}" required>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Publish</button>
					</div>
				</form>

			</div><hr>

		</div>

	</div>

@endsection

@section( 'footer' )
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	<script>
	tinymce.init({
		selector:'#body',
		theme: 'modern',
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
	});

	</script>
@endsection
