@extends('admin.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create</a>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Customer Info</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Hành động</th>
                    </tr>

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul>
                                    <li>Tên: {{ $order->customer->name }}</li>
                                    <li>Email: {{ $order->customer->email }}</li>
                                    <li>Address: {{ $order->customer->address }}</li>
                                    <li>Số điện thoại: {{ $order->customer->phone }}</li>
                                </ul>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-info mt-3">View</a>
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning mt-3">Edit</a>

                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure!')"
                                        class="btn btn-danger mt-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
@endsection