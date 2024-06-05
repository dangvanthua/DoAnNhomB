<header class="header">
    <nav class="nav-prefix">
        <a href="{{asset('home')}}" class="nav-logo-prefix">
            <img class="logo-img" src="{{asset('images/logo.png')}}" alt="Logo Shop">
        </a>

        <div class="nav-menu-prefix">
            <ul class="nav-list-prefix">
                <li class="nav-item-prefix"><a href="{{asset('home')}}" class="nav-link-prefix">Trang chủ</a></li>
                <li class="nav-item-prefix"><a href="{{asset('products')}}" class="nav-link-prefix">Sản phẩm</a></li>
                <li class="nav-item-prefix"><a href="#" class="nav-link-prefix">Tiện ích</a></li>
                <li class="nav-item-prefix"><a href="#" class="nav-link-prefix">Liên hệ</a></li>
            </ul>
        </div>

        <div class="form-search">
            <div class="nav-search-prefix">
                <input type="text" placeholder="Tìm kiếm sản phẩm" class="form-input-prefix input-search-ajax"/>
                <button class="search-btn-prefix">
                    <i class="search-icon fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
             <ul class="list-group position-absolute list-group-result" style="width: 350px;">
               
            </ul>
        </div>

        <div class="nav-user-action-prefix">
            <a href="{{route('account')}}"><i class="user-icon fa-solid fa-user"></i></a>
            <a href="{{route('products.cart')}}"><i class="cart-icon fa-solid fa-cart-shopping"></i></i></a>
        </div>
    </nav>
</header>