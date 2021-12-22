@extends('Layout.Admin.default')
@section('title', 'Home')
@section('content')
	<div class="main-view ">
	    @if(session('message'))	
	    <div class="alert alert-success col-sm-8 col-sm-offset-2">
	        <h2>{{session('message')}}</h2>
	    </div>
	    @endif
	    @if(session('errormsg'))	
	    <div class="alert alert-danger col-sm-8 col-sm-offset-2">
	        <h2>{{ session('errormsg') }}</h2>
	    </div>
	    @endif

	    <div class="x_panel">
	        <div class="x_title">
	            <h2>Categories</h2>
	            <a href="{{url('admin/category/create')}}" class="btn btn-primary" style="margin-left: 4%;">Add New Category</a>
	            <ul class="nav navbar-right panel_toolbox">
	                <li class="dropdown">
	                    <form method="get">
	                        <input type="text" class="form-control" placeholder="Search.." name="search" value="">  
	                    </form>
	                </li>
	            </ul>
	            <div class="clearfix"></div>
	        </div>
	        
	        <div class="x_content">
	        	{{-- $cats->links() --}}
	        	<div class="records">
	        		<p>Records {{-- $cats->total() --}}</p>
	        	</div>
	            <form method="post" class="action-form" action="{{url('admin/category/delete')}}">
	                <div class="m-action-wrap">
	                    <div class="col-sm-2 margin-bottom">
	                        <select name="action" class="form-control" >
	                            <option value="">Select</option>
	                            <option value="delete">Delete</option>
	                        </select>
	                    </div>
	                </div>
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th><input type="checkbox" class="checkbox-all"></th>
	                            <th>Name</th>
	                            <th>Image</th>
	                            <th>Description</th>
	                            <th>User</th>
	                            <th>Post</th>
	                            <th>Number Of Post</th>
	                            <th>Edit</th>
	                            <th>Delete</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @if($cats->count())
	                        @foreach($cats as $cat)
	                        <tr>
	                            <td><input type="checkbox" name="ids[]" value="{{ $cat->id_hash }}" ></td>
	                            <td>{{ $cat->name }}</td>
	                            <td><img src="{{ asset('assets/images/category/'.$cat->image) }}" width="100"></td>
	                            <td>{{ $cat->description }}</td>
	                            <td>{{ $cat->user_name }}</td>
	                            <td>
	                        		<ul>
	                        			@foreach($cat->posts as $post)
	                        			<li>{{ $post->title }}</li>
	                        			@endforeach
	                        			<li><a href="{{ url('admin/posts/?cat_id='.$cat->id) }}">View More</a></li>
	                        		</ul>
	                            </td>
	                            <td>{{ $cat->posts_count }}</td>
	                            <td><a href="{{ url('admin/category/edit/'.$cat->id_hash) }}" class="btn btn-primary">Edit</a></td>
	                            <td><a class="btn btn-danger " onclick="deleteData('{{ url('admin/category/delete/'.$cat->id_hash) }}')">Delete</a></td>
	                        </tr>
	                        @endforeach
	                        @else
	                            <tr>
	                                <td colspan="7"><h2 class="errormsg">There is no Category</h2></td>
	                            </tr>
	                        @endif
	                    </tbody>
	                </table>
	                @csrf()
	            </form>
	            {{-- $cats->links() --}}
	        </div>
	    </div>
	</div>


@endsection