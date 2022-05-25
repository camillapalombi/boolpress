@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageContent')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-warning">{{ session('status') }}</div>
        @endif

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Name</th>
                <th class="text-center" scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr data-id="{{ $category->id }}">
                        <th class="text-center" scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.categories.show', $category->id) }}">View</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-delete">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.categories.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
