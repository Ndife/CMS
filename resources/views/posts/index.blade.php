@extends('layouts.app');

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a class="btn btn-success" href="{{route('posts.create')}}">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
        @if($posts->count()>0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset('uploads/posts/' . $post->image) }}" width="60" height="60"/>
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                {{$post->category->name}}
                            </td>
                            <td>
                                <form action={{route('posts.destroy', $post->id)}} method="POST" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm float-right">
                                        {{$post->trashed() ?'Delete' : 'Trash'}}
                                    </button>
                                </form>
                            </td>
                            <td>
                                @if(!$post->trashed())
                                <a href={{route("posts.edit", $post->id)}} class="btn btn-info btn-sm float-right mr-2">Edit</a>
                                @else
                                <form action="{{route("restore-posts", $post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm float-right mr-2">Restore</button>
                                </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No Post Yet</h3>
        @endif
        </div>
    </div>
@endsection
