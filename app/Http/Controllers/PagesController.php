<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller {

	public function getIndex() {
		$posts = Post::orderBy('created_at','desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout() {
		return view('pages.about');
		
	}

	public function getContact(Request $request) {
		return view('pages.contact');
		
	}

	public function postContact(Request $request) {
		$this->validate($request,[
			'email'=>'required|email',
			'subject'=>'required|min:6',
			'message'=>'required|min:6'
			]);

		$data = array(
			'email'      => $request-> email,
			'subject'    => $request-> subject,
			'bodyMessage'=> $request-> message
			);

		Mail::send('emails.contact',$data, function($message) use($data) {
			$message-> from($data['email']);
			$message-> to('ayaalaaeldien@hotmail.com');
			$message-> subject($data['subject']);
		});
		Session::flash('Success', 'Your Message was sent Successfully');
		return redirect('/');
		
	}


}