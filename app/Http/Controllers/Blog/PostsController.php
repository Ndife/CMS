<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post){
        return view('blog.show')->with('post', $post);
    }

    public function category(Category $category){

        return view('blog.category')
        ->with('category', $category)
        ->with('posts', $category->posts()->searched()->simplePaginate(3))
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    public function tag(Tag $tag){

        // $search = request()->query('search');
        
        // if($search){
        //     $posts = $tag->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(3);
        // }else {
        //     $posts = $tag->posts()->simplePaginate(3);
        // }
        
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('posts', $tag->posts()->searched()->simplePaginate(3))
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }
}
