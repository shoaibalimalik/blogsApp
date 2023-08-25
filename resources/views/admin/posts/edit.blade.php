@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Update Post
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.update", [$post->id]) }}" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">Title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="body">Body</label>
                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" cols="30" rows="6" required>{{ old('body', $post->body) }}</textarea>
                @if($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection