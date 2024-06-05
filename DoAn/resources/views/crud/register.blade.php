@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 ms-auto me-1 border border-dark rounded">
                    <img src="{{ asset('images/logo.jpg') }}" alt="logo">
                </div>
                <div class="col-md-5 ms-1 me-auto border border-dark rounded">
                    <h2 class="text-center">Đăng ký</h2>
                    <form action="{{ route('post.register') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="user_name" id="user_name" placeholder="Nhập tài khoản" class="form-control" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="retype" id="retype" placeholder="Nhập lại mật khẩu" class="form-control" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="full_name" id="full_name" placeholder="Nhập họ và tên" class="form-control" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại" class="form-control" autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" placeholder="Nhập email"  class="form-control" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="radio" name="sex" id="male" value="male" class="me-1" checked>
                            <label for="male" class="me-2">Nam</label>
                            <input type="radio" name="sex" id="female" value="female" class="me-1">
                            <label for="female">Nữ</label>
                        </div>

                        <div class="input-group mb-3">
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                        </div>

                        <div class="input-group mb-3">
                            <input type="file" name="user_image" id="user_image" class="form-control" required>
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn-login">Đăng ký</button>
                        </div>
                    </form>
                    <h3 class="hr-lines my-3">Hoặc</h3>
                    <div class="text-center">Bạn đã có tài khoản? <a class="text-decoration-none"
                            href="{{ route('login') }}">Đăng nhập</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
