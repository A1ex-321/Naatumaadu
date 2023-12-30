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
                                <h3 class="card-title">Add New Product <small>Page</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('products.update', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name">Product Name<span style="color:red">*</span></label>
                                        <input type="text" name="name" class="form-control" id="product_name"
                                            placeholder="Product name" value="{{ old('name', $product->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price<span style="color:red">*</span></label>
                                        <input type="text" name="price" class="form-control" id="price"
                                            placeholder="Price" value="{{ old('price', $product->price) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description<span style="color:red">*</span></label>
                                        <input type="text" name="description" class="form-control" id="description"
                                            placeholder="Product description"
                                            value="{{ old('description', $product->description) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="feature">Feature Product<span style="color:red">*</span></label>
                                        <select name="feature" class="form-control" id="feature" required>
                                            <option value="0"
                                                {{ old('feature', $product->feature) == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1"
                                                {{ old('feature', $product->feature) == '1' ? 'selected' : '' }}>Yes
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Dropdown for Categories -->
                                    <div class="form-group">
                                        <label for="category">Category<span style="color:red">*</span></label>
                                        <select name="category_id" class="form-control" id="category" required>
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dropdown for Brands -->
                                    <div class="form-group">
                                        <label for="brand">Brand<span style="color:red">*</span></label>
                                        <select name="brand_id" class="form-control" id="brand" required>
                                            <option value="" selected disabled>Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" name="image" class="form-control-file" id="image">
                                        @if ($product->image)
                                            <img src="{{ asset('public/images/' . $product->image) }}" width="150"
                                                height="100" alt="Product Image">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="sizes">Sizes (KG and grams) and Price per KG<span
                                                style="color:red">*</span></label>
                                        <input type="text" name="sizes" class="form-control"
                                            placeholder="e.g., 1.5KG:20, 500g:10, 2KG:30"
                                            value="{{ old('sizes', $product->size) }}" required>
                                        <small class="form-text text-muted">Enter sizes and prices separated by commas
                                            (e.g., 1.5KG:20, 500g:10, 2KG:30)</small>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update Product</button>
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
