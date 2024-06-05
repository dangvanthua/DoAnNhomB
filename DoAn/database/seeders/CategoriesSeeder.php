<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_name' => 'Thời trang',
            'description' => 'Bán quần áo, giày dép,vv...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Điện tử',
            'description' => 'Đồ công nghệ,...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
