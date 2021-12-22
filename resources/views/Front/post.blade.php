<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post</title>
</head>
<body>
	<div class="wrap">
		@if($post)
			<div class="post">
				<div class="title">
					<h1>{{ $post->title }}</h1>
				</div>
				<div class="description">
					<p>{{ $post->description }}</p>
				</div>
			</div>

			@if($post->comments)
			<div class="comments">
				@foreach($comments as $comment)
				<div class="comment">
					<h2>{{ $comment->user->name }}</h2>
					<p>{{ $comment->comment }}</p>
				</div>
				@endforeach	
			</div>
			@endif
			@if(session()->has('user_id'))
				<div class="write-comment-wrap">
					<form method="post" action="{{ url('admin/post-comment') }}">
						<div class="write-comment">
							<textarea rows="6" name="comment" placeholder="Comment"></textarea>
							@error('comment') <span>{{ $message }}</span> @enderror
						</div>
						<div class="write-comment">
							<input type="hidden" name="_ioeqo" value="{{encrypt($post->id)}}">
							@csrf()
							<input type="submit" name="submit" />
						</div>
					</form>
				</div>
			@else
				<a href="{{ url('login?redirect='.Request::url()) }}">You will have to logged in to comment a post</a>
			@endif
		@endif
	</div>
</body>
</html>