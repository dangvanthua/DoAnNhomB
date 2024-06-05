@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="content my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 ms-auto me-1 border border-dark">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </div>
            <div class="col-md-5 me-auto ms-1 border border-dark">
                <h2 class="text-center">Đăng nhập</h2>
                <form action="{{ route('auth.user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="email" id="email" placeholder="Nhập tài khoản" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control" required autofocus>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn-login">Đăng nhập</button>
                    </div>
                </form>
                <h3 class="hr-lines my-3">Hoặc</h3>
                <div class="text-center">Bạn chưa có tài khoản? <a class="text-decoration-none" href="{{ route('register') }}">Đăng ký</a></div>
            </div>
        </div>
    </div>
</div>
@endsection