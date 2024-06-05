@extends('layout')

@section('title', 'Order success')


@section('content')
    <div class="container">
      <div class="p-4">

        @if (session('warning'))
            <div id="error-message" class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if ($orders->count() > 0)
            <div class="d-flex align-items-baseline justify-content-center gap-3">
                <h1 class="mt-3 order-success-name">Đặt hàng thành công</h1>
                <i class="icon-check-success fa-solid fa-check"></i>
            </div>     
        @endif
    
            @foreach ($orders as $index => $order)

            <div class="mt-5">
                <hr>
                <span class="order-index">Đơn hàng thứ {{$index + 1}} </span>
            </div>

            <div class="row mt-3">
                <div class="col-xs-12">
                    <h2 class="order-succes-detail">Nội dung đặt hàng</h2>
                </div>
            </div>
    
            <div class="row order-detail mt-3">
                <div class="col-xl-6">
                    <p><strong>Họ tên:</strong> {{$order->user->user_name}}</p>
                    <p><strong>Tổng giá:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                    <p><strong>Tổng số lượng:</strong> {{ $order->total_quantity }}</p>
                    <p><strong>Mô tả đặt hàng:</strong> {{ $order->order_description }}</p>
                </div>
                <div class="col-xl-6">
                    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    <p><strong>Thời gian đặt hàng:</strong> {{ $order->order_date }}</p> 
                    <p><strong>Thời gian nhận hàng:</strong> {{ $order->delivery_date }}</p>
                </div>
            </div>
    
            <div class="product_description mt-5">
                <h2 class="order-succes-detail">Thông tin sản phẩm đặt hàng</h2>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tình trạng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td><img src="{{ $item->product->product_photo }}" alt="{{ $item->product->product_name }}" style="width: 50px;"></td>
                                <td>{{ Str::limit($item->product->product_name, $limit = 35, $end='...')}}</td>
                                <td>{{ $item->quantity_order }}</td>
                                <td>
                                    @if ($item->status_order == 'pending')
                                        Chưa giao hàng
                                    @else
                                        Đã giao hàng
                                    @endif
                                </td>
                                <td>{{ number_format($item->product->price, 0, ',', '.')}}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>

     <script>
        document.addEventListener('DOMContentLoaded', function () {
            var errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    setTimeout(function () {
                        errorMessage.style.display = 'none';
                    }, 5000); 
                }
        });
    </script>
@endsection