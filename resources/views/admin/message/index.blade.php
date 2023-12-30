@extends('admin.layouts.app')

@section('content')
    <div>

        <h2>Messages</h2>

        {{-- @foreach ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @endforeach --}}

        <a href="{{ route('products.create') }}">Messages</a>

    </div>

    <div class="content-wrapper">
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                {{-- <form action="{{ route('messages.destroy', $message->id) }}" method="POST"> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                {{-- </form>s --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
