<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::create([
        //     'category_name' => 'Quần áo',
        //     'description' => 'Danh mục dành cho mọi loại quần áo cả nam, nữ và em bé',
        // ]);

        Category::create([
            'category_name' => 'Điện tử',
            'description' => 'Danh mục dành cho các thiết bị điện tử ti vi, máy tính, điện thoại...',
        ]);
    }
}
