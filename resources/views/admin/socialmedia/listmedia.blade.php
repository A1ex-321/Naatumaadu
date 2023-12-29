@extends('admin.layouts.app')

@section('content')
    <div>


@section('content')
    <div>

        

        <!-- <a href="{{ route('products.create') }}">Add New social meadia</a> -->

    </div>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New  social meadia</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol> -->
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
                                <h3 class="card-title">Add New  social meadia <small>Page</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('socialmedia.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name">Face Book<span style="color:red">*</span></label>
                                        <input type="text" name="facebook" class="form-control" id="product_name"
                                            placeholder="Face Book" value="{{ old('facebook') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Instagram<span style="color:red">*</span></label>
                                        <input type="text" name="instagram" class="form-control" id="price"
                                            placeholder="Instagram" value="{{ old('Instagram') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Twitter<span style="color:red">*</span></label>
                                        <input type="text" name="twitter" class="form-control" id="description"
                                            placeholder="twitter" value="{{ old('twitter') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Google<span style="color:red">*</span></label>
                                        <input type="text" name="google" class="form-control" id="description"
                                            placeholder="Google" value="{{ old('google') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mail<span style="color:red">*</span></label>
                                        <input type="email" name="mail" class="form-control" id="description"
                                            placeholder="Email" value="{{ old('mail') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Video link<span style="color:red">*</span></label>
                                        <input type="text" name="videolink" class="form-control" id="description"
                                            placeholder="videolink" value="{{ old('videolink') }}" required>
                                    </div>
                                </div>



                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Add </button>
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

    <div class="container" style="max-width:720px !important">
        @if (count($galleries) > 0)
            <h6>social media List(*Only First column will be display on Dashboard and If exists column please Delete others*)</h6>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Face Book</th>
                        <th>Instagram</th>
                        <th>Twitter</th>
                        <th>Google</th>
                        <th>Mail</th>
                        <th>Videolink</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->facebook }}</td>
                            <td>{{ $product->instagram }}</td>
                            <td>{{ $product->twitter }}</td>
                            <td>{{ $product->google }}</td>
                            <td>{{ $product->mail }}</td>
                            <td>{{ $product->videolink }}</td>
                            <td style="display: flex">
                                <a href="{{ route('edit-media', $product->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit fa-sm"></i>
                                </a>
                                <form action="{{ route('socialmedia.destroy', $product->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No media available.</p>
        @endif
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


@endsection

