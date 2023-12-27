@extends('admin.layouts.app')

@section('content')
    <div>

        <h2>Gallery List</h2>

        {{-- @foreach ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @endforeach --}}

        <a href="{{ route('products.create') }}">Add New Gallery</a>

    </div>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Backgroundimage</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Gallery</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container-fluid">
                <!-- /.row start -->
                <div class="row">
                    {{-- Start - Content comes here --}}
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add New image<small></small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('backgroundgallery.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PUT') <!-- Use PUT method for updates -->
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control-file" id="image" required>
                                    </div>

                                    

                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Add Gallery</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>





                    {{-- End - Content comes here --}}
                </div>
                <!-- /.row end -->
            </div>
            <!-- /.container-fluid -->
        </div>
    
        </div>

    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sizes').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: 'Add sizes and prices',
            });
        });
    </script>
@endpush
