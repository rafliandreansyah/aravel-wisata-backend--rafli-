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
