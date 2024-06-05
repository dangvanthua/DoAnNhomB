@extends('layout')

@section('title', 'Checkout')

@section('content')

<!-- Main -->
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

    .container {
        display: flex;
        justify-content: space-between;
    }

    .left-sidebar {
        width: 25%;
        padding: 20px;
        background-color: #f1f1f1;
        text-align: center;
    }

    .left-sidebar h2 {
        margin-bottom: 10px;
    }

    .left-sidebar .logo {
        width: 200px;
        height: auto;
        margin-bottom: 20px;
    }

    .left-sidebar input[type="file"] {
        margin-bottom: 20px;
    }

    .content {
        width: 70%;
        padding: 20px;
        background-color: #fff;
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

    button[type="button-add"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #12b886;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="button-add"]:hover {
        background-color: #0069d9;
    }
</style>
<main>
    <div class="container">
        <div class="left-sidebar">
            <h2>Chọn ảnh sản phẩm</h2>
            <img id="product_photo" class="logo" src="{{ asset('img/logoChoNho.jpg') }}" alt="Logo Chợ Nhỏ" />
        </div>
        <div class="content">
            <h1>Thêm Sản Phẩm</h1>

            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Tên sản phẩm -->
                <div class="form-group">
                    <label for="product_name">Tên Sản Phẩm:</label>
                    <input type="text" id="product_name" name="product_name" required autofocus>
                    @error('product_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Ảnh sản phẩm -->
                <div class="form-group">
                    <label for="product_name">Ảnh Sản Phẩm:</label>
                    <input id="product_photo" type="file" class="form-control @error('product_photo') is-invalid @enderror" name="product_photo" required autocomplete="product_photo" onchange="previewImage(event)">
                    @error('product_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Số lượng -->
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" min="0" required autofocus>
                    @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Trạng thái -->
                <div class="form-group">
                    <label for="status">Trạng thái:</label>
                    <select id="status" name="status" disabled>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Giá sản phẩm -->
                <div class="form-group">
                    <label for="price">Giá Sản Phẩm:</label>
                    <input type="number" id="price" name="price" min="0" required autofocus>
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Mô tả -->
                <div class="form-group">
                    <label for="product_detail">Mô tả:</label>
                    <textarea id="product_detail" name="product_detail" required autofocus></textarea>
                    @error('product_detail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Mã danh mục -->
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Mã người dùng -->
                <div class="form-group">
                    <label for="user_id">Người bán</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Chọn người bán</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->user_id }}">{{ $user->user_name }} - {{ $user->user_id }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">Thêm</button>
            </form>
        </div>
    </div>
</main>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('product_photo');
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