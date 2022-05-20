@extends('layouts.admin')

@section('pageTitle', 'Create post')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.posts.update', $post->slug) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="slug" class="form-label">{{ __('Slug') }}</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                    </div>
                    <input type="button" value="Generate slug" id="btn-slugger">
                    @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="content" class="form-label">{{ __('Content') }}</label>
                        <textarea class="form-control" id="content" rows="10" name="content">{{ old('content', $post->content) }}</textarea>
                    </div>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button>Update</button>
                    <input id="btn-delete" type="button" value="Delete">
                </form>
                <form id="form-delete" action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
