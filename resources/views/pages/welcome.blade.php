@extends('main')

@section('title','| Homepage')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1>Welcome to my Blog!</h1>
                <p>Thank you for trying my First Project in Laravel,Hope you enjoy it</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Posts</a></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="post">
                @foreach($posts as $post)
                <h3>{{ $post-> title }}</h3>
                <p>{{ substr(strip_tags($post-> body),0,50) }} {{ strlen(strip_tags($post-> body)) > 50? "...":""}}</p>
                <a href="{{url('blog/'.$post-> slug)}}" class="btn btn-primary">Show More</a>
                <hr />
                @endforeach
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>
@endsection