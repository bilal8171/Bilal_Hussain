@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="col-md-12">
	        <div class="card">
	         	<div class="card-body">
					<h5>Profile</h5>
					<form method="POST" enctype="multipart/form-data" action="{{ url('profileupdate',$user->id) }}">
						@csrf
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control form-control-sm" value="{{ $user->name }}">
							</div>
							<div class="col-md-4 form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}">	
							</div>
							<div class="col-md-4 form-group">
								<label>Role</label>
								<select class="form-control form-control-sm" readonly="readonly">
									<option value="Reader" {{ 'Reader' == $user->role ? 'selected' : ''}}>Reader</option>
									<option value="Editor" {{ 'Editor' == $user->role ? 'selected' : ''}}>Editor</option>
									<option value="Super Admin" {{ 'Super Admin' == $user->role ? 'selected' : ''}}>Super Admin</option>
								</select>
							</div>

							<div class="col-md-12" style="text-align: center;">
								<input type="submit" name="update" value="Save" class="btn btn-success">
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection