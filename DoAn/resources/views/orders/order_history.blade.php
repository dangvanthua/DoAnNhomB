@extends('layout')

@section('title', 'Order success')


@section('content')
<div class="container">
    <div class="p-4">
        <div class="d-flex align-items-baseline justify-content-center gap-3">
            <h1 class="mt-3 order-success-name">Lịch sử mua hàng</h1>
            <i class="icon-check-success fa-solid fa-check"></i>
        </div>

        @foreach ($orders as $index => $order)

        <div class="mt-5">
            <hr>
            <span class="order-index">Đơn hàng thứ {{$index + 1}} </span>
        </div>

        <div class="row mt-3">
            <div class="col-xs-12">
                <h2 class="order-succes-detail">Thông tin đặt hàng</h2>
            </div>
        </div>

        <div class="row order-detail mt-3">
            <div class="col-xl-6">
                <p><strong>Tổng giá:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                <p><strong>Total số lượng:</strong> {{ $order->total_quantity }}</p>
                <p><strong>Người mua hàng:</strong> {{ $order->user->user_name }}</p>
                <!-- <p><strong>Mô tả order:</strong> {{ $order->order_description }}</p> -->
            </div>
            <div class="col-xl-6">
                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                <p><strong>Thời gian đặt hàng:</strong> {{ $order->order_date }}</p>
                <p><strong>Thời gian nhận hàng:</strong> {{ $order->delivery_date }}</p>
            </div>
        </div>

        <div class="product_description mt-5">
            <h2 class="order-succes-detail">Thông tin sản phẩm được đặt</h2>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Người bán</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                    <tr>
                        <td><img src="{{ $item->product->product_photo }}" alt="{{ $item->product->product_name }}" style="width: 50px;"></td>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->product->user->user_name }}</td>
                        <td>{{ $item->quantity_order }}</td>
                        <td>{{ number_format($item->product->price, 0, ',', '.')}}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endsection