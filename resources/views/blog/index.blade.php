@extends('main')
@section('title','| Blog')

@section('content')

<div class="row">
	<div class="col-md-12">
		<h2>Blog</h2>
	</div>
</div>

@foreach ($posts as $post )
<div class="row">
	<div class="col-md-8 col-md-offset-2">
	
		<h1> {{ $post -> title }} </h1>
		<h5>Published at: {{ $post-> created_at }} </h5>
		<p>{{ substr(strip_tags($post-> body),0,50) }} {{ strlen(strip_tags($post-> body)) > 50? "...":""}}</p>
		<a href="{{route('blog.single', $post-> id)}}" class="btn btn-primary">Read More</a>
		<hr />	

	</div>
</div>
@endforeach

<div class="row">
	<div class="col-md-12">
		<div class="text-centre">
			{!! $posts-> links() !!}
		</div>
	</div>
</div>

@endsection