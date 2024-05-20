@extends('layouts.app')

@section('title', 'Tickets')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tickets</h1>

                <div class="section-header-button">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Create Ticket</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item active">Tickets</div>
                </div>
            </div>

            <div class="section-body ">
                <h2 class="section-title">Tickets</h2>
                <p class="section-lead">List of tickets</p>
                @include('layouts.alert')

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tickets</h4>
                                <div class="card-header-form">
                                    <form method="GET" action="{{ route('products.index') }}">
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
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Criteria</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($products as $product)
                                            <div class="modal fade fixed-top" tabindex="-1" role="dialog"
                                                data-backdrop="false" id="confirm-delete{{ $product->id }}">
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
                                                            <p>Are you sure you want to delete the user named
                                                                {{ $product->name }}?</p>
                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">


                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('products.destroy', $product->id) }}"
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
                                                <td><img class="rounded"
                                                        src="@if ($product->image) {{ asset("storage/$product->image") }} @else {{ asset('img/example-image.jpg') }} @endif"
                                                        alt="image" width="50">
                                                </td>
                                                <td>{{ $product->name }} @if ($product->favorite)
                                                        <i class=" fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->criteria }}</td>
                                                <td>
                                                    <div
                                                        class="badge @if ($product->status === 'publish') badge-success @elseif($product->status === 'archived') badge-warning @elseif($product->status === 'draft') badge-secondary @endif">
                                                        {{ $product->status }}
                                                    </div>
                                                </td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>
                                                    <div class="buttons">
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#confirm-delete{{ $product->id }}">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $products->withQueryString()->links() }}
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
