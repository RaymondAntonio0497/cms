@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card-body">
        @if($users->count() > 0)
        <table class="table">
            <thead>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>
                        <img width="40px" height="40px" style="border-radius : 50%" src="{{ Gravatar::src($u->email) }}" alt="">
                    </td>
                    <td>
                        {{ $u->name }}
                    </td>
                    <td>
                        {{ $u->email }}
                    </td>
                    <td>
                        @if(!$u->isAdmin())
                        <form action="{{ route('users.make-admin', $u->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-center">No User at this Moment</h3>
        @endif
    </div>
</div>
@endsection