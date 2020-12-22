<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
          //掲示板の内容
          $posts = Post::orderBy('id','desc')->get();
          $posts->load('category','user');

          return view('posts.index',[
            'posts' => $posts,
          ]);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title' => 'required|max:255',
          'content' => 'required',
          'user_id' => 'required',
          'category' => 'required',
          'image' => 'required',
        ],[
          'title.required' => 'タイトルを入力してください。',
          'content.required' => '本文を入力してください。',
          'image.required' => '画像を選択してください。',
        ]);
      
        $post = new Post;
        $post->user_id = $request->input('user_id');
        $post->category_id = $request->input('category');
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $image = $request->file('image');
        //if($request->hasFile('image') && $image->isValid()){
          $filename = $request->file('image')->store('public/images');
          $post->image = basename($filename);
        //}


        $post->save();

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      $post->load('category','user');

      $comments = Comment::all();
      $comments->load('user');

      return view('posts.show',[
        'post' => $post,
        'comments' => $comments,
      ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $posts = Post::where('user_id', $id )->get();
      $posts->load('category','user');
    
      return view('posts.edit',[
        'posts' => $posts,
      ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete (Request $request)
    {
      Post::find($request->id)->delete();
      return redirect('/');
    }
}
