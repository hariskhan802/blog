
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
	            <h2>Comments</h2>
	            <a href="{{url('admin/post/create')}}" class="btn btn-primary" style="margin-left: 4%;">Add New Comment</a>
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
	        	{{ $comments->links() }}
	        	<div class="records">
	        		<p>Records {{$comments->total()}}</p>
	        	</div>
	            <form method="post" class="action-form" action="{{url('admin/comment/delete')}}">
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
								<th>Comment</th>
								<th>Post</th>
								<th>User</th>
								<th>Edit</th>
								<th>Delete</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@if($comments->count())
							@foreach($comments as $comment)
							
							<tr>
								<td><input type="checkbox" name="ids[]" value="{{ $comment->id_hash }}" ></td>
								<td>{{ $comment->comment }}</td>
								<td>{{ $comment->post }}</td>
								<td>{{ $comment->user_name }}</td>
								<td><a href="{{ url('admin/comment/edit/'.$comment->id_hash) }}" class="btn btn-primary">Edit</a></td>
	                            <td><a class="btn btn-danger " onclick="deleteData('{{ url('admin/comment/delete/'.$comment->id) }}')">Delete</a></td>
							</tr>
							@endforeach
							
	                        @else

	                            <tr>
	                                <td colspan="9"><h2 class="errormsg">There is no Comment</h2></td>
	                            </tr>
	                        @endif
	                    </tbody>
	                </table>
	                @csrf()
	            </form>
	            {{ $comments->links() }}
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