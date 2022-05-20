@extends('front.app')

@section('content')

@include('front.partials.account-tabs')


<div class="personal-data">
   <div class="container">
       <form  action="{{ route('edit.account') }}" method="post" enctype="multipart/form-data">
           <div class="col-md-3 photo">
               <img class="preview" src="{{ asset('images/noavatar.png') }}">
               <div class="upload-btn-wrapper">
                  <button class="btn">Upload Image</button>
                  <input type="file" name="file" onchange="previewFile()"/>
                </div>
           </div>
           <div class="col-md-5 data">
               <div class="row">
                   <div class="col-md-4 label name">
                       First name
                   </div>
                   <div class="col-md-5 value">
                       <span class="entry">{{ Auth::user()->first_name }}</span>
                       <input class="input" type="text" name="name" value="{{ Auth::user()->first_name }}">
                       @if ($errors->has('name'))
                           <small class="alert">{{ $errors->first('name') }}</small>
                       @endif
                   </div>
                   <div class="col-md-3 edit">
                       <span class="change-account-data">Edit</span>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4 label name">
                       Last name
                   </div>
                   <div class="col-md-5 value">
                       <span class="entry">{{ Auth::user()->second_name }}</span>
                       <input class="input" type="text" name="sname" value="{{ Auth::user()->second_name }}">
                       @if ($errors->has('sname'))
                           <small class="alert">{{ $errors->first('sname') }}</small>
                       @endif
                   </div>
                   <div class="col-md-3 edit">
                       <span class="change-account-data">Edit</span>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4 label email">
                       E-mail
                   </div>
                   <div class="col-md-5 value">
                       <span class="entry">{{ Auth::user()->email }}</span>
                       <input class="input" type="text" name="email" value="{{ Auth::user()->email }}">
                       @if ($errors->has('email'))
                           <small class="alert">{{ $errors->first('email') }}</small>
                       @endif
                   </div>
                   <div class="col-md-3 edit">
                       <span class="change-account-data">Edit</span>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4 label phone">
                       Phone
                   </div>
                   <div class="col-md-5 value">
                       <span class="entry">{{ Auth::user()->phone }}</span>
                       <input class="input" type="text" name="phone" value="{{ Auth::user()->phone }}">
                       @if ($errors->has('phone'))
                           <small class="alert">{{ $errors->first('phone') }}</small>
                       @endif
                   </div>
                   <div class="col-md-3 edit">
                       <span class="change-account-data">Edit</span>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4 label password">
                       Password
                   </div>
                   <div class="col-md-5 value">
                      <input type="password" name="password" value="">
                      @if ($errors->has('password'))
                          <small class="alert">{{ $errors->first('password') }}</small>
                      @endif
                   </div>
                   <div class="col-md-3 edit"></div>
               </div>
               <div class="row">
                   <div class="col-md-4 label password">
                       Repeat Password
                   </div>
                   <div class="col-md-5 value">
                       <input type="text" name="passwordAgain" value="">
                       @if ($errors->has('passwordAgain'))
                           <small class="alert">{{ $errors->first('passwordAgain') }}</small>
                       @endif
                   </div>
                   <div class="col-md-3 edit">
                       <span class="change-account-data">Edit</span>
                   </div>
               </div>
               <div class="row">
                   <input type="submit" value="Save">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
               </div>
           </div>
       </form>
       <div class="col-md-4 demo-data">
           <div class="inside">
               <img src="{{ asset('images/noavatar.png') }}">
               <div class="row item">
                   <div class="col-md-5"><b>Name:</b></div>
                   <div class="col-md-7">{{ Auth::user()->name }}</div>
               </div>
               <div class="row item">
                   <div class="col-md-5"><b>E-mail:</b></div>
                   <div class="col-md-7">{{ Auth::user()->email }}</div>
               </div>
               <div class="row item">
                   <div class="col-md-5"><b>Phone:</b></div>
                   <div class="col-md-7">{{ Auth::user()->phone }}</div>
               </div>
           </div>
       </div>
   </div>
</div>


@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
