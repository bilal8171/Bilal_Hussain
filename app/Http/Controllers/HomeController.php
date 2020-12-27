<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Post;
use App\Tag;
use App\Module;
use App\Permission;
use Auth;
use App\Helpers\Helper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role=='Super Admin'){
            $getpermissions=DB::table('modules')->get();
            foreach ($getpermissions as $per) {
                $getpermission=DB::table('permission')->where('modules_id',$per->id)->where('users_id',Auth::user()->id)->first();
                if(!$getpermission){        
                    $sm = new Permission;
                    $sm->modules_id =$per->id;
                    $sm->no_permission=0;
                    $sm->create_m=1;
                    $sm->update_m=1;
                    $sm->delete_m=1;
                    $sm->read_m=1;
                    $sm->users_id=Auth::user()->id;
                    $sm->save();                
                }
            }
        }
        $title='Dashboard';
        $us = new User;
        $users=count($us::get());
        $us1 = new Tag;
        $tags=count($us1::get());
        $us2 = new Post;
        $posts=count($us2::get());
        return view('home', compact('title','users','tags','posts'));
        // return view('home');
    }

    public function listofusers()
    {   
        if(Helper::has_permission(2,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Users';
        $us = new User;
        $users=$us::where('id','!=',Auth::user()->id)->get();
        return view('User/index',compact('title','users'));
    }



    public function create()
    {
        if(Helper::has_permission(2,'create_m')==false){
            return redirect('permission_error');
        }
        $title='Add';
        $m=new Module;
        $modules=$m::get();
        return view('User/create',compact('title','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Helper::has_permission(2,'create_m')==false){
            return redirect('permission_error');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'confrim_password' => 'required|password|min:8'
        ]);
        
        if ($validator->fails()) {
            return redirect('adduser')
            ->withErrors($validator)
            ->withInput();
        }

        $us=new User;   
        $us->name=request('name');  
        $us->email=request('email');  
        $us->role=request('role');  
        $us->password=Hash::make(request('password')); 
        $us->save();
        $id=$us->id;

        $add_access=request('add_access');
        $edit_access=request('edit_access');
        $delete_access=request('delete_access');
        $view_access=request('view_access');
        $no_access=request('no_access');
        $page_id=request('page_id');
        if($page_id){
            foreach($page_id as $page_id=>$page_val) {
                if(isset($no_access[$page_val]) && $no_access[$page_val]==1){
                    $no_access1=1;
                }
                else{
                    $no_access1=0;
                }

                if(isset($add_access[$page_val]) && $add_access[$page_val]=='1'){
                    $add_access1=1;
                }
                else{
                    $add_access1=0;
                }
                if(isset($edit_access[$page_val]) && $edit_access[$page_val]=='1'){
                    $edit_access1=1;
                }
                else{
                    $edit_access1=0;
                }
                if(isset($delete_access[$page_val]) && $delete_access[$page_val]=='1'){
                    $delete_access1=1;
                }
                else{
                    $delete_access1=0;
                }
                if(isset($view_access[$page_val]) && $view_access[$page_val]=='1'){
                    $view_access1=1;
                }
                else{
                    $view_access1=0;
                }    

                $sm = new Permission;
                $sm->modules_id =$page_val;
                $sm->no_permission=$no_access1;
                $sm->create_m=$add_access1;
                $sm->update_m= $edit_access1;
                $sm->delete_m=$delete_access1;
                $sm->read_m=$view_access1;
                $sm->users_id=$id;
                $sm->save();  
            }    
        }     

        \Session::flash('success','Save successfully');
        return redirect('listofusers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Helper::has_permission(2,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Read';
        $us = new User;
        $user=$us::where('id','=',$id)->get()->first();
        $m=new Module;
        $modules=$m::get();
        return view('User/read',compact('title','modules','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Helper::has_permission(2,'update_m')==false){
            return redirect('permission_error');
        }
        $title='Add';
        $us = new User;
        $user=$us::where('id','=',$id)->get()->first();
        $m=new Module;
        $modules=$m::get();
        return view('User/update',compact('title','modules','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        if(Helper::has_permission(2,'update_m')==false){
            return redirect('permission_error');
        }
        $add_access=request('add_access');
        $edit_access=request('edit_access');
        $delete_access=request('delete_access');
        $view_access=request('view_access');
        $no_access=request('no_access');
        $page_id=request('page_id');
        if($page_id){
            foreach($page_id as $page_id=>$page_val) {
                if(isset($no_access[$page_val]) && $no_access[$page_val]==1){
                    $no_access1=1;
                }
                else{
                    $no_access1=0;
                }

                if(isset($add_access[$page_val]) && $add_access[$page_val]=='1'){
                    $add_access1=1;
                }
                else{
                    $add_access1=0;
                }
                if(isset($edit_access[$page_val]) && $edit_access[$page_val]=='1'){
                    $edit_access1=1;
                }
                else{
                    $edit_access1=0;
                }
                if(isset($delete_access[$page_val]) && $delete_access[$page_val]=='1'){
                    $delete_access1=1;
                }
                else{
                    $delete_access1=0;
                }
                if(isset($view_access[$page_val]) && $view_access[$page_val]=='1'){
                    $view_access1=1;
                }
                else{
                    $view_access1=0;
                }
                $getpermission=DB::table('permission')->where('modules_id',$page_val)->where('users_id',$id)->first();
                if($getpermission){  
                    $per=Permission::find($getpermission->id);   
                    $per->no_permission=$no_access1; 
                    $per->create_m=$add_access1; 
                    $per->update_m=$edit_access1; 
                    $per->delete_m=$delete_access1; 
                    $per->read_m=$view_access1;
                    $per->save();
                }
                else{       
                    $sm = new Permission;
                    $sm->modules_id =$page_val;
                    $sm->no_permission=$no_access1;
                    $sm->create_m=$add_access1;
                    $sm->update_m= $edit_access1;
                    $sm->delete_m=$delete_access1;
                    $sm->read_m=$view_access1;
                    $sm->users_id=$id;
                    $sm->save();                
                }
            }    
        }     
        $us=User::find($id);   
        $us->name=request('name');  
        $us->email=request('email');  
        $us->role=request('role'); 
        $us->save();

        \Session::flash('success','Update successfully');
        return redirect('listofusers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Helper::has_permission(2,'delete_m')==false){
            return redirect('permission_error');
        }
        
        User::find($id)->delete();
        User::withTrashed()->get();
        \Session::flash('success','Record Deleted successfully');
        return redirect('listofusers');
    }


    public function profile($id)
    { 
        if(Helper::has_permission(4,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Profile';
        $us = new User;
        $user=$us::where('id','=',$id)->get()->first();
        return view('User/profile',compact('title','user'));
    }

    public function profileupdate(Request $request,$id)
    {
        if(Helper::has_permission(4,'update_m')==false){
            return redirect('permission_error');
        }
        $us=User::find($id);   
        $us->name=request('name');  
        $us->email=request('email');  
        $us->save();
        \Session::flash('success','Update successfully');
        return redirect('profile/'.$id);
    }


    public function errorpage()
    {        
        return view('errorpage');
    }
}
