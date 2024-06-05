<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $primaryKey = 'voucher_id';

    protected $fillable = [
        'voucher_name',
        'voucher_quantity',
        'voucher_detail',
        'discount_percentage',
        'begin_date',
        'end_date',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'voucher_id', 'voucher_id');
    }

}
