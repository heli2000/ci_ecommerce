<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;

class Product extends BaseController
{
    public function index()
    {
    }

    public function add_product()
    {
        $data = [];
        return view('Product\Product\add_product', $data);
    }
}
