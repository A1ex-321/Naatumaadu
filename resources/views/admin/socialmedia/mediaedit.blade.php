@extends('admin.layouts.app')

@section('content')
    <div>

        <h2>Product</h2>

        {{-- @foreach ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @endforeach --}}

        <a href="{{ route('products.create') }}">EditProduct</a>

    </div>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                                <h3 class="card-title">Edit New Product <small>Page</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('update-media', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name">Face book<span style="color:red">*</span></label>
                                        <input type="text" name="facebook" class="form-control" id="product_name"
                                            placeholder="Product name" value="{{ old('facebook', $product->facebook) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Instagram<span style="color:red">*</span></label>
                                        <input type="text" name="instagram" class="form-control" id="price"
                                            placeholder="instagram" value="{{ old('instagram', $product->instagram) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Twitter<span style="color:red">*</span></label>
                                        <input type="text" name="twitter" class="form-control" id="description"
                                            placeholder="twitter "
                                            value="{{ old('twitter', $product->twitter) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Google<span style="color:red">*</span></label>
                                        <input type="text" name="google" class="form-control" id="description"
                                            placeholder="Google "
                                            value="{{ old('google', $product->google) }}" required>
                                    </div><div class="form-group">
                                        <label for="description">Mail<span style="color:red">*</span></label>
                                        <input type="email" name="mail" class="form-control" id="description"
                                            placeholder="mail "
                                            value="{{ old('mail', $product->mail) }}" required>
                                    </div><div class="form-group">
                                        <label for="description">Video Link<span style="color:red">*</span></label>
                                        <input type="text" name="videolink" class="form-control" id="description"
                                            placeholder="videolink "
                                            value="{{ old('videolink', $product->videolink) }}" required>
                                    </div>

                                   


                                   
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update </button>
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
