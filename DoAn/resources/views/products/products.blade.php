@extends('layout')

@section('title', 'Products')

@section('content')
    <div class="container">
        <h3 class="heading-sub text-center mt-3">Sản phẩm</h3>  

        @php $count = 0; @endphp

        @foreach($products as $product)
            @if($count % 4 == 0)
                <div class="row mt-5">
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

        <div class="row mt-3">
            <div class="col-xl-12 pagination">
                {{ $products->links() }}
            </div>
        </div>

    </div> 
    
    <script>
        var routes = {
        'productDetail': '{{ route("products.detail", ["productId" => ":productId"]) }}'
    };
    </script>
    <script src="{{asset('js/app.js')}}"></script>
@endsection