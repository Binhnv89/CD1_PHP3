@extends('admin.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Chi tiết đơn hàng</h2>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Tên</th>
                        <td>{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $order->customer->address }}</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td>{{ $order->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Tổng số tiền</th>
                        <td>{{ number_format($order->total_amount) }} VND</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $order->updated_at }}</td>
                    </tr>
                </tbody>
            </table>

            <h4 class="mt-4">Chi tiết sản phẩm</h4>
            @foreach ($order->details as $detail)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Sản phẩm: {{ $detail->name }}</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Giá</th>
                                    <td>{{ number_format($detail->pivot->price) }} VND</td>
                                </tr>
                                <tr>
                                    <th>Số lượng</th>
                                    <td>{{ $detail->pivot->qty }}</td>
                                </tr>
                                @if ($detail->image && \Storage::exists($detail->image))
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <td>
                                            
                                            <img width="100px" src="{{ \Storage::url($detail->image) }}" alt="Product Image">
                                        </td>
                                    </tr>>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách đơn hàng</a>
        </div>
    </div>
@endsection
