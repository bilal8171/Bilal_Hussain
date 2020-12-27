<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Tag;
use App\Helpers\Helper;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(Helper::has_permission(3,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Tags';
        $us2 = new Tag;
        $tags=$us2::get();
        return view('Tag/index',compact('title','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Helper::has_permission(3,'create_m')==false){
            return redirect('permission_error');
        }
        $title='Tags';
        return view('Tag/create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Helper::has_permission(3,'create_m')==false){
            return redirect('permission_error');
        }
        $validator = Validator::make($request->all(), [
            'tag_name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('addtag')
            ->withErrors($validator)
            ->withInput();
        }
        $us=new Tag;   
        $us->tag_name=request('tag_name');  
        $us->save();
        $id=$us->id;

        \Session::flash('success','Created successfully');
        return redirect('tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Helper::has_permission(3,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Tags';
        $us2 = new Tag;
        $tag=$us2::where('id','=',$id)->get()->first();
        return view('Tag/read',compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Helper::has_permission(3,'update_m')==false){
            return redirect('permission_error');
        }
        $title='Tags';
        $us2 = new Tag;
        $tag=$us2::where('id','=',$id)->get()->first();
        return view('Tag/update',compact('title','tag'));
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
        if(Helper::has_permission(3,'update_m')==false){
            return redirect('permission_error');
        }

        $validator = Validator::make($request->all(), [
            'tag_name' => 'required',
            'tag_status' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect('edittag',$id)
            ->withErrors($validator)
            ->withInput();
        }

        $us2=Tag::find($id);   
        $us2->tag_name=request('tag_name');  
        $us2->tag_status=request('tag_status');  
        $us2->save();

        \Session::flash('success','Update successfully');
        return redirect('tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Helper::has_permission(3,'delete_m')==false){
            return redirect('permission_error');
        }
        Tag::find($id)->delete();
        Tag::withTrashed()->get();
        \Session::flash('success','Record Deleted successfully');
        return redirect('tag');
    }
}
