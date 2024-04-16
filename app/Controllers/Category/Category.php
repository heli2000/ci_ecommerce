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

    public function category_list($perPage = 2)
    {

        if ($this->request->getVar('perPage')) {
            $perPage = $this->request->getVar('perPage');
        }

        $query = $this->categoryModel
            ->select('category.id, category.name, category.parent_category_id, category.sorting_order, category.description_one_line, parent.name AS parent_name')
            ->join('category AS parent', 'parent.id = category.parent_category_id', 'left')
            ->orderBy('category.sorting_order', 'ASC');

        return view('Category\list_category', ['category_data' => $query->paginate($perPage), 'pager' => $query->pager,]);
    }
}
