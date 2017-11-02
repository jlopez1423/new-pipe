@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Create Template</div>

				<div class="panel-body">

					<form action="{{ route('clients.store') }}" method="post">

						{{ csrf_field() }}

						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control"/>
						</div>
						<h3>Actions</h3>
						<div class="actions pull-right">
							<a id="new_action" class="btn btn-success"><i class="fa fa-plus"></i> Add Action</a>
						</div>
						<table class="table" id="actions">
							<thead>
								<tr>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>


						<div class="form-group text-right">
							<button class="btn btn-success">Create</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script>
	var options = JSON.parse('{!! $template->all_actions() !!}');
	var option_string = '';
	for (var i = 0; i < options.length; i++) {
		option_string += '<option value="'+options[i].id+'">'+options[i].display_name+'</option>';
	}
	$(document).ready(function(){
		var i = 0;
		$('#new_action').click(function(){
			$('#actions tbody').append('<tr><td><select name="action" class="action_item" id="action_item_'+i+'"><option value="">'+option_string+'+</option></select></td></tr>');
		});

		$('body').on('change','.action_item').change(function(){
			if ( $(this).val() != '' )
			{
				alert( $(this).text() );
			}
		});
	});
	</script>
@endsection
