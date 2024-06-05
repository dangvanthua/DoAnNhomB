@extends('layout')

@section('Product Detail')

@section('content')
    <div class="container">
        <h3 class="heading-sub text-center mt-3">Chi tiết sản phẩm</h3>
        <div class="row p-4">
            <div class="col-xl-4">
                <div class="product-img">
                    <img src="{{asset($product->product_photo)}}" alt="" style="width: 100%">
                </div>
            </div>

            <div class="col-xl-8">
                <h4 class="product-name mb-3">{{$product->product_name}}</h4>
                <div class="product-detail d-flex align-items-baseline gap-5 mb-3">
                    <button class="btn-review">Đánh giá</button>
                    <p class="product-quantity">Số lượng sản phẩm: <span>{{$product->quantity}}</span></p>
                </div>
                <div class="product-info">
                    <div class="d-flex align-items-center gap-4">
                        <p class="product-price">Giá sản phẩm <span style="color: #35dfac; font-size: 18px">{{number_format($product->price, 0, ',', '.')}} đ</span></p>
                        <p class="product-status" style="font-weight: 700; color: {{ $product->status === 'active' ? 'green' : 'red' }};">
                        Tình trạng:
                        @if($product->quantity > 0)
                            Còn hàng
                        @else
                            Hết hàng
                        @endif
                    </p>
                    </div>
                    
                    <p class="product-desc">
                    {{$product->product_detail}}
                    </p>
                    
                    <p class="product-category">Danh mục sản phẩm: <span>{{$product->category->category_name}}</span></p>
                    <div class="product-voucher">
                        @if ($product->voucher)
                            Voucher của sản phẩm: <span style="color: #35dfac; font-size: 18px;">{{ $product->voucher->voucher_name }}</span>
                        @else
                            Không có voucher cho sản phẩm này.
                        @endif
                    </div>

                   <form method="POST" action="{{route('products.addToCart')}}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="btn-minus"><i class="fas fa-minus"></i></button>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control quantity" name="quantity" value="1" min="1" max="{{ $product->quantity }}" style="width: 100px; text-align: center;">
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-plus"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="product-purchase">
                            <button type="submit" class="btn btn-danger">Thêm vào giỏ hàng <i class="cart-icon fa-solid fa-cart-shopping" style="font-size: 14px"></i></button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("btn-plus").addEventListener("click", function() {
                const quantityInput = document.querySelector(".quantity");
                let currentValue = parseInt(quantityInput.value);
                let maxValue = parseInt(quantityInput.max);

                if(currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                }
            });

            document.getElementById("btn-minus").addEventListener("click", function() {
                const quantityInput = document.querySelector(".quantity");
                let currentValue = parseInt(quantityInput.value);

                if(currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
    });
    </script>
@endsection