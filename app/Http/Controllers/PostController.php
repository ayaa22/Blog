<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use Purifier;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index') ->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view ('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,array(
                'title'      => 'required|max:255',
                'slug'       => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'=>'required|integer',
                'body'       => 'required'

            ));

        $post = new Post;
        $post-> title = $request->title;
        $post-> body = Purifier::clean($request->body);
        $post-> category_id = $request ->category_id;
        $post ->slug = $request->slug; 

        $post->save();
        $post->tags()->sync($request->tags,false);
        Session::flash('Success','This Post was Successfully saved!');

        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $tag2 = array();
        foreach ($tags as $tag) {
           $tag2[$tag-> id] = $tag-> name;
        }

        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tag2);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);


        if($request->input('slug') == $post-> slug) {

            $this->validate($request,array(
                'title' => 'required|max:255',
                'category_id' =>'required|integer',
                'body' => 'required'
            ));
        } else {

                $this->validate($request,array(
                        'title' => 'required|max:255',
                        'slug' =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                        'category_id' =>'required|integer',
                        'body' => 'required'
                    ));
            }

            $post = Post::find($id);

            $post -> title = $request ->input('title');
            $post -> body = Purifier::clean($request->input('body'));
            $post -> category_id = $request ->input('category_id');
            $post -> slug = $request ->input('slug');

            $post->save();
            if(isset($request->tags)) {

                 $post->tags()->sync($request->tags);
            } else {
                 $post->tags()->sync(array());
            }
            Session::flash('Success','This Post was successfully Updated');

            return redirect()->route('posts.show',$post->id); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post -> delete();
        Session::flash('Success','The post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
