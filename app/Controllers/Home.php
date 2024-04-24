<?php

namespace App\Controllers;

use App\Models\Category\Category as CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index(): string
    {
        try {
            $category_data = $this->categoryModel->getCategoryListForMenu();
            $hierarchicalCategories = buildHierarchy($category_data);

            $all_category_data  = $this->categoryModel->getCategoryListWithParentId();
        } catch (\Exception $e) {
            log_message('error', 'Error inserting category: ' . $e->getMessage());
            throw new PageNotFoundException('An error occurred while adding the category. Please try again later.');
        }

        $data = [
            'category_list' => $hierarchicalCategories,
            'all_category_data' => $all_category_data
        ];

        return view('Dashboard/index', $data);
    }
}
