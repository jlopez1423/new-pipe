@extends( 'layouts.app' )

@section( 'content' )
	<div class="row">
		<div class="col-lg-12">
			<h1>Create a Task</h1>
			<form method="POST" action="/admin/tasks">
				
				{{ csrf_field() }}

				<div class="form-group">

					<label for="title">Task Title:</label>
					<input type="text" class="form-control" id="title" name="name" required>

				</div>

				<div class="form-group">

					<label for="body">Body</label>
					<textarea name="body" id="body" class="form-control"></textarea>

				</div>

				<div class="form-group">

					<label for="user">Responsible</label>
					<select type="text" class="form-control" id="user" name="user_id" required>
						<option value="default">Select Responsible</option>

						@foreach( $users as $user ):
							<option value="{{ $user->id }}"> {{ $user->fullName() }}</option>
						@endforeach

					</select>
				</div>

				<div class="row">
					<div class="form-group col-sm-4">
						<label for="task_time">Time</label>
						<input type="number" step="any" class="form-control" id="task_time" name="task_time" required>
					</div>
					{{-- start date --}}
					<div class="form-group col-sm-4">
						<label for=start_date>Start Date</label>
						<input type="date" class="form-control" id="start_date" name="start_date" required>
					</div>
					{{-- end date --}}
					<div class="form-group col-sm-4">
						<label for=end_date>End Date</label>
						<input type="date" class="form-control" id="end_date" name="end_date" required>
					</div>
				</div>

				<input type="hidden" name="project_id" value="{{ Request::get('project_id') }}" />

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Publish</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section( 'footer' )
	<script>
		//If we see changes to this input field check to make sure entry is valid
		$( "#task_time" ).blur(function() {
			var task_time =  $( '#task_time' ).val();
			timeValidation( task_time );
		});

		//Need to do validation here
		function timeValidation( task_time )
		{
			if( task_time % .25 != 0 )
			{
				alert( "Please enter a valid time entry" );

			}
		}
	</script>
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
