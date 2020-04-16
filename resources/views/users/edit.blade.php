@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">My Profile</div>
        <div class="card-body">
            @include('partials.errors')
        <form action="{{route('users.update-profile',$user->id)}}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" class="form-control" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" class="form-control" id="about" width="20" height="20">{{$user->about}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
