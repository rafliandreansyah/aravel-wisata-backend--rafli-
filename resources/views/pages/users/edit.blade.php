@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/users" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/users">Users</a></div>
                    <div class="breadcrumb-item">Edit User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Your User</h4>
                            </div>
                            <form action="{{ route('users.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input value="{{ old('name', $user->name) }}" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input value="{{ old('email', $user->email) }}" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email">

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input value="{{ old('phone', $user->phone) }}" type="phone"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New
                                            Password</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input value="{{ old('password') }}" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm New
                                            Password</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input value="{{ old('password') }}" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="form-group">
                                                <div class="selectgroup w-100">
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="admin"
                                                            class="selectgroup-input"
                                                            @if (old('role', $user->role) === 'admin') checked @endif>
                                                        <span class="selectgroup-button">ADMIN</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="staff"
                                                            class="selectgroup-input"
                                                            @if (old('role', $user->role) === 'staff') checked @endif>
                                                        <span class="selectgroup-button">STAFF</span>
                                                    </label>
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="role" value="user"
                                                            class="selectgroup-input"
                                                            @if (old('role', $user->role) === 'user') checked @endif>
                                                        <span class="selectgroup-button">USER</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary">Edit User</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-Edit.js') }}"></script>
@endpush
