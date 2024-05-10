<?php

namespace App\ViewModels;

use App\Models\Category\Category as CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SharedData
{
    public $categoryModel;
    public $categoryData;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();

        try {
            $category_data = $this->categoryModel->getCategoryListForMenu();
            $hierarchicalCategories = buildHierarchy($category_data);
        } catch (\Exception $e) {
            log_message('error', 'Error inserting category: ' . $e->getMessage());
            throw new PageNotFoundException('An error occurred while adding the category. Please try again later.');
        }

        $this->categoryData =  $hierarchicalCategories;
    }
}
