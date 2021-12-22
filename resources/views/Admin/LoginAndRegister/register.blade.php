	@extends('Layout.Admin.default')
	@section('content')
	
	
	<div  class="main-view login-u">
		@if(session('message'))
			<div class="alert alert-danger">
				<p>{{session('message')}}</p>
			</div>
		@endif
	    @if($errors->any())
			<ul>
				@foreach($errors->all() as $error)
				<li class="text-danger">{{$error}}</li>
				@endforeach
			</ul>
		@endif
	            <div class="reg_wrapper">
	        <div class="x_panel">
	            <div class="x_title">
	                <h2>Register </h2>
	                <div class="clearfix"></div>
	            </div>
	            <div class="x_content">
	                <form autocomplete="true" class="form-horizontal form-label-left input_mask " method="post" novalidate>
	                	<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
	                        <input type="text" class="form-control has-feedback-left" name="name" placeholder="Name"  value="{{old('name')}}" required>
	                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
	                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
	                    </div>
	                    <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
	                        <input type="email" class="form-control has-feedback-left" name="email" placeholder="Email"  value="{{old('email')}}" required>
	                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
	                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
	                    </div>
	                    <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback password-div">
	                        <input type="password" class="form-control has-feedback-left " name="password" placeholder="Password"  required="">
	                        <a href="javascript:;" class="pass-s-h"><i class="fa fa-eye"></i></a>
	                        <span class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
	                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
	                    </div>
	                    <div class="col-md-12 col-sm-6 col-xs-12 form-group">
	                        <div class="row">
	                            <div class="col-md-6 col-sm-6 col-xs-6 ">
	                            	<a href="{{ url('login') }}" class="btn btn-primary pull-left">Login</a>
	                            </div>
	                            <div class="col-md-6 col-sm-6 col-xs-6">
	                            	@csrf
	                                <button type="submit" name="register" class="btn btn-success pull-right">Register</button>
	                            </div>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div><!-- jQuery -->
	
	@endsection