<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create', 'store']);
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->published_at = $request->input('published_at');
        $post->category_id = $request->input('category');
        $post->user_id = auth()->user()->id;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/posts/', $filename);

            $post->image = $filename;
        } else {
            return $request;
            $post->image = '';
        }

        $post->save();
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
      
        session()->flash('success', 'Post created successfully.');
        return redirect(route('posts.index'));
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
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->published_at = $request->input('published_at');
        $post->category_id = $request->input('category');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/posts/', $filename);

            $post->image = $filename;
        }

        
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        $post->update();
      
        
        // $data = $request->only(['title','description','content','published_at',]);
        // if ($request->hasfile('image')) {
        //     $post->deleteImage();
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension(); // getting image extension
        //     $filename = time() . '.' . $extension;
        //     $file->move('uploads/posts/', $filename);

            
        //     $data['image'] = $filename;
        // }

        // $post->update($data);
        // if($request->tags){
        //     $post->tags()->sync($request->tags);
        // }

        
        session()->flash('success', 'Post updated successfully.');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        }
         else {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');
        return redirect()->back();
    }

    
    /**
     * displays the list of all the trashed posts.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', "Post restored successfully");
        return redirect()->back();
    }
}


