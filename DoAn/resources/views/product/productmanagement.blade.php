@extends('layout')

@section('title', 'Checkout')

@section('content')
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Times New Roman", sans-serif;
        line-height: 1;
        font-weight: 400;
        color: #495057;
        position: relative;
        padding-bottom: 60px;
        min-height: 100vh;
        margin: 0;
    }

    /* MAIN */
    main {
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #12b886;
    }

    .edit-button,
    .delete-button {
        padding: 5px;
        background-color: transparent;
        border: none;
        cursor: pointer;
        color: #ff132e;
    }

    .edit-button:hover,
    .delete-button:hover {
        color: #999;
    }

    .edit-button:focus,
    .delete-button:focus {
        outline: none;
        box-shadow: none;
    }

    .main-buttons {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .add-product-button,
    .add-voucher-button {
        padding: 10px 20px;
        background-color: #12b886;
        color: #fff;
        border: none;
        cursor: pointer;
        margin: 10px;
        border-radius: 4px;
        text-decoration: none;
    }

    .add-product-button:hover,
    .add-voucher-button:hover {
        background-color: #0069d9;
    }

    .img {
        height: 10rem;
    }

    .filter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        padding: 10px;
    }

    .filter h2 {
        margin-top: 0;
        margin-right: 20px;
    }

    .filter-item {
        margin-bottom: 10px;
        margin-right: 20px;
    }

    .filter-item label {
        font-weight: bold;
    }

    .filter-item select {
        padding: 5px;
        border-radius: 5px;
        border: none;
        width: 200px;
    }

    .filter-button {
        display: block;
        width: 150px;
        padding: 10px;
        background-color: #12b886;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .filter-button:hover {
        background-color: #0a7d5d;
    }
</style>
<!-- Main -->
<main>
    <h1>Danh sách sản phẩm</h1>
    <form action="{{ route('filter.products') }}" method="POST">
        @csrf
        <div class="filter">
            <h3>Danh mục</h3>
            <div class="filter-item">
                <label for="category_id">Danh mục:</label>
                <select id="category_id" name="category_id">
                    <option value="all">Tất cả</option>
                    @foreach($products->unique('category_id') as $product)
                    <option value="{{ $product->category_id }}">{{ $product->category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-item">
                <label for="price">Giá:</label>
                <select id="price" name="price">
                    <option value="all">Tất cả</option>
                    <option value="duoi_100k">Dưới 100.000 VND</option>
                    <option value="giua_100_500k">Từ 100.000 - 500.000 VND</option>
                    <option value="tren_500k">Trên 500.000 VND</option>
                </select>
            </div>
            <div class="filter-item">
                <label for="status">Trạng thái:</label>
                <select id="status" name="status">
                    <option value="all">Tất cả</option>
                    @foreach($products->unique('status') as $product)
                    <option value="{{ $product->status }}">{{ $product->status }}</option>
                    @endforeach
                </select>
            </div>
            <button class="filter-button" type="submit">Lọc sản phẩm</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Tên người bán</th>
                <th>Mô tả sản phẩm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filteredProducts ?? $products as $product)
            <tr>
                <td>{{$product->product_id}}</td>
                <td><img src="{{ asset($product->product_photo) }}" alt="Ảnh sản phẩm" width="100"></td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->status}}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                <td>{{$product->category->category_name}}</td>
                <td>{{$product->user->user_name }}</td>
                <td>{{$product->product_detail}}</td>
                <td>
                    <a class="edit-button" href="{{ route('product.update', ['product_id' => $product->product_id]) }}"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('product.deleteProduct', ['id' => $product->product_id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="main-buttons">
        <a class="add-product-button" href="{{ route('product.addProduct') }}">Thêm sản phẩm</a>
        <a class="add-voucher-button" href="#">Thêm voucher</a>
    </div>

    <!-- Phân trang  -->
    @if($numberOfPage > 1)
    <div class="d-flex justify-content-center align-items-center my-2">
        @if($pageIndex > 1)
        <a class="btn btn-success" href="{{route('product.productManagement', ['pageIndex' => $pageIndex - 1])}}">Trước</a>
        @endif
        @for($i = 1; $i <= $numberOfPage; $i++) @if($i==$pageIndex) <a class="btn btn-primary ms-2" href="{{route('product.productManagement', ['pageIndex' => $i])}}">{{$i}}</a>
            @else
            @if($i == 1 || $i == $numberOfPage || ($i <= $pageIndex + 4 && $i>= $pageIndex - 4))
                <a class="btn btn-success ms-2" href="{{route('product.productManagement', ['pageIndex' => $i])}}">{{$i}}</a>
                @elseif($i == $pageIndex - 5 || $i == $pageIndex + 5)
                <a class="btn btn-success ms-2" href="{{route('product.productManagement', ['pageIndex' => $i])}}">...</a>
                @endif
                @endif
                @endfor
                @if($pageIndex < $numberOfPage) <a class="btn btn-success ms-2" href="{{route('product.productManagement', ['pageIndex' => $pageIndex + 1])}}">Sau</a>
                    @endif
    </div>
    @endif

</main>

<!-- Footer -->
@endsection