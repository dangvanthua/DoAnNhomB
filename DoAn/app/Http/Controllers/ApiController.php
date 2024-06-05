<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function responeJson($data)
    {
        $result = [
            'status' => true,
            'message' => 'Trả về dữ liệu thành công',
            'data' => $data
        ];

        return $result;
    }

    public function ajaxSearch()
    {
        $data = Product::search()->get();
        return $this->responeJson($data);
    }
}
