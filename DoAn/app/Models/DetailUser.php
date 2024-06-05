<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_user_id';

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'address',
        'phone_number',
        'sex',
        'user_image',
        'full_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
