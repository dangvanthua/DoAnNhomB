@extends('layout')

@section('title', 'Checkout')
@section('content')
    <main class="checkout-main">
        <div class="info-page d-flex justify-content-center align-items-center">
                <h2 class="heading-secondary">Thanh toán</h2>
                <i class="money-icon fa-solid fa-money-bill"></i>
        </div>

        <section class="section-checkout">
            <div class="checkout-info">
                 <div class="info-products">
                    <table>
                        <thead class="product-head">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPrice = 0;
                                $totalQuantity = 0;
                                $productIds = [];
                                $quantityInput = [];
                            @endphp
                            @foreach ($checkoutProducts as $item)
                                @php
                                    $quantity = $quantities[$item->product_id];
                                    $quantityInput[$item->product_id] = $quantity;
                                    $subtotal = $quantity * $item->price; 
                                    $totalPrice += $subtotal;
                                    $totalQuantity += $quantity; 

                                    $productIds[] = $item->product_id; 
                                @endphp
                                <tr class="product-item" data-product-id="{{ $item->product_id }}">
                                    <td class="column-name">
                                        <img class="item-img" src="{{asset($item->product_photo)}}" alt="">
                                        <h4 class="item-name"> {{ Str::limit($item->product_name, $limit = 30, $end = '...') }}</h4>
                                    </td>
                                    <td class="item-price">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                    <td class="quantity-selector">
                                        <button class="quantity-btn decrement"><i class="fa-solid fa-minus"></i></button>
                                        <input type="number" style="width: 50px; text-align: center" class="quantity-input" value="{{$quantity}}" max="{{$item->quantity}}">
                                        <button class="quantity-btn increment"><i class="fa-solid fa-plus"></i></button>
                                    </td>
                                    <td class="total-price">{{ number_format($quantity * $item->price, 0, ',', '.') }} đ</td>
                                    <td>
                                        <button class="btn-delete" style="background-color: transparent;"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="checkout-payment">
                <div class="checkout-register">
                    <form action="{{route('checkout.process')}}" method="post">
                        @csrf
                        <label for="address">Địa chỉ:</label>
                        <textarea id="address" name="address" required>{{old('address')}}</textarea>
                        @error('record')
                            <span class="text-danger">{{ $message }}</span>                            
                        @enderror

                        <label for="extra_message">Thêm thông tin:</label>
                        <textarea id="extra_message" name="extra_message" required>{{ old('extra_message') }}</textarea>
                        @error('extra_message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                        <div class="payment-option">
                            <input type="radio" id="payment-cod" name="payment-method" value="cod" checked>
                            <label for="payment-cod">Thanh toán khi nhận hàng</label>
                        </div>
                
                        <div class="payment-option">
                            <input type="radio" id="payment-card" name="payment-method" value="card">
                            <label for="payment-card">Thanh toán qua thẻ</label><br>
                        </div>
            
                        <div class="card-info" id="card-info" style="display:none;">
                            <label for="card">Số thẻ tín dụng:</label>
                            <input type="text" id="card" name="card">
                            <label for="expiry">Ngày hết hạn:</label>
                            <input type="text" id="expiry" name="expiry" placeholder="MM/YY">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv">
                        </div>

                        <input type="hidden" name="total_quantity" value="{{ $totalQuantity }}">
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="product_ids_json" value="{{ json_encode($productIds) }}">
                        @foreach ($quantityInput as $productId => $quantity)
                            <input type="hidden" name="quantities[{{ $productId }}]" value="{{ $quantity }}">
                        @endforeach

                        <button type="submit">Thanh toán</button>
                    </form>
                </div>

                <div class="checkout-total-price">
                    <div class="price-container">
                        <h4>Thông tin thanh toán</h4>
                        <div class="price-info">
                            <p>Tổng tiền hàng</p>
                            <span>{{number_format($totalPrice, 0, ',', '.')}}đ</span>
                        </div>
                        <div class="price-info">
                            <p>Tổng thanh toán</p>
                            <span>{{number_format($totalPrice, 0, ',', '.')}}đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection