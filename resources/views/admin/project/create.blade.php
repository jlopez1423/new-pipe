@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Project</div>
                <div class="panel-body">
                    <form action="{{ route('projects.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" name="name" class="form-control" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Client</label>
                            <select name="client_id" class="form-control" required="required">
                                <option value="">Select One...</option>
                                @foreach( $clients as $client )
                                    <option value="{{ $client->id }}" {{ app('request')->input('client_id') == $client->id ? 'selected="selected"':'' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Work Hours</label>
                            <input type="number" step="any" min="0" name="work_hours" class="form-control" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control datepicker" name="start_date" required="required">
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control datepicker" name="end_date" required="required">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	<script>
	tinymce.init({
		selector:'#description',
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
