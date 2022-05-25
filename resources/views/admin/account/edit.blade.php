@extends('layouts.admin')

@section('pageTitle', 'Create post')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.account.update') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                    </div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" disabled>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->userInfo->address) }}">
                    </div>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->userInfo->phone) }}">
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="birth" class="form-label">{{ __('Birth') }}</label>
                        <input type="text" class="form-control" id="birth" name="birth" value="{{ old('birth', $user->userInfo->birth) }}">
                    </div>
                    @error('birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button class="btn btn-primary">Update</button>
                    <input class="btn btn-danger" id="btn-delete" type="button" value="Delete account">
                </form>
                <form id="form-delete" action="{{ route('admin.account.destroy') }}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
