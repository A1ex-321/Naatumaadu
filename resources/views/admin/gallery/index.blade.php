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
                        <h1 class="m-0">Add New Gallery</h1>
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
                                <h3 class="card-title">Add New Gallery<small>Page</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name">Product Name<span style="color:red">*</span></label>
                                        <input type="text" name="name" class="form-control" id="product_name"
                                            placeholder="Product name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" name="image" class="form-control-file" id="image">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status<span style="color:red">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ old('status' == 1) ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status' == 0) ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
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
        <div class="container">
            @if (count($galleries) > 0)
                <h6>Gallery List</h6>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->id }}</td>
                                <td>{{ $gallery->name }}</td>
                                <td><img src="{{ asset('public/images/' . $gallery->image) }}" alt="" style="max-width: 100px; max-height: 70px;"></td>

                                <td style="display: flex">
                                    {{-- <a href="{{ route('products.edit', $gallery->id) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a> --}}
                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this gallery?')">
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
                <p>No gallery available.</p>
            @endif
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
