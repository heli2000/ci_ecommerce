<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;

class ArrangeCategory extends BaseController
{

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $category_data = $this->categoryModel->getCategoryListWithParentId();

        $parentCategories = [];
        $childCategories = [];

        foreach ($category_data as $category) {
            if ($category->parent_category_id == 0) {
                $parentCategories[$category->id] = $category;
            } else {
                $childCategories[$category->parent_category_id][] = $category;
            }
        }

        foreach ($parentCategories as $parentId => $parentCategory) {
            if (isset($childCategories[$parentId])) {
                $parentCategories[$parentId]->children = $childCategories[$parentId];
            }
        }

        $hierarchicalCategories = array_values($parentCategories);

        return view('Category\arrange_category', ['category_data' => $hierarchicalCategories]);
    }

    public function update_category_sequence()
    {
        exit("here");
    }
}
