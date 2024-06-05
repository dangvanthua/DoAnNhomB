<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/account.css')}}">
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/detail.css')}}">
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
    <link rel="stylesheet" href="{{asset('css/order.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('css/tat.css')}}"> -->
    <script src="https://cdn.jsdelivr.net/npm/mark.js@8.11.1/dist/mark.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title', 'Document')</title>
</head>
<body>
    @include('includes.header')
    @yield('content')
    @include('includes.footer')
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paymentMethodRadio = document.querySelectorAll('input[name="payment-method"]');
        var cardInfoDiv = document.getElementById('card-info');

        for (var i = 0; i < paymentMethodRadio.length; i++) {
            paymentMethodRadio[i].addEventListener('change', function() {
                if (this.value === 'card') {
                    cardInfoDiv.style.display = 'block';
                } else {
                    cardInfoDiv.style.display = 'none';
                }
            });
        }
    });

    $(document).ready(function() {
        var debounceTimer;

          function debounce(func, delay) {
            return function() {
                var context = this, args = arguments;
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    func.apply(context, args);
                }, delay);
            };
        }

        function truncateText(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        }

        function formatPrice(price) { 
            price = parseFloat(price);
            return price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        }

        function searchProducts() {
            var _text = $('.input-search-ajax').val().trim();

            // Kiểm tra nếu input trống
            if (_text === '') {
                $('.list-group-result').html(''); 
                return;
            }

            $.ajax({
                url: '/api/ajax-search-product',
                method: 'GET',
                data: {
                    key: _text
                },
                success: function(res) {
                    var _html = '';
                    var data = res.data;
                    var maxLength = 20;

                    data.forEach(function(product) {
                        var formattedPrice = formatPrice(product.price);
                         if (typeof product.product_name === 'string') {
                            var truncatedName = truncateText(product.product_name, maxLength);
                            var productImagePath = '{{ asset('') }}' + product.product_photo;

                            _html += '<li class="list-group-item d-flex gap-3" data-product-id="' + product.product_id + '">';
                            _html += '<img src="' + productImagePath + '" alt="" style="width: 50px;">';
                            _html += '<div class="list-item-info">';
                            _html += '<h4 class="info-name">' + truncatedName + '</h4>';
                            _html += '<span class="info-price">' +  formattedPrice + '</span>';
                            _html += '</div>';
                            _html += '</li>';
                        } else {
                            console.error('Invalid product name:', product.product_name);
                        }
                    });
                    $('.list-group-result').html(_html);
                    var instance = new Mark($('.list-group-result').get(0));
                        instance.mark(_text, {
                        separateWordSearch: false
                    });
                }
            });
            }

            $(document).on('click', '.list-group-item', function() {
                var productId = $(this).data('product-id');
                window.location.href = '/product-detail/' + productId; 
            });

            $('.input-search-ajax').keypress(function(event) {
                if(event.which === 13) {
                    event.preventDefault();
                    redirectToSearch();
                }
            });

            $('.search-btn-prefix').on('click', function(event){
                event.preventDefault();
                redirectToSearch();
            });

            function redirectToSearch(){
                var searchQuery = $('.input-search-ajax').val().trim();
                if(searchQuery !== ''){
                    window.location.href = '/product-search?key=' + encodeURIComponent(searchQuery);
                }
            }

            $('.input-search-ajax').on('input', debounce(searchProducts, 300));

      
            $('.increment, .decrement').click(function(e) {
                e.preventDefault();
            
                var button = $(this);
                var oldValue = parseInt(button.closest('.quantity-selector').find('.quantity-input').val());
                var maxValue = parseInt(button.closest('.quantity-selector').find('.quantity-input').attr('max'));
                var productId = button.closest('.product-item').data('product-id');
                var newValue = oldValue;

                if(button.hasClass('increment')) {
                    if(newValue >= maxValue) {
                        return;
                    }else {
                        newValue += 1;
                    }
                }else {
                    if(oldValue > 1) {
                        newValue -= 1;
                    }
                }

                $.ajax({
                    url: '{{route("cart.update")}}',
                    method: 'POST',
                    data: {
                         _token: '{{csrf_token()}}',
                        productId: productId,
                        quantity: newValue
                    },
                    success: function(res) {
                        if(res.success) {
                            // cap nhat lai so luong va san pham cua san pham
                            button.closest('.quantity-selector').find('.quantity-input').val(newValue);
                            button.closest('.product-item').find('.total-price').text(res.pricePerProduct);

                            // cap nhat lai tong so luong va tong gia cua gio hang
                            $('span.total-quantity').text(res.totalQuantity);
                            $('span.total-price').text(res.totalPrice);
                        }
                    }
                });
            });
    });

    $(document).on('click', '.btn-delete', function() {
        var productId = $(this).closest('.product-item').data('product-id');
        var row = $(this).closest('tr');

        $.ajax({
            url: '{{route("cart.delete")}}',
            method: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                product_id: productId
            },
            success: function(res) {
                if(res.success) {
                    $('span.total-quantity').text(res.totalQuantity);
                    $('span.total-price').text(res.totalPrice);
                    row.remove();   
                }
            }
        });
    });

    const btnPurchase = document.querySelector('.purchase-action .btn-pucharse');

    if (btnPurchase) {
        btnPurchase.addEventListener('click', function() {
            const quantity = document.querySelector('.quantity-input').value;
            const selectedProducts = [];
            const selectedQuantities = {};

            const checkboxes = document.querySelectorAll('.product-checkbox:checked');

            checkboxes.forEach(checkbox => {
                const quantityInput = checkbox.closest('.product-item').querySelector('.quantity-input');
                const quantity = parseInt(quantityInput.value);
                const productId = checkbox.value;
                selectedProducts.push(productId);
                selectedQuantities[productId] = quantity;
            });

            $.ajax({
                url: '{{route("products.checkout")}}',
                method: 'POST',
                data: { 
                    _token: '{{csrf_token()}}',
                    products: JSON.stringify(selectedProducts), 
                    quantities: JSON.stringify(selectedQuantities) 
                },
                success: function(res) {      
                    window.location.href = '/checkout-detail';
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi mua hàng, vui lòng mua lại');
                }
            });
        });
    }
        
</script>
</body>
</html>