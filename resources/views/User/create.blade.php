@extends('layouts.app')

@section('content')
	<div class="row">	
		<div class="col-md-12">
	        <div class="card">
	         	<div class="card-body">
					<h5>Add Users</h5>
					<form method="post" action="{{ url('storeuser') }}">
						@csrf
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}">
	                              @if($errors->has('name')) 
	                                  <span class="alertcss">{{ $errors->first('name') }} </span>
	                              @endif
							</div>
							<div class="col-md-4 form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}">
	                              @if($errors->has('email')) 
	                                  <span class="alertcss">{{ $errors->first('email') }} </span>
	                              @endif	
							</div>
							<div class="col-md-4 form-group">
								<label>Role</label>
								<select name="role" class="form-control form-control-sm">
									<option value="Reader" {{ 'Reader' == old('role') ? 'selected' : ''}}>Reader</option>
									<option value="Editor" {{ 'Editor' == old('role') ? 'selected' : ''}}>Editor</option>
									<option value="Super Admin" {{ 'Super Admin' == old('role') ? 'selected' : ''}}>Super Admin</option>
								</select>
	                              @if($errors->has('role')) 
	                                  <span class="alertcss">{{ $errors->first('role') }} </span>
	                              @endif
							</div>
							<div class="col-md-6 form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control form-control-sm" value="{{ old('password') }}">
	                              @if($errors->has('password')) 
	                                  <span class="alertcss">{{ $errors->first('password') }} </span>
	                              @endif
							</div>
							<div class="col-md-6 form-group">
								<label>Confirm Password</label>
								<input type="password" name="confrim_password" class="form-control form-control-sm" value="{{ old('confrim_password') }}">
	                              @if($errors->has('confrim_password')) 
	                                  <span class="alertcss">{{ $errors->first('confrim_password') }} </span>
	                              @endif	
							</div>
							<div class="col-md-12">
								<p>Manage Permission</p>
				                  <table class="table table-bordered table-striped">
				                    <tbody>
				                        <tr>
				                          <td class=""><strong>Module Name</strong></td>
				                          <td class="text-center">
				                            <strong>View</strong> 
				                            <br><input type="checkbox" value="1" class="all_view" onchange="all_view(1)">
				                          </td>
				                          <td class="text-center"> 
				                            <strong>Add</strong> 
				                            <br> <input type="checkbox" value="1" class="all_add" onchange="all_add(1)">
				                          </td>
				                          <td class="text-center">
				                            <strong>Edit</strong> 
				                            <br><input type="checkbox" value="1" class="all_edit" onchange="all_edit(1)">
				                          </td>
				                          <td class="text-center">
				                            <strong>Delete</strong>
				                            <br> <input type="checkbox" value="1" class="all_delete" onchange="all_delete(1)">
				                          </td>
				                          <td class="text-center">
				                            <strong>No Permission</strong>
				                            <br><input type="checkbox" value="1" class="all_no_access" onchange="all_no_access(1)">
				                          </td>
				                        </tr>                  
				                        <?php
				                          if($modules){
				                            foreach ($modules as $page) {
				                        ?>
				                              <tr>
				                                <td>
				                                    <?=ucfirst($page->module_name);?> 
				                                    <input type="hidden" name="page_id[]" value="<?=$page->id;?>">
				                                </td>

				                                <td class="text-center">
				                                  <input type="checkbox" name="view_access[<?=$page->id;?>]" value="1"  id="view_access<?=$page->id;?>" onchange="uncheckno(<?=$page->id;?>)" class="view1"> 
				                                </td>
				                                 
				                                <td class="text-center">
				                                  <input type="checkbox" name="add_access[<?=$page->id;?>]" value="1"  id="add_access<?=$page->id;?>" onchange="uncheckno(<?=$page->id;?>)" class="add1"> 
				                                </td>
				                                 
				                                <td class="text-center">
				                                  <input type="checkbox" name="edit_access[<?=$page->id;?>]" value="1"  id="edit_access<?=$page->id;?>" onchange="uncheckno(<?=$page->id;?>)" class="edit1"> 
				                                </td>
				                                 
				                                <td class="text-center">
				                                  <input type="checkbox" name="delete_access[<?=$page->id;?>]" value="1"  id="delete_access<?=$page->id;?>" onchange="uncheckno(<?=$page->id;?>)" class="delete1"> 
				                                </td>
				                                 
				                                <td class="text-center">
				                                  <input type="checkbox" name="no_access[<?=$page->id;?>]" value="1" id="no_access<?=$page->id;?>" onchange="uncheckall(<?=$page->id;?>)" class="denied1"> 
				                                </td>
				                                 
				                             </tr> 
				                        <?php
				                            }
				                          }
				                        ?>
				                     </tbody>
				                </table>
				                <script type="text/javascript">
							      function uncheckno(id) {
							        $('#no_access'+id).prop( "checked", false );
							      }

							      function uncheckall(id) {
							        if($("#no_access"+id).is(':checked')) {
							           $('#view_access'+id).prop( "checked", false );
							           $('#add_access'+id).prop( "checked", false );
							           $('#edit_access'+id).prop( "checked", false );
							           $('#delete_access'+id).prop( "checked", false );
							        }
							        else{
							           $('#view_access'+id).prop( "checked", true );
							           $('#add_access'+id).prop( "checked", true );
							           $('#edit_access'+id).prop( "checked", true );
							           $('#delete_access'+id).prop( "checked", true );          
							        }
							      }

							      function all_view() {
							        if($(".all_view").is(':checked')) {
							           $('.view1').prop( "checked", true );
							        }
							        else{
							           $('.view1').prop( "checked", false );         
							        }
							      }


							      function all_add() {
							        if($(".all_add").is(':checked')) {
							           $('.add1').prop( "checked", true );
							        }
							        else{
							           $('.add1').prop( "checked", false );         
							        }
							      }


							      function all_edit() {
							        if($(".all_edit").is(':checked')) {
							           $('.edit1').prop( "checked", true );
							        }
							        else{
							           $('.edit1').prop( "checked", false );         
							        }
							      }


							      function all_delete() {
							        if($(".all_delete").is(':checked')) {
							           $('.delete1').prop( "checked", true );
							        }
							        else{
							           $('.delete1').prop( "checked", false );         
							        }
							      }


							      function all_no_access() {
							        if($(".all_no_access").is(':checked')) {
							           $('.denied1').prop( "checked", true );
							        }
							        else{
							           $('.denied1').prop( "checked", false );         
							        }
							      }
							   </script>
							</div>
							<div class="col-md-12" style="text-align: center;">
								<input type="submit" name="save" value="Save" class="btn btn-success">
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection