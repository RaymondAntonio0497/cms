@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Tags
    </div>
    <div class="card-body">
        @if($tag->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <!-- <th>Posts</th> -->
                    <th></th>
                </thead>
                <tbody>
                    @foreach($tag as $t)
                    <tr>
                        <td>
                            {{ $t->name }}
                        </td>
                        <td> 
                            {{$t->posts->count()}} 
                        </td>
                        <td>
                            <a href="{{ route('tags.edit', $t->id) }}" class="btn btn-info btn-sm">
                                Edit
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $t->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="post" id="deleteTagsForm">
                        @csrf
                        @method('delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to delete this Tag ?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <h3 class="text-center">No Tag Yet</h3>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleDelete(id) {
        
        var form = document.getElementById('deleteTagsForm')
        form.action = '/tags/' + id
        $('#deleteModal').modal('show')
    }
    
</script>
@endsection
