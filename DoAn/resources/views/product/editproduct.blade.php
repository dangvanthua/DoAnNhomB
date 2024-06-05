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

    /* edit product */
    .container {
        display: flex;
        justify-content: space-between;
    }

    .content {
        width: 70%;
        padding: 20px;
        margin: 0 auto;
        background-color: #f2f2f2;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button[type="button"] {
        display: block;
        width: 100px;
        padding: 10px;
        background-color: #12b886;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="button"]:hover {
        background-color: #0069d9;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .save-button,
    .delete-button {
        padding: 8px 16px;
        font-size: 14px;
    }

    .product-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 150px;
        margin-bottom: 20px;
        position: relative;
    }

    .product-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.2);
    }
</style>
<!-- Main -->
<main>
    <div class="container">
        <div class="content">
            <h1>Sửa Sản Phẩm</h1>
            <form action="{{ route('product.update', ['product_id' => $product->product_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tên sản phẩm -->
                <div>
                    <label for="product_id">Mã sản phẩm:</label>
                    <input type="text" id="product_id" name="product_id" value="{{$product->product_id}}" readonly>
                </div>
                <!-- Tên sản phẩm -->
                <div>
                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" id="product_name" name="product_name" value="{{$product->product_name}}">
                </div>
                <!-- Số lượng -->
                <div>
                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" value="{{$product->quantity}}">
                </div>
                <!-- Trạng thái -->
                <div>
                    <label for="status">Trạng thái:</label>
                    <select id="status" name="status">
                        <option value="active" {{$product->status == 'active' ? 'selected' : ''}} {{ $product->quantity <= 0 ? 'disabled' : '' }}>active</option>
                        <option value="inactive" {{$product->status == 'inactive' ? 'selected' : ''}} {{ $product->quantity <= 0 ? 'disabled' : '' }}>inactive</option>
                    </select>
                </div>
                <!-- Giá -->
                <div>
                    <label for="price">Giá:</label>
                    <input type="text" id="price" name="price" value="{{$product->price}}">
                </div>
                <!-- Mã danh mục -->
                <div>
                    <label for="category_id">Danh mục:</label>
                    <select id="category_id" name="category_id">
                        @foreach($categories as $category)
                        <option value="{{$category->category_id}}" {{$product->category_id == $category->category_id ? 'selected' : ''}}>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Mô tả sản phẩm -->
                <div>
                    <label for="product_detail">Mô tả sản phẩm:</label>
                    <textarea id="product_detail" name="product_detail">{{$product->product_detail}}</textarea>
                </div>
                <!-- Người đăng -->
                <div>
                    <label for="user_id">Người đăng:</label>
                    <input id="user_id" name="user_id" value="{{$product->user_id}}" readonly></input>
                </div>
                <!-- Hình ảnh -->
                <div>
                    <label for="product_photo">Ảnh sản phẩm:</label>
                    <div class="product-image-container">
                        <img id="product_photo_preview" src="{{ asset('uploads/images/' . $product->product_photo) }}" alt="Ảnh sản phẩm" class="product-image">
                    </div>
                    <input id="product_photo_input" type="file" class="form-control @error('product_photo') is-invalid @enderror" name="product_photo" required autocomplete="product_photo" onchange="previewProductPhoto(event)">
                </div>
                <button type="submit">Lưu</button>
            </form>
        </div>

    </div>
</main>

<script>
    function previewProductPhoto(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('product_photo_preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('quantity').addEventListener('input', function() {
        var quantity = document.getElementById('quantity').value;
        var status = document.getElementById('status');
        if (quantity > 0) {
            status.value = 'active';
        } else {
            status.value = 'inactive';
        }
    });
</script>

@endsection