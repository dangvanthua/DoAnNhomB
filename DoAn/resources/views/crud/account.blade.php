@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3" style="height: 100vh">
                <div class="p-4 side-bar-info">
                    <div class="d-flex">
                        <img class="round-img" src="{{asset('images/logo.png')}}" alt="User name">
                        <div class="account-info">
                            <h4 class="account-username">username</h4>
                            <span class="account-edit"><i class="fa-regular fa-pen-to-square"></i> Sửa hồ sơ</span>
                        </div>
                     </div>

                    <div class="info-option">
                        <ul class="option-list">
                            <li><a href="#" class="option-list-item"><i class="fa-regular fa-user" style="font-size: 22px; color: #333"></i> Tài khoản của tôi</a></li>
                            <li><a href="{{ route('orders.history') }}" class="option-list-item"><img src="{{asset('images/note.png')}}" style="width: 24px" alt=""> Đơn mua</a></li>
                            <li><a href="#" class="option-list-item"><img src="{{asset('images/notice.png')}}" style="width: 22px" alt=""> Thông báo</a></li>
                            <li><a href="{{ route('product.productManagement') }}" class="option-list-item"><i class="fa-solid fa-bag-shopping" style="font-size: 24px; color: #333"></i> Bán hàng</a></li>
                            <li><a href="#" class="option-list-item"><i class="fa-solid fa-list" style="font-size: 22px; color: #333"></i> Sản phẩm đang bán</a></li>
                            @if(session('user')[0] == 1)
                            <li><a href="{{ route('user.list') }}" class="option-list-item"><i class="fa-solid fa-hand-holding-droplet" style="font-size: 22px; color: #333"></i>Phân quyền</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}" class="option-list-item"><i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 22px; color: #333"></i>Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="text-center info-profile">
                    <h3>Hồ sơ của tôi</h3>
                    <span>Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                </div>

                <div class="info-edit mt-4 d-flex justify-content-center">
                    <form action="" method="POST" class="form-info">
                        @csrf
                        <div class="info-edit-group">
                            <h4>Tên đăng nhập</h4>
                            <span>username</span>
                        </div>
                        <div class="info-edit-group">
                            <h4>Họ tên</h4>
                            <input type="text" name="name" class="info-input-name">
                        </div>
                        <div class="info-edit-group">
                            <h4>Email</h4>
                            <span>username@gmail.com</span>
                            <a href="#">Thay đổi</a>
                        </div>
                        <div class="info-edit-group">
                            <h4>Số điện thoại</h4>
                            <span>012345789</span>
                            <a href="#">Thay đổi</a>
                        </div>
                        <div class="info-edit-group">
                            <h4>Giới tính</h4>
                            <div class="info-radio">
                                <div class="form-check">
                                    <label class="form-check-label" for="radio1">male</label>
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="option1" checked>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="radio2">female</label>
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="option2">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="radio3">other</label>
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="option3">
                                </div>
                            </div>
                        </div>
                        <div class="info-edit-group">
                            <h4>Ngày sinh</h4>
                            <div class="info-date">
                                <div class="form-group">
                                    <select class="form-control" id="ngay" name="ngay">
                                        <option value="">Chọn ngày</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="thang" name="month">
                                        <option value="">Chọn tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">Tháng {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="nam" name="year">
                                        <option value="">Chọn năm</option>
                                        @php
                                            $currentYear = date("Y");
                                        @endphp
                                        @for ($i = $currentYear; $i >= 1900; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="info-edit-group">
                            <h4>Hình ảnh</h4>
                            <input type="file" name="image">
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
