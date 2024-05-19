@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>

                <div class="section-header-button">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item active">Category</div>
                </div>
            </div>

            <div class="section-body ">
                <h2 class="section-title">Category</h2>
                <p class="section-lead">List of categories</p>
                @session('success')
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ $value }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endsession

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Users</h4>
                                <div class="card-header-form">
                                    <form method="GET" action="{{ route('categories.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="keyword"
                                                @isset($keyword)
                                                value="{{ $keyword }}"
                                            @endisset>
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($categories as $category)
                                            <div class="modal fade fixed-top" tabindex="-1" role="dialog"
                                                data-backdrop="false" id="confirm-delete{{ $category->id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete the category named
                                                                {{ $category->name }}?</p>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">


                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <div class="buttons">
                                                        <a href="{{ route('users.edit', $category->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#confirm-delete{{ $category->id }}"
                                                            data-user-id="{{ $category->id }}">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $categories->withQueryString()->links() }}
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
