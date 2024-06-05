@extends('layout')

@section('title', 'Home')

@section('content')
    <section id="home">
        <div class="container-fluid home">
            <div class="row p-5">
                <div class="col-xl-5">
                    <h1 class="heading-primary">Welcome to Chợ Nhỏ</h1>
                    <p class="heading-content">Một phần giới thiệu về các bộ sưu tập sản phẩm của cửa hàng, với các danh mục như quần áo, giày dép, phụ kiện, đồ điện tử, và nhiều hơn nữa.
                    </p>
                    <a href="#" class="mt-3 btn-home">Buy now</a>
                </div>

                <div class="col-xl-7">
                    <div class="home-img"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="products">
        <div class="container">
            <div class="p-3">
                <h2 class="heading-section">sản phẩm</h2>
                @php $count = 0; @endphp
                    @foreach($products as $product)
                        @if($count % 4 == 0)
                            <div class="row mt-3">
                        @endif
                        <div class="col-xl-3 d-flex align-items-stretch">
                            <div class="card w-100">
                                <img src="{{ asset($product->product_photo) }}" 
                                    class="card-image card-img-top img-thumbnail" 
                                    style="max-height: 175px; object-fit: cover; cursor: pointer;" alt="..."
                                    data-product-id="{{ $product->product_id }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title product-title">
                                        {{ Str::limit($product->product_name, $limit = 75, $end = '...') }}
                                    </h5>
                                    <p class="card-text mt-auto" style="color: #35dfac; font-weight: 600;">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                    
                                    <form action="{{route('products.addToCart')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <button type="submit" class="btn btn-success mt-auto add-to-cart-btn">Add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @php $count++; @endphp
                        @if($count % 4 == 0 || $loop->last) 
                            </div> 
                        @endif
                @endforeach   
            </div>

            <div class="row">
                <div class="col-xl-12 d-flex justify-content-center mt-3">
                    <a href="{{asset('products')}}" class="btn btn-success p-2">Find more</a>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="p-3">
                 <h2 class="heading-section">tiện ích</h2>
                 <div class="row text-center">
                    <div class="col-xl-3">
                        <div class="service-feature">
                            <div>
                                <i style="color: #fff" class="fa-solid fa-truck-fast"></i>
                                <p>Ship Fast</p>
                            </div>
                        </div>
                    </div>

                     <div class="col-xl-3">
                        <div class="service-feature">
                            <div>
                                <i style="color: #fff" class="fa-solid fa-money-bill"></i>
                                <p>Save money</p>
                            </div>
                        </div>
                    </div>

                     <div class="col-xl-3">
                        <div class="service-feature">
                            <div>
                                <i style="color: #fff" class="fa-solid fa-tv"></i>
                                <p>Good products</p>
                            </div>
                        </div>
                    </div>

                     <div class="col-xl-3">
                        <div class="service-feature">
                            <div>
                                <i style="color: #fff" class="fa-solid fa-clock"></i>
                                <p>Save time</p>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </section>

    <section class="call-info">
        <div class="container">
            <h2 class="heading-secondary text-center">Liên hệ</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên:</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên của bạn">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email của bạn">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Tin nhắn:</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Nhập tin nhắn của bạn"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Gửi tin nhắn</button>
                    </form>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Thông tin liên hệ</h3>
                    <p><strong>Địa chỉ:</strong> Số nhà 123, Đường ABC, Thành phố XYZ</p>
                    <p><strong>Điện thoại:</strong> +84 123 456 789</p>
                    <p><strong>Email:</strong> example@example.com</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        var routes = {
        'productDetail': '{{ route("products.detail", ["productId" => ":productId"]) }}'
    };
    </script>
    <script src="{{asset('js/app.js')}}"></script>
@endsection