<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function category_list()
    {
        $category_data = $this->categoryModel->getAllCategories();
        return view('Category\list_category', ['category_data' => $category_data]);
    }
}
