
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
	            <h2>Posts</h2>
	            <a href="{{url('admin/post/create')}}" class="btn btn-primary" style="margin-left: 4%;">Add New Post</a>
	            <ul class="nav navbar-right panel_toolbox">
	                <li class="dropdown">
	                    <form method="get">

	                        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ \Request::input('search') }}">  
	                    </form>
	                </li>
	            </ul>
	            <div class="clearfix"></div>
	        </div>
	        
	        <div class="x_content">
	        	<form method="get">
		        	<div class="row">
		        		<div class="col-md-3">
		        			<select name="cat_id" class="form-control">
								<option value="">Select Category</option>
								@foreach($cats as $cat)
									<option value="{{$cat->id}}" {{ \Request::input('cat_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
								@endforeach
							</select>
		        		</div>
		        		<div class="col-md-1">
		        			<input type="submit" name="submit" value="Filter" class="btn btn-primary">
		        		</div>
		        	</div>
		        </form>
	        	{{ $posts->links() }}
	        	<div class="records">
	        		<p>Records {{$posts->total()}}</p>
	        	</div>
	            <form method="post" class="action-form" action="{{url('admin/post/delete')}}">
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
	                            <th>Title</th>
								<th>Image</th>
								<th>Description</th>
								<th>Category</th>
								<th>User</th>
								<th>Edit</th>
								<th>Delete</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@if($posts->count())
							@foreach($posts as $post)
							
							<tr>
								<td><input type="checkbox" name="ids[]" value="{{ $post->id_hash }}" ></td>
								<td>{{ $post->title }}</td>
								<td><img src="{{ asset('assets/images/post/'.$post->image) }}" width="100"></td>
								<td>{{ $post->description }}</td>
								<td>{{ $post->cat_name }}</td>
								<td>{{ $post->user_name }}</td>
								<td><a href="{{ url('admin/post/edit/'.$post->id_hash) }}" class="btn btn-primary">Edit</a></td>
	                            <td><a class="btn btn-danger " onclick="deleteData('{{ url('admin/post/delete/'.$post->id_hash) }}')">Delete</a></td>
							</tr>
							@endforeach
							
	                        @else

	                            <tr>
	                                <td colspan="9"><h2 class="errormsg">There is no Post</h2></td>
	                            </tr>
	                        @endif
	                    </tbody>
	                </table>
	                @csrf()
	            </form>
	            {{ $posts->links() }}
	        </div>
	    </div>
	</div>

	<script type="text/javascript">
		function redirect(url){
			if (confirm('Are you sure you want to delete?')) {
				location.href = url;

			}
		}
	</script>
@endsection