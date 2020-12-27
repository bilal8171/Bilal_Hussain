@extends('layouts.app')

@section('content')
<div class="row">	
	<div class="col-md-12">
        <div class="card">
         	<div class="card-body">
				<h5>Edit Tag</h5>
				<form method="post" action="{{ url('tagupdate',$tag->id) }}">
					@csrf
					<div class="row">
						<div class="col-md-4 form-group">
							<label>Tag Name</label>
							<input type="text" name="tag_name" class="form-control form-control-sm" value="{{ $tag->tag_name }}">
                              @if($errors->has('tag_name')) 
                                  <span class="alertcss">{{ $errors->first('tag_name') }} </span>
                              @endif
						</div>
						<div class="col-md-4 form-group">
							<label>Tage Status</label>
							<select name="tag_status" class="form-control form-control-sm">
								<option value="1" {{ '1' == $tag->tag_status ? 'selected' : ''}} >Active</option>
								<option value="0" {{ '0' == $tag->tag_status ? 'selected' : ''}} >Deactive</option>
							</select>
                              @if($errors->has('tag_status')) 
                                  <span class="alertcss">{{ $errors->first('tag_status') }} </span>
                              @endif
						</div>
						<div class="col-md-2">
							<input type="submit" name="save" value="Update" class="btn btn-sm btn-info" style="position: absolute; top: 30px;">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection