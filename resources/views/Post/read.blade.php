@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>View Post <a href="{{ url('listofpost') }}" class="btn btn-sm btn-info" style="float: right;">Back</a></h3>
		<table class="table table-sm">
			<tbody>
				<tr>
					<th>Title</th>
					<td>{{ $post->title }}</td>
					<th>Tag</th>
					<td>{{ $tag->tag_name }}</td>
				</tr>
				<tr>
					<th>Slug</th>
					<td>{{ $post->slug }}</td>
					<th>Thumbnail Image</th>
					<td><img src="{{ $thumbnail }}" /></td>
				</tr>
				<tr>
					<th>Description</th>
					<td colspan="3">{{ $post->description }}</td>
				</tr>
				<tr>
					<th>Created By and Role:</th>
					<td>{{ $created_by->name }} ({{ $created_by->role }})</td>
					<th>Post Date & Time</th>
					<td>{{ App\Helpers\Helper::changedateformte($post->created_at,'d-m-Y h:i a') }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection