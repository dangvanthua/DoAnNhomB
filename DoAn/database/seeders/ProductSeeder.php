<?php

namespace Database\Seeders;


use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_name' => 'Áo khoác gió nam-nữ 2 lớp, Áo khoác dù chất liệu vải gió cao cấp kháng nước full tem tag phụ kiện',
            'product_photo' => 'uploads/images/f6.jpg',
            'product_detail' => 'Product 1 detail',
            'quantity' => 10,
            'status' => 'active',
            'price' => 100.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Áo Hoodie thêu chữ basic nam nữ unisex form rộng mặc cực đẹp, chất nỉ cotton Hàn cao cấp, hợp mọi thời đại',
            'product_photo' => 'uploads/images/f7.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Áo khoác gió nam-nữ 2 lớp, Áo khoác dù chất liệu vải gió cao cấp kháng nước full tem tag phụ kiện',
            'product_photo' => 'uploads/images/f8.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Áo Hoodie thêu chữ basic nam nữ unisex form rộng mặc cực đẹp, chất nỉ cotton Hàn cao cấp, hợp mọi thời đại',
            'product_photo' => 'uploads/images/f9.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Áo khoác gió nam-nữ 2 lớp, Áo khoác dù chất liệu vải gió cao cấp kháng nước full tem tag phụ kiện',
            'product_photo' => 'uploads/images/n1.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Áo khoác gió nam-nữ 2 lớp, Áo khoác dù chất liệu vải gió cao cấp kháng nước full tem tag phụ kiện',
            'product_photo' => 'uploads/images/n2.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Áo khoác gió nam-nữ 2 lớp, Áo khoác dù chất liệu vải gió cao cấp kháng nước full tem tag phụ kiện',
            'product_photo' => 'uploads/images/n3.jpg',
            'product_detail' => 'Product 2 detail',
            'quantity' => 20,
            'status' => 'active',
            'price' => 200.00,
            'category_id' => 1,
            'user_id' => 1,
            'voucher_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Iphone 15',
            'product_photo' => 'uploads/images/e2.jpg',
            'product_detail' => 'Sản phẩm ra mắt năm 2023',
            'quantity' => 15,
            'status' => 'active',
            'price' => 20000000.00,
            'category_id' => 2,
            'user_id' => 3,
            'voucher_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Iphone 12',
            'product_photo' => 'uploads/images/e1.jpg',
            'product_detail' => 'Sản phẩm ra mắt năm 2021',
            'quantity' => 20,
            'status' => 'active',
            'price' => 10400000.00,
            'category_id' => 2,
            'user_id' => 2,
            'voucher_id' => 3,
        ]);

    }
}
