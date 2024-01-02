@extends('admin.layouts.app')

@section('content')
    <div>

        <h2>Orders List</h2>

        {{-- @foreach ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @endforeach --}}

        <a href="{{ route('products.create') }}">Orders</a>

    </div>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Orders</a></li>
                            <li class="breadcrumb-item active">All Orders</li>
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
                                <h3 class="card-title">All Orders <small>Page</small></h3>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Invoice</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</td>
                                                <td>{{ $order->billing_email }}</td>
                                                <td>{{ $order->billing_phone }}</td>
                                                <td>{{ $order->billing_address }},{{ $order->billing_postcode }}</td>
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('orders.updateStatus', $order->id) }}"
                                                        class="d-flex align-items-center justify-content-between">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="input-group">
                                                            <select name="order_status" class="form-select">
                                                                <option value="pending"
                                                                    {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="processing"
                                                                    {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                                                    Processing</option>
                                                                <option value="shipped"
                                                                    {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                                                    Shipped</option>
                                                                <option value="cancelled"
                                                                    {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                                                    Cancelled</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-success ml-2">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>
                                                    <a href="{{ route('orders.generateInvoice', $order->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Download Invoice
                                                    </a>
                                                </td>
                                                <td>
                                                    {{-- <a href="#" class="btn btn-info btn-sm mr-2">
                                                        <i class="fas fa-eye fa-sm"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit fa-sm"></i>
                                                    </a> --}}

                                                    <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mt-2">
                                                            <i class="fas fa-trash fa-sm"></i>
                                                        </button>
                                                    </form>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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
