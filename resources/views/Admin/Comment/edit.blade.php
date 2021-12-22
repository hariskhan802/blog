	@extends('Layout.Admin.default')
	@section('title', 'Home')
	@section('content')
	
	

	<div class="main-view">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	    @if(session('message'))
	        <div class="alert alert-success col-sm-8 col-sm-offset-2">
	            <h2>{{ session('message') }}</h2>
	        </div>
	    @endif
	    
	    <div class="x_panel cus-form">
	        <div class="x_title">
	            <h2>Post</h2>
	            <a href="{{  url('admin/posts') }}" class="btn btn-primary" style="margin-left: 4%;">View Posts</a>
	            <ul class="nav navbar-right panel_toolbox">
	            </ul>
	            <div class="clearfix"></div>
	        </div>
	        <div class="x_content" >
	            <br>

	            <form method="post" class="form-horizontal form-label-left "  enctype="multipart/form-data" id="add-form" autocomplete="off" kv_submit="true" novalidate>
	                <div class="row">
	                    
	                    <div class="col-md-6 margin-bottom ">
	                        <div class="form-group">
	                            <label class="control-label col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                Name 
	                                <span class="required">*</span>
	                            </label>
	                            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                <input type="text"  class="form-control" name="title"  placeholder="Title" value="{{ $post->title }}" required>
	                            </div>
	                            @error('title')
	                            <div class="erorr text-danger">
	                            	<span>{{ $message }}</span>
	                            </div>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="col-md-6 margin-bottom ">
	                        <div class="form-group">
	                            <label class="control-label col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                Image 
	                                <span class="required">*</span>
	                            </label>
	                            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                <input type="file"  name="image" required>
	                                <img src="{{ asset('assets/images/post/'.$post->image) }}" width="100">
	                            </div>
	                            @error('image')
	                            <div class="erorr text-danger">
	                            	<span>{{ $message }}</span>
	                            </div>
	                            @endif
	                        </div>
	                    </div>
	                    
	                </div>
	                <div class="row">
	                    
	                    <div class="col-md-6 margin-bottom ">
	                        <div class="form-group">
	                            <label class="control-label col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                Category 
	                                <span class="required">*</span>
	                            </label>
	                            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                <select name="cat_id" class="form-control">
										<option value="">Select Category</option>
										@foreach($cats as $cat)
											<option value="{{$cat->id}}" {{ $post->cat_id == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
										@endforeach
									</select>
	                            </div>
	                            @error('cat_id')
	                            <div class="erorr text-danger">
	                            	<span>{{ $message }}</span>
	                            </div>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label class="control-label col-md-12 col-sm-12 col-xs-12 margin-bottom ">
	                                Description
	                                <span class="required">*</span>
	                            </label>
	                            <div class="col-md-12 col-sm-12 col-xs-12 password-div margin-bottom ">
	                            	
	                            	<textarea class="form-control" name="description"  placeholder="Description" rows="6">{{ $post->description }}</textarea>
	                            </div>
	                            @error('description')
	                            <div class="erorr text-danger">
	                            	<span>{{ $message }}</span>
	                            </div>
	                            @endif
	                        </div>
	                    </div>
	                </div>
	                	
	                
	                
	                <div class="ln_solid"></div>
	                <div class="form-group">
	                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
	                        @csrf()
	                        <input type="hidden" name="prev_image" value="{{ $post->image }}">
	                        <button type="submit" class="btn btn-success pull-right">Submit</button>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
	@endsection