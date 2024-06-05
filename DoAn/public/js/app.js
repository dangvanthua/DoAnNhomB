const token = document.head.querySelector('meta[name="csrf-token"]');
const products = document.querySelectorAll('.card-image');

products.forEach(product => {
    const productId = product.getAttribute('data-product-id');
    product.addEventListener('click', function () {
        getProductDetail(Number.parseInt(productId));
    });
})

async function getProductDetail(id) {
    const url = routes.productDetail.replace(':productId', id);
    try {
        const response = await fetch(url);
        if (response.ok) {
            window.location.href = url;
        } else {
            console.error('Đã có lỗi khi lấy thông tin sản phẩm');
        }
    } catch (error) {
        console.error('Đã có lỗi khi gửi yêu cầu lấy thông tin sản phẩm:', error);
    }
}