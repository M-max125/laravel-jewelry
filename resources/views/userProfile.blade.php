@extends('layouts.app')

@section('title','My account')

@section('content')

@if(session()->has('success_message'))
        <p class="alert alert-success">
        {{session()->get('success_message')}}
        </p>
        @endif

        @if(count($errors)>0)
        <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
        </div>
        @endif

<div class="container" style="padding-top: 60px;">
  
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="container">
      @if($user->avatar)
      <img src="{{asset('/storage/images/avatar/'.$user->avatar)}}" class="img-fluid img-thumbnail mb-2" alt="user_avatar">
      @else
      <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-thumbnail mb-2" alt="avatar">
      @endif
      
        
        <form action="{{route('profile.upload')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
          <input type="file" name="avatar">
          <input type="submit" value="Upload" class="btn btn-outline-primary mt-2">
          </div>
        </form>
      </div>
    
        <div class="text-center">
      
            <div class="vertical-menu ml-3">
            
                <a href="{{route('profile.edit')}}">My profile</a>
                <a href="{{route('orders.index')}}">My orders</a>
            
            </div>

        </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fas fa-user-edit"></i>
        Edit your profile for a more friendly user experience 🥰
      </div>
      <h3>Personal info</h3>
      <form class="form-horizontal"  action="{{route('profile.update')}}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
          <label class="col-lg-3 control-label">Name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="{{old('name',$user->name)}}" type="text" name="name" id="name" required>
          </div>
        </div>
        
        
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="{{old('email',$user->email)}}" type="email" name="email" id="email" required>
          </div>
        </div>
       
       
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password" id="password">
          </div>
          <div class="col-md-8">Leave password blank to keep current password</div>
        </div>
        
        <div class="form-group">
          <label class="col-md-3 control-label">Confirm password:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password_confirmation" id="password_confirmation">
          </div>
        </div>
        
        
        
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <button class="btn btn-outline-primary"  type="submit">Update profile</button>
            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection