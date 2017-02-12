@extends('main')

@section('title','| ContactPage')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Contact Me</h3>
            <hr />
            <form action="{{url('contact')}}" method="POST">
            {{csrf_field()}}
                <div class="form-group">
                    <label>Email:</label>
                    <input id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Subject:</label>
                    <input id="subect" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label>Message:</label>
                    <textarea id="message" name="message" class="form-control">Type your message here...</textarea>
                </div>

                <input type="submit" value="Send Message" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection