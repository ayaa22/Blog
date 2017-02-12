@extends('main')

@section('title','| Edit Blog Post')

@section('stylesheet')

{{ Html::style('css/select2.min.css') }}

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	tinymce.init({
	selector:'textarea',
	plugins:'link'
	});
</script>

@endsection

@section('content')

<div class="row">

	{!! Form::model($post,['route' => ['posts.update', $post-> id], 'method'=>'PUT']) !!}
		<div class="col-md-8">
			
			{{  Form::label('title','Title:') }}
			{{  Form::text('title',null, array('class'=>'form-control','required'=>'','maxlength'=>'255')) }}

			{{  Form::label('slug','Slug:',['class'=>'form-spacing-top']) }}
			{{  Form::text('slug',null, array('class'=>'form-control','required'=>'','minlength'=>'5','maxlength'=>'255')) }}

			{{  Form::label('category_id','Category:',['class'=>'form-spacing-top']) }}

			<select class="form-control" name="category_id">
				@foreach($categories as $category)
					<option value="{{$category-> id}}"> {{$category-> name}} </option>>
				@endforeach
			</select>

			{{  Form::label('tags','Tags:',['class'=>'form-spacing-top']) }}
			{{ Form::select('tags[]',$tags,null,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}

			{{  Form::label('body','Post Body:',['class'=>'form-spacing-top form-spacing-top']) }}
			{{  Form::textarea('body',null, array('class'=>'form-control','required'=>'')) }}			
		
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
				  	<dt>Created at:</dt>
					<dd> {{ $post -> created_at }} </dd>
				</dl>

				<dl class="dl-horizontal">
			  		<dt>Updated at:</dt>
			  		<dd> {{ $post -> updated_at }} </dd>
				</dl>
				<hr />
			<div class="row">
				<div class="col-sm-6">
				{!! Html::LinkRoute('posts.show','Cancel',array($post -> id),array('class'=>'btn btn-danger btn-block')) !!}
				</div>

				<div class="col-sm-6">
				{{ Form::submit('Save',['class'=>'btn btn-success btn-block']) }}
			</div>
		
			</div>
		</div>
	{!! Form::close() !!}
</div> <!-- END of ROW -->

@endsection


@section('scripts')

{!! Html:: script('js/parsley.min.js') !!}
{!! Html:: script('js/select2.min.js') !!}

<script type="text/javascript">
$(".select2-multi").select2();
$(".select2-multi").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
</script>
@endsection