@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="col-md-12">
	        <div class="card">
	          <div class="card-body">
				<h5>List of Users</h5>
	            <table class="table table-sm">
	              <thead>
	                <tr>
	                  <th> Name </th>
	                  <th> Email </th>
	                  <th> Role </th>
	                  <th> Action </th>
	                </tr>
	              </thead>
	              <tbody>
	                @if (isset($users))
	                  @foreach ($users as $row)
	                      <tr>
	                          <td>{{ $row->name }}</td>
	                          <td>{{ $row->email }}</td>
	                          <td>    
	                          	{{ $row->role }}
	                          </td>
	                          <td>          
                        		  @if (App\Helpers\Helper::has_permission(2,'update_m')==true)                                                 
	                              <a class="btn btn-info" 
	                                href="{{ url('showuser',$row->id) }}" style="display: none;">
	                                View
	                              </a>  
	                              @endif      

                        		  @if (App\Helpers\Helper::has_permission(2,'update_m')==true)
	                              <a class="btn btn-primary" 
	                                href="{{ url('edituser',$row->id) }}">
	                                Edit
	                              </a>
	                              @endif

                        		  @if (App\Helpers\Helper::has_permission(2,'delete_m')==true)
	                              <a class="btn btn-danger" 
	                                href="{{ url('destroyuser',$row->id) }}">
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