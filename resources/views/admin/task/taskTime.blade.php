@extends( 'layouts.app' )

@section( 'content' )
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Time Entries for <br /><a href="{{ route( 'tasks.show', $task ) }}">{{ $task->name }}</a></h1>
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table">
							<thead>
								<tr>
									<th>Date</th>
									<th>User</th>
									<th>Hours</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $task->time as $time )
									<tr>
										<td>{{ date('m/d/y', strtotime( $time->created_at ) ) }}</td>
										<td>{{ $time->user->fullName() }}</td>
										<td>{{ $time->hours }}</td>
										<td>{{ $time->description }}</td>
									</tr>
								@endforeach
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
		<hr />
	</div>
@endsection

@section('footer')
	<script>
	function isHash( event )
	{
		event = event || window.event;
		var keyCode = event.keyCode || event.which;
		if (keyCode == 35)
		{
			return true;
		}
	}

	function isAt( event )
	{
		event = event || window.event;
		var keyCode = event.keyCode || event.which;
		if (keyCode == 64)
		{
			return true;
		}
	}

	$(document).ready(function(){
		$('#add_comment').click(function(){
			$('#add_comment').attr('disabled','disabled');
			$('#comments_area').prepend('<div id="new_comment"><strong>Add New Comment</strong><textarea name="body" id="new_comment_body" class="form-control"></textarea><input type="button" id="new_comment_cancel" class="btn btn-default" value="Cancel"><input type="button" value="Add" class="btn btn-primary" id="new_comment_submit"><hr /></div>');
		});

		$('#add_time').click(function(){
			$('#add_time').attr('disabled','disabled');
			$('#time_area').prepend('<div id="new_time"><strong>Add New Time</strong><br /><div class="form-group"><label>Time</label><input type="number" min="0.25" step=".25" name="time" id="new_time_value" class="form-control input-sm"></div><div class="form-group"><label>Description</label><textarea id="new_time_description" class="form-control"></textarea></div><div class="form-group"><input type="button" id="new_time_cancel" class="btn btn-default" value="Cancel"><input type="button" value="Add" class="btn btn-primary" id="new_time_submit"></div><hr /></div>');
		});

		$('body').on('click','#new_comment_cancel',function(){
			$('#add_comment').removeAttr('disabled');
			$('#new_comment').remove();
		});

		$('body').on('click','#new_time_cancel',function(){
			$('#add_comment').removeAttr('disabled');
			$('#new_comment').remove();
		});

		$('body').on('keypress','#new_comment_body',function( event ){
			if ( isHash( event ) )
			{
				//alert('# typed');
			}

			if ( isAt( event ) )
			{
				//alert('@ typed');
			}
		});

		$('body').on('click', '#new_comment_submit', function(){
			if ( $('#new_comment_body').val() == '' )
			{
				alert('Comment must not be empty');
				return false;
			}
			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			$.ajax({
			    method: "POST",
			    url: "{{ route('comments.store') }}",
			    data: { task: {{ $task->id }}, body: $('#new_comment_body').val(), user_id: {{ $task->user->id }}  }
			}).done(function( msg ) {
				if ( msg.id == {{ $task->id }} )
				{
					location.reload();
				}
			});
		});

		$('body').on('click', '#new_time_submit', function(){
			if ( $('#new_time_description').val() == '' )
			{
				alert('Description must not be empty');
				return false;
			}
			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			$.ajax({
			    method: "POST",
			    url: "{{ route('time.store') }}",
			    data: { task_id: {{ $task->id }}, hours: $('#new_time_value').val(), description: $('#new_time_description').val(), user_id: {{ $task->user->id }}  }
			}).done(function( msg ) {
				if ( msg.id == {{ $task->id }} )
				{
					location.reload();
				}
			});
		});

	});
	</script>
@endsection
