<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Str;
use Auth;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\DB;
use Storage;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function changedateformte(string $string, string $formate)
    {
        return date($formate,strtotime($string));
    }

	public static function has_permission($module_id,$accesstype) {
        $us = new Permission;
        $per=$us::where('users_id','=',Auth::user()->id)->where('modules_id','=',$module_id)->where($accesstype,'=',1)->get()->first();
	    if(!empty($per)) {
	        return true;
	    }
	    else{
	        return false;
	    }
	}

    public static function geturlimage($path)
    {
        return $thumbnail=Storage::url($path);
    }
}