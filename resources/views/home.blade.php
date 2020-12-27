@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <h3>Welcome to <a style="color: green;text-decoration: underline;">{{ Auth::user()->name }}</a></h3>
    </div>
    <style type="text/css">
        .shadowbox{
            text-align: center; border: 1px solid; margin: 10px; border-radius: 10px;box-shadow: 3px 15px 14px -11px #bdbcbc;
        }
    </style>
    @if (Auth::user()->role=='Super Admin')
        <div class="col-md-3 shadowbox">
            {{ $users }}
            <br>
            Users
        </div>
        <div class="col-md-3 shadowbox">
            {{ $tags }}
            <br>
            Tags
        </div>
        <div class="col-md-3 shadowbox">
            {{ $posts }}
            <br>
            Posts
        </div>
    @endif
</div>
@endsection
