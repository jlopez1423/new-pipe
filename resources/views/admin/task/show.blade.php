@extends( 'layouts.app' )

@section( 'content' )
	<div class="row">
		<div class="col-lg-12">
			<div class="header">
				<h1>
					{{ $task->name }}

					@if ( Auth::user()->isAdmin() )
						<div class="actions pull-right">

							<a href="{{ route('tasks.edit', $task) }}" class="btn btn-info">Edit</a>

							<form method="POST" action="/admin/tasks/{{ $task->id }}" style="display:inline-block">
								{{ method_field( 'DELETE' ) }}
								{{ csrf_field() }}

							   <div class="form-group">
								   <button type="submit" class="btn btn-danger">Delete</button>
							   </div>
							</form>
						</div>
					@endif
				</h1>
			</div>
		</div>
	</div>

		<div class="row">
			<div class="col-lg-12">
				<p>{!! $task->body !!}</p>
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<ul style="list-style-type:none;padding-left:0px;">
							<li><strong>Client</strong>: {{ $task->project->client->name }}</li>
							<li><strong>Project</strong>: {{ $task->project->name }}</li>
							<li><strong>Responsible</strong>: {{ $task->user->fullName() }}</li>
							<li><small>Created by {{ 'person' }} on {{ $task->created_at }}</small></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<ul style="list-style-type:none;padding-left:0px;">
							<li><strong>Status</strong>: {{ $task->status }}</li>
							<li><strong>Start</strong>: {{ $task->start_date }}</li>
							<li><strong>End</strong>: {{ $task->end_date }}</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table">
							<thead>
								<tr>
									<th></th>
									<th>Actual</th>
									<th>Budget</th>
									<th>Variance</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Time (in hours)</td>
									<td><a href="/admin/task/time/{{ $task->id }}">{{ $task->timeTotal() }}</a></td>
									<td>{{ $task->task_time }}</td>
									<td>{{ $task->getVariance() }}</td>
								</tr>
							</tbody>
						</table>
						<div id="time_area"></div>
						<a id="add_time" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Time</a>
						<br />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="panel-title">
								Comments
								<div class="actions" style="display: inline-block;">
									<a class="btn btn-success" id="add_comment"><i class="fa fa-plus"></i> Add Comment</a>
								</div>
							</div>
						</div>
						<div class="panel-body" id="comments_area">
							@foreach( $task->comments as $comment )
								<div class="comment">
									<div class="comment-header">
										<strong>{{ $comment->user->fullName() }}</strong>
										<span class="pull-right">{{ $comment->created_at }}</span>
									</div>
									<div class="comment-body">
										{!! $comment->body !!}
									</div>
								</div>
								<hr />
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Notification Users</span>
							<a id="add_notification_user" class="btn btn-success pull-right" style="position:relative; top: -5px;"><i class="fa fa-plus"></i> Add User</a>
						</div>
						<div class="panel-body">
							<ul>
								@foreach( $task->notification_users as $user )
									<li>
										<a href="/admin/users/{{ $user->id }}">{{ $user->fullName() }}</a>
										<a><i class="fa fa-remove user_remove" data-task="{{ $task->id }}" data-user="{{ $user->id }}"></i></a>
									</li>
								@endforeach
							</ul>
							<div id="notification_area">
								<form action="/admin/tasks/{{ $task->id }}/user/" method="post" class="form-inline">

									{{ csrf_field() }}

									<div class="form-group">
										<label>User</label>
										<select name="user" class="form-control">
											@foreach ($users as $user)
												<option value="{{ $user->id }}">{{ $user->fullName() }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label></label>
										<input type="submit" class="btn btn-primary">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr />
	</div>
@endsection

@section('footer')
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
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
			$('#comments_area').prepend('<div id="new_comment"><strong>Add New Comment</strong><textarea name="body" id="new_comment_body" class="form-control" rows="10"></textarea><input type="button" id="new_comment_cancel" class="btn btn-default" value="Cancel"><input type="button" value="Add" class="btn btn-primary" id="new_comment_submit"><hr /></div>');
			tinymce.init({
				selector:'#new_comment_body',
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
		});

		$('#add_time').click(function(){
			$('#add_time').attr('disabled','disabled');
			$('#time_area').prepend('<div id="new_time"><strong>Add New Time</strong><br /><div class="form-group"><label>Time</label><input type="number" min="0.25" step=".25" name="time" id="new_time_value" class="form-control input-sm"></div><div class="form-group"><label>Description</label><textarea id="new_time_description" class="form-control"></textarea></div><div class="form-group"><input type="button" id="new_time_cancel" class="btn btn-default" value="Cancel"><input type="button" value="Add" class="btn btn-primary" id="new_time_submit"></div><hr /></div>');
		});

		$('#add_notification_user').click(function(){
			$('#add_notification_user').attr('disabled','disabled');
			$('#notification_area').css('display','block');
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
			if ( tinyMCE.get('new_comment_body').getContent() == '' )
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
			    data: { task: {{ $task->id }}, body: tinyMCE.get('new_comment_body').getContent(), user_id: {{ Auth::user()->id }}  }
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
			    data: { task_id: {{ $task->id }}, hours: $('#new_time_value').val(), description: $('#new_time_description').val(), user_id: {{ Auth::user()->id }}  }
			}).done(function( msg ) {
				if ( msg.id == {{ $task->id }} )
				{
					location.reload();
				}
			});
		});

		$('.user_remove').click( function(){
			$.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

			$.ajax({
			    method: "POST",
			    url: "/admin/tasks/{{ $task->id }}/user/" + $(this).data('user'),
			    data: { _method: 'DELETE', task: {{ $task->id }}, user: $(this).data('user')   }
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
