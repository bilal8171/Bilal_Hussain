@extends('layouts.app')

@section('content')
<div class="row">	
	<div class="col-md-12">
        <div class="card">
         	<div class="card-body">
				<h5>Add Tag</h5>
				<form method="post" action="{{ url('storetag') }}">
					@csrf
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Tag Name</label>
							<input type="text" name="tag_name" class="form-control form-control-sm" value="{{ old('tag_name') }}">
                              @if($errors->has('tag_name')) 
                                  <span class="alertcss">{{ $errors->first('tag_name') }} </span>
                              @endif
						</div>
						<div class="col-md-2">
							<input type="submit" name="save" value="Save" class="btn btn-sm btn-success" style="position: absolute; top: 30px;">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection