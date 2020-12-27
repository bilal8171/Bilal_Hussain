@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="col-md-12">
	        <div class="card">
	          <div class="card-body">
				<h5>List of Posts <a href="{{ url('addpost') }}" class="btn btn-sm btn-info" style="float: right;">Add Post</a></h5>
	            <table class="table table-sm">
	              <thead>
	                <tr>
	                  <th> title </th>
	                  <th> slug </th>
	                  <th> thumbnail </th>
	                  <th> Action </th>
	                </tr>
	              </thead>
	              <tbody>
	                @if (isset($posts))
	                  @foreach ($posts as $row)
	                      <tr>
	                          <td>{{ $row->title }}</td>
	                          <td>{{ $row->slug }}</td>
	                          <td>
	                          	<img src="{{ App\Helpers\Helper::geturlimage('featured_image/thumbnail/'.$row->featured_image) }}" height="50px" />
	                          </td>
	                          <td>      
                        		  @if (App\Helpers\Helper::has_permission(1,'read_m')==true)   
	                              <a class="btn btn-info" 
	                                href="{{ url('showpost',$row->id) }}">
	                                View
	                              </a>  
	                              @endif       

                        		  @if (App\Helpers\Helper::has_permission(1,'update_m')==true)
	                              <a class="btn btn-primary" 
	                                href="{{ url('editpost',$row->id) }}">
	                                Edit
	                              </a> 
	                              @endif         

                        		  @if (App\Helpers\Helper::has_permission(1,'delete_m')==true)
	                              <a class="btn btn-danger" 
	                                href="{{ url('destroypost',$row->id) }}">
	                                Delete
	                              </a>   
	                              @endif
	                          </td>
	                      </tr>
	                  @endforeach
	                @endif
	              </tbody>
	            </table>
	          </div>
	        </div>
	    </div>
	</div>
@endsection