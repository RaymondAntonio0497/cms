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
        @if($posts->count() > 0)
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($posts as $p)
                <tr>
                    <td>
                        <img src="{{$p->image}}" width="80px" alt="">
                    </td>
                    <td>
                        {{ $p->title }}
                    </td>
                    <td>
                        {{ $p->category->name }}
                    </td>
                    @if(!$p->trashed())
                    <td>
                        <a href="{{ route('posts.edit', $p->id) }}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                    </td>
                    @else
                    <td>
                        <form action="{{ route('restore_posts.index', $p->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="btn btn-info btn-sm">
                                Restore
                            </button>
                        </form>
                    </td>
                    @endif
                    <td>
                        <form action="{{ route('posts.destroy', $p->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">
                                {{$p->trashed() ? 'Delete' : 'Trash'}}
                            </button>
                        </form>
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