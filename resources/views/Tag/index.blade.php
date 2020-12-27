@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="col-md-12">
	        <div class="card">
	          <div class="card-body">
				<h5>List of Tags</h5>
	            <table class="table table-sm">
	              <thead>
	                <tr>
	                  <th> Name </th>
	                  <th> Statu </th>
	                  <th> Action </th>
	                </tr>
	              </thead>
	              <tbody>
	                @if (isset($tags))
	                  @foreach ($tags as $row)
	                      <tr>
	                          <td>{{ $row->tag_name }}</td>
	                          <td>    
	                          	@if($row->tag_status==1)
	                          		Active
	                          	@else
	                          		Deactive
	                          	@endif
	                          </td>
	                          <td>        
                        		  @if (App\Helpers\Helper::has_permission(3,'read_m')==true)  
	                              <a class="btn btn-info" 
	                                href="{{ url('showtag',$row->id) }}" style="display: none;">
	                                View
	                              </a>    
	                              @endif     

                        		  @if (App\Helpers\Helper::has_permission(3,'update_m')==true)
	                              <a class="btn btn-primary" 
	                                href="{{ url('edittag',$row->id) }}">
	                                Edit
	                              </a> 
	                              @endif         

                        		  @if (App\Helpers\Helper::has_permission(3,'delete_m')==true)
	                              <a class="btn btn-danger" 
	                                href="{{ url('destroytag',$row->id) }}">
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