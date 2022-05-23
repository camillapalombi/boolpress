<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} | @yield('pageTitle')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <x-navbar color="dark" />

    <div class="container mt-4">
        <div class="row">
            <div class="col-2">
                <div><a href="{{ route('admin.posts.index') }}">All Posts</a></div>
                <div><a href="{{ route('admin.posts.create') }}">New Post</a></div>
                <div><a href="{{ route('admin.categories.index') }}">All Categories</a></div>
                <div><a href="{{ route('admin.categories.create') }}">New Category</a></div>
            </div>

            <div class="col-10">
                @yield('pageContent')
            </div>
        </div>
    </div>
</body>
</html>
