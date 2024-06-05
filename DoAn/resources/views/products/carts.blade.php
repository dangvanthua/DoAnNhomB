@extends('layout')

@section('title', 'Cart Details')
@section('content')
        <section class="cart-info">
            @if (session('error'))
                <div id="error-message" class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="info-page d-flex justify-content-center align-items-center">
                <h2 class="heading-secondary">Giỏ hàng</h2>
                <i class="cart-icon fa-solid fa-cart-shopping"></i>
            </div>
            
            <div class="info-products p-4">
                <table>
                    <thead class="product-head">
                        <tr>
                            <th></th>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="product-item" data-product-id="{{ $item->product_id }}">
                                <td class="checkbox-column"> 
                                    <input type="checkbox" class="product-checkbox" value="{{ $item->product_id }}">
                                </td>
                                <td class="column-name">
                                    <img class="item-img" src="{{asset($item->product->product_photo)}}" alt="">
                                    <h4 class="item-name"> {{ Str::limit($item->product->product_name, $limit = 30, $end = '...') }}</h4>
                                </td>
                                <td class="item-price">{{ number_format($item->product->price, 0, ',', '.') }} đ</td>
                                <td class="quantity-selector">
                                    <button class="quantity-btn decrement"><i class="fa-solid fa-minus"></i></button>
                                    <input type="number" style="width: 50px; text-align: center" class="quantity-input" value="{{$item->quantity}}" max="{{$item->product->quantity}}">
                                    <button class="quantity-btn increment"><i class="fa-solid fa-plus"></i></button>
                                </td>
                                <td class="total-price">{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} đ</td>
                                <td>
                                    <button class="btn-delete" style="background-color: transparent;"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $cartItems->links() }}
            </div>

            <div class="info-select">
                <div class="info-purchase">
                    <div class="select-pucharse">
                        <p>Tổng sản phẩm (<span class="total-quantity">{{$totalQuantity}}</span> sản phẩm)</p>
                        <p>Tổng giá sản phẩm <span class="total-price" style="color: #35dfac; font-weight: 600;">{{number_format($totalPrice, 0, ',', '.')}}</span> đ</p>
                    </div>

                    <div class="purchase-action">
                        <a href="{{route('orders.success')}}" class="btn-order">Đơn hàng đã đặt</a>
                        <button class="btn-pucharse">Mua hàng</button>
                    </div>
                </div>
            </div>
        </section>

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