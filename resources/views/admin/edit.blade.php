        @extends('admin.master')

        @section('title')
            Cập nhật đơn hàng
        @endsection

        @section('content')
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form action="{{ route('orders.update', $order) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <h2 class="mt-3 mb-3">Thông tin khách hàng</h2>
                        <div class="form-group">
                            <label for="customer_name">Tên: </label>
                            <input type="text" name="customer_name" class="form-control" value="{{ $order->customer->name}}">
                            @error('customer_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Email: </label>
                            <input type="email" name="customer_email" class="form-control" value="{{ $order->customer->email}}">
                            @error('customer_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Địa chỉ: </label>
                            <input type="text" name="customer_address" class="form-control" value="{{ $order->customer->address}}">
                            @error('customer_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Số điện thoại: </label>
                            <input type="text" name="customer_phone" class="form-control" value="{{ $order->customer->phone}}">
                            @error('customer_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <h2 class="mt-3 mb-3">Tổng tiền</h2>
                        <h3 class="text-success">{{ number_format($order->total_amount) }}</h3>
                    </div>

                    <div class="col-md-8">
                        <h2 class="mt-3 mb-3">Danh sách sản phẩm</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Qty (số lượng bán)</th>
                                </tr>
                                @foreach ($order->details as $detail)
                                    <tr>
                                        <td>
                                            {{ $detail->name }}
                                        </td>
                                        <td>
                                            {{ number_format($detail->price) }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="order_details[{{ $detail->id }}][price]"
                                                value="{{ $detail->pivot->price }}">

                                            <input type="number" class="form-control"
                                                name="order_details[{{ $detail->id }}][qty]" value="{{ $detail->pivot->qty }}">
                                            @error("order_details.$detail->id.qty")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                    <a href="{{ route ('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
                </div>

            </form>
        @endsection
