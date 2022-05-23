@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageContent')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-warning">{{ session('status') }}</div>
        @endif

        <form action="" method="get" class="row g-3 mb-3">
            <div class="col-md-6">
                <select class="form-select" aria-label="Default select example" name="category" id="category">
                    <option value="" selected>Select a category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $request->category) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <select class="form-select" aria-label="Default select example" name="author" id="author">
                    <option value="" selected>Select an author</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $request->author) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-10">
                <label for="search-string" class="form-label">{{ __('Stringa di ricerca') }}</label>
                <input type="text" class="form-control" id="search-string" name="s" value="{{ $request->s }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Applica filtri</button>
            </div>
        </form>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Title</th>
                <th class="text-center" scope="col">Slug</th>
                <th class="text-center" scope="col">Author</th>
                <th class="text-center" scope="col">Category</th>
                <th class="text-center" scope="col">Created At</th>
                <th class="text-center" scope="col">Updated At</th>
                <th class="text-center" scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr data-id="{{ $post->slug }}">
                        <th class="text-center" scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>

                        <td class="text-center" >{{ $post->user_id }}</td>
                        <td class="text-center" >{{ $post->category_id }}</td>

                        <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($post->updated_at)) }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                        </td>
                        <td>
                            @if (Auth::user()->id === $post->user_id)
                                <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (Auth::user()->id === $post->user_id)
                                <button class="btn btn-danger btn-delete">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }}

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
