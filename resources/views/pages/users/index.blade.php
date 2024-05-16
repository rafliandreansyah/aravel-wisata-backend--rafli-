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
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item active">Users</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Users</h2>
                <p class="section-lead">List of users</p>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Users</h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>irwan@gmail.com</td>
                                            <td>081232720821</td>
                                            <td>Admin</td>
                                            <td>2017-01-09</td>
                                            {{-- <td>
                                                <div class="badge badge-success">Active</div>
                                            </td> --}}
                                            {{-- <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
                                            <td>

                                                <div class="buttons">
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>irwan@gmail.com</td>
                                            <td>081232720821</td>
                                            <td>Admin</td>
                                            <td>2017-01-09</td>
                                            {{-- <td>
                                                <div class="badge badge-success">Active</div>
                                            </td> --}}
                                            {{-- <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
                                            <td>

                                                <div class="buttons">
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>irwan@gmail.com</td>
                                            <td>081232720821</td>
                                            <td>Admin</td>
                                            <td>2017-01-09</td>
                                            {{-- <td>
                                                <div class="badge badge-success">Active</div>
                                            </td> --}}
                                            {{-- <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
                                            <td>

                                                <div class="buttons">
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>irwan@gmail.com</td>
                                            <td>081232720821</td>
                                            <td>Admin</td>
                                            <td>2017-01-09</td>
                                            {{-- <td>
                                                <div class="badge badge-success">Active</div>
                                            </td> --}}
                                            {{-- <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
                                            <td>

                                                <div class="buttons">
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
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
