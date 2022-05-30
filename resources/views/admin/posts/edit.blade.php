@extends('layouts.admin')

@section('pageTitle', 'Create post')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.posts.update', $post->slug) }}" method="post"  enctype="multipart/form-data">
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

                    <select class="form-select" aria-label="Default select example" name="category_id" id="category">
                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == old('category_id', $post->category->id)) selected @endif>
                                    {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <fieldset>
                        <legend>Tags</legend>
                        @foreach ($tags as $tag)
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                                @if (in_array($tag->id, old('tags', $post->tags->pluck('id')->all()))) checked @endif>
                            <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                        @endforeach
                    </fieldset>
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="post_image" class="form-label">Post image</label>
                        <input class="form-control" type="file" id="post_image" name="post_image" accept="image/*">
                    </div>
                    <img src="{{ asset('storage/' . $post->post_image) }}" alt="" class="img-fluid">
                    @error('post_image')
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
