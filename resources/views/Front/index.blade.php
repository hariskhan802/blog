<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post</title>
</head>
<body>
	<div class="wrap">
		@if($cats)
		<div class="cats">
			@foreach($cats as $cat)
			<div class="cat">
				<h2>{{ $cat->name }}</h2>
				@if($cat->posts)
				<div class="posts">
					@foreach($cat->posts as $post)
						<div class="post">
							<div class="title">
								<h4><a href="{{ url('post/'.$post->id) }}">{{ $post->title }}</a></h4>
							</div>
							<div class="description">
								<h4>{{ $post->description }}</h4>
							</div>
						</div>

					@endforeach
				</div>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>
</body>
</html>