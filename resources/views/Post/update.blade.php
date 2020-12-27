@extends('layouts.app')

@section('content')
<div class="row">	
	<div class="col-md-12">
        <div class="card">
         	<div class="card-body">
				<h5>Update Post <a href="{{ url('listofpost') }}" class="btn btn-sm btn-info" style="float: right;">Back</a></h5>
				<form method="post" action="{{ url('postupdate',$post->id) }}"  enctype="multipart/form-data">
					@csrf
					<div class="row">

						<div class="col-md-3 form-group">
							<label>Select Tag</label>
							<select name="tag_id" class="form-control form-control-sm">
								@if (isset($tags))
	                  				@foreach ($tags as $row)
	                  					<option value="{{ $row->id }}" {!! $post->tag_id == $row->id ? "selected='selected'" : "" !!} >{{  $row->tag_name }}</option>
				                  	@endforeach
				                @endif
							</select>
	                        @if($errors->has('tag_id')) 
	                            <span class="alertcss">{{ $errors->first('tag_id') }} </span>
	                        @endif
						</div>

						<div class="col-md-3 form-group">
							<label>Title</label>
							<input type="text" name="title" class="form-control form-control-sm" value="{{ $post->title }}">
                              @if($errors->has('title')) 
                                  <span class="alertcss">{{ $errors->first('title') }} </span>
                              @endif
						</div>

						<div class="col-md-3 form-group">
							<label>Slug</label>
							<input type="text" name="slug" class="form-control form-control-sm" value="{{ $post->slug }}">
                              @if($errors->has('slug')) 
                                  <span class="alertcss">{{ $errors->first('slug') }} </span>
                              @endif
						</div>

						<div class="col-md-3 form-group">
							<label>featured Image</label>
							<input type="file" name="featured_image" class="form-control form-control-sm">
                              @if($errors->has('featured_image')) 
                                  <span class="alertcss">{{ $errors->first('featured_image') }} </span>
                              @endif
						</div>

						<div class="col-md-9 form-group">
							<label>Descrription</label>
							<textarea name="description" class="form-control form-control-sm">{{ $post->description }}</textarea>
							@if($errors->has('description')) 
								<span class="alertcss">{{ $errors->first('description') }} </span>
							@endif
						</div>

						<div class="col-md-3 form-group">
							<label>Thumbnail Image</label><br>
							<img src="{{ $thumbnail }}" height="60px;" />
						</div>

						<div class="col-md-12">
							<input type="submit" name="save" value="Update" class="btn btn-sm btn-primary" >
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection