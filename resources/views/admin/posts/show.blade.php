@extends('layouts.admin')

@section('pageTitle', $post->title)

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $post->title }}</h1>
                <b>{{ $post->user->name }}</b> - <b>{{ $post->user->userInfo->phone }}</b><br>
                <b>{{ $post->category->name }}</b>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
