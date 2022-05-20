@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-warning">{{ session('status') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create a post</a>
                    <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">All post</a>
                    <a class="btn btn-primary" href="{{ route('admin.posts.myindex') }}">My post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
