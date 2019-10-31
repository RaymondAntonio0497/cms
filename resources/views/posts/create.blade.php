@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? 'Edit Post' : 'Create Post' }}
    </div>
    <div class="card-body">
        @include('partial.error')
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title"> Title </label>
                <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : '' }}">
            </div>
            <div class="form-group">
                <label for="description"> Description </label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="content"> Content </label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at"> Published At </label>
                <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
            </div>
            @if(isset($post))
                <div class="form-group">
                    <img src="/storage/{{$post->image}}" alt="" style="width:100%">
                </div>
            @endif
            <div class="form-group">
                <label for="image"> Image </label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}"
                            @if(isset($post))
                                @if($c->id == $post->category_id)
                                    selected
                                @endif
                            @endif
                            >
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($tag->count() > 0)
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tag as $t)
                        <option value="{{ $t->id }}"
                        @if(isset($post))
                            @if($post->hasTag($t->id))
                                selected
                            @endif
                        @endif
                        >
                            {{ $t->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($post) ? 'Update Post' : 'Create Post' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true,
        enableSeconds: true
    })
    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection
