<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_photo',
        'product_detail',
        'quantity',
        'status',
        'price',
        'category_id',
        'user_id',
        'voucher_id'
    ];

    public function scopeSearch($query)
    {
        if (request('key')) {
            $key = request('key');
            $query = $query->where('product_name', 'like', '%' . $key . '%')->orWhereHas('category', function ($query) use ($key) {
                $query->where('category_name', 'like', '%' . $key . '%');
            });;
        }

        if (request('cat_id')) {
            $query = $query->where('category_id', request('cat_id'));
        }

        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'voucher_id');
    }

    public function cartItem()
    {
        return $this->hasOne(CartItem::class, 'product_id', 'product_id');
    }
}

