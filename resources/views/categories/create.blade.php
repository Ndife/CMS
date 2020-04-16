@extends('layouts.app');

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($category) ? 'Edit category': 'Create category' }}
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{isset($category) ? route('categories.update', $category->id): route('categories.store')}}" method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <label for="name">Name</label>
           <div class="form-group">
            <input id="name" name="name" placeholder="Name" class="form-control" value="{{ isset($category) ? $category->name: '' }}">
           </div>
           <div class="form-group">
               <button  class="btn btn-success">{{isset($category) ? 'Update Category': 'Add Category' }}</button>
           </div>
        </form>
    </div>
</div>
@endsection