@extends('layouts.admin')

@section('pageTitle', $post->title)

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $post->title }}</h1>
                <b>{{ $post->user->name }}</b>@if ($post->user->userInfo && $post->user->userInfo->phone) - <b>{{ $post->user->userInfo->phone }}</b> @endif<br>
                <b>{{ $post->category->name }}</b>
                <img src="{{ asset('storage/' . $post->post_image) }}" alt="{{ $post->title }}" class="img-fluid">
                <p>{{ $post->content }}</p>
                @if ($post->tags->all())
                    <p>Tags:
                        @foreach ($post->tags as $tag)
                            <span class="tag">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
