@if(Session::has('Success'))

<div class="alert alert-success" role="alert">
<Strong>Success:</Strong> {{ Session::get('Success') }}
</div>
@endif

@if (count($errors) > 0 ) 
	<div class="alert alert-danger" role="alert">

		<Strong>Errors:</Strong>

		@foreach($errors ->all() as $error)

		<li>{{ $error }} </li>

		@endforeach

	</div>
@endif