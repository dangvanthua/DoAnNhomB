<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Voucher::create([
            'voucher_name' => 'Discount10',
            'voucher_quantity' => 100,
            'voucher_detail' => '10% off on all products',
            'discount_percentage' => 10.00,
            'begin_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
        ]);

        Voucher::create([
            'voucher_name' => 'SummerSale',
            'voucher_quantity' => 50,
            'voucher_detail' => '15% off on summer collection',
            'discount_percentage' => 15.00,
            'begin_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
        ]);

        Voucher::create([
            'voucher_name' => 'BlackFriday',
            'voucher_quantity' => 200,
            'voucher_detail' => '20% off on Black Friday',
            'discount_percentage' => 20.00,
            'begin_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth(),
        ]);

    }
}
