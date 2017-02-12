@extends('main')
@section('title','| Forgot your Password')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">

			<div class="panel-body">

			{!!Form::open(['url'=>'password/email','method'=>'POST'])!!}

			{{Form::label ('email','Email Address:')}}
			{{Form::email('email',null,['class'=>'form-control'])}}

			<br>
			
			{{Form::submit('Reset Password',['class'=>'btn btn-primary btn-block'])}}
			{!!Form::close()!!}
			
			</div>

			</div>
		</div>
	</div>
</div>

@endsection