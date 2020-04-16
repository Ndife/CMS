@extends('layouts.app');

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
        @if($users->count()>0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                               <img src="http://www.gravatar.com/avatar/?d=identicon" width='40' height="40" style="border-radius:50%">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            @if(!$user->isAdmin())
                                <form action="{{route('users.make-admin', $user->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary">Make admin</button>
                                    </td>
                                </form>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No User Yet</h3>
        @endif
        </div>
    </div>
@endsection
