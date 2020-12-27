<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;
use App\Post;
use App\Tag;
use App\User;
use Image;
use Auth;
use Storage;
class PostsController extends Controller
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
        if(Helper::has_permission(1,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Posts';
        $post = new Post;
        $posts=$post::get();
        return view('Post/index', compact('title','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Helper::has_permission(1,'create_m')==false){
            return redirect('permission_error');
        }
        $title='Add Post';
        $us1 = new Tag;
        $tags=$us1::get();
        $thumbnail=Storage::url('featured_image/thumbnail/');
        return view('Post/create', compact('title','tags','thumbnail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Helper::has_permission(1,'create_m')==false){
            return redirect('permission_error');
        }        

        $validator = Validator::make($request->all(), [
            'tag_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required|min:8',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($validator->fails()) {
            return redirect('addpost')
            ->withErrors($validator)
            ->withInput();
        }
        $featured_image='';
        if($request->hasFile('featured_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('featured_image')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('featured_image')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //small thumbnail name
            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;

            //Upload File
            $request->file('featured_image')->storeAs('public/featured_image', $filenametostore);
            $request->file('featured_image')->storeAs('public/featured_image/thumbnail', $smallthumbnail); 
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/featured_image/thumbnail/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 150);
            $featured_imag=$smallthumbnail;
           
        }          

        $pst=new Post;   
        $pst->users_id=Auth::user()->id; 
        $pst->tag_id=request('tag_id'); 
        $pst->title=request('title');  
        $pst->slug=request('slug'); 
        $pst->description=request('description');  
        $pst->featured_image=$featured_imag;   
        $pst->save();
        $id=$pst->id;
        \Session::flash('success','Post data saved successfully');
        return redirect('listofpost');
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Helper::has_permission(1,'read_m')==false){
            return redirect('permission_error');
        }
        $title='Read Post';
        $pst = new Post;
        $post=$pst::where('id','=',$id)->get()->first();
        $us1 = new Tag;
        $tag=$us1::where('id','=',$post->tag_id)->get()->first();
        $us = new User;
        $created_by=$us::where('id','=',$post->users_id)->get()->first();
        $thumbnail=Storage::url('featured_image/thumbnail/'.$post->featured_image);
        return view('Post/read', compact('title','post','tag','thumbnail','created_by'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Helper::has_permission(1,'update_m')==false){
            return redirect('permission_error');
        }
        $title='Edit Post';
        $pst = new Post;
        $post=$pst::where('id','=',$id)->get()->first();
        $us1 = new Tag;
        $tags=$us1::get();
        $thumbnail=Storage::url('featured_image/thumbnail/'.$post->featured_image);
        return view('Post/update', compact('title','post','tags','thumbnail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Helper::has_permission(1,'update_m')==false){
            return redirect('permission_error');
        }

        $validator = Validator::make($request->all(), [
            'tag_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required|min:8',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($validator->fails()) {
            return redirect('editpost',$id)
            ->withErrors($validator)
            ->withInput();
        }
        $featured_image='';
        if($request->hasFile('featured_image')) {
            //get filename with extension
            $filenamewithextension = $request->file('featured_image')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('featured_image')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //small thumbnail name
            $smallthumbnail = $filename.'_small_'.time().'.'.$extension;

            //Upload File
            $request->file('featured_image')->storeAs('public/featured_image', $filenametostore);
            $request->file('featured_image')->storeAs('public/featured_image/thumbnail', $smallthumbnail); 
            //create small thumbnail
            $smallthumbnailpath = public_path('storage/featured_image/thumbnail/'.$smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 150);
            $featured_imag=$smallthumbnail;
           
        }          
   
        $pst=Post::find($id);   
        $pst->tag_id=request('tag_id'); 
        $pst->title=request('title');  
        $pst->slug=request('slug'); 
        $pst->description=request('description');  
        $pst->featured_image=$featured_imag;   
        $pst->save();
        \Session::flash('success','data updated successfully');
        return redirect('listofpost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Helper::has_permission(1,'delete_m')==false){
            return redirect('permission_error');
        }
        Post::find($id)->delete();
        Post::withTrashed()->get();
        \Session::flash('success','Record Deleted successfully');
        return redirect('listofpost');
    }


    
}
