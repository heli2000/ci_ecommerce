<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;

class Category extends BaseController
{
    public function index()
    {
    }
    public function addCategoryForm()
    {
        return view("Category/add_category");
    }
}