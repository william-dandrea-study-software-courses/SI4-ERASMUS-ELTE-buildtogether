<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return response($posts, 200);
    }

    public function searchByString(String $search)
    {
        $posts = Post::where(strtoupper('title'), 'like', '%'.strtoupper($search).'%')->get();
        return response($posts, 200);

    }

    public function myPosts()
    {
        $posts=Post::where('user_id' ,'=', (Auth::id()))->get();
        return $posts;
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('posts.create');
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
            'title' => ['required', 'string', 'max:30'],
            'body' => ['required', 'string',  'max:500'],
        ]);
        $post = new Post([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id(), 
        ]);
        $post->save();
        return response($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        #$post = Post::find($id);
        #return view('posts.edit', compact('post'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(($post->user_id) == (Auth::id())){
            $data = $request->all();
            $post->update($data);
            return $post;
        }
        else{
            return response()->json(['message' => 'Cannot modify another user post'], 401);
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {  
        
    
       if(($post->user_id) == (Auth::id())){
          $post->delete();
          return response()->json(['message' => 'Post deleted successfully'], 200);
          }
    else{
        return response()->json(['message' => 'Cannot delete another user post'], 401);
     } 
    
    }
    
    public function search($title)
    {
        //
        return Post::where('title','like','%'.$title.'%')->get();
    }
}