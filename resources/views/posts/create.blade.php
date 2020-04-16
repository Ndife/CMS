@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
           {{ isset($post)?'Edit Post' : ' Create Post' }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($post)? route('posts.update', $post->id): route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{isset($post) ? $post->title: '' }}">
                </div>
               <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" rows="5" cols="5" name="description">{{isset($post) ?$post->description: '' }}</textarea>
               </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="summernote" class="form-control" rows="5" cols="5" name="content">
                        {{isset($post) ? $post->content: '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input  id="published_at" class="form-control" name="published_at" value="{{isset($post) ? $post->published_at: '' }}">
                </div>
                @if (isset($post))
                    <div class="form-group">
                    <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="" width="300" height="200">
                    <div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" class="form-control" name="image"/>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                               @if (isset($post))
                                    @if ($category->id == $post->category_id)
                                    selected
                                    @endif
                               @endif
                                >
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}"
                                @if (isset($post))
                                    @if ($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                                >{{$tag->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{isset($post) ? "Update Post" : "Create Post" }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
    <script>
      $(document).ready(function() {
      $('#summernote').summernote();
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        flatpickr("#published_at", {
            enableTime:true,
            enableSeconds: true,
            });
        $(document).ready(function() {
        $('.tags-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
