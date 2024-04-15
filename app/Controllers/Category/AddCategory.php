<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AddCategory extends BaseController
{

    protected $list;
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        try {
            $this->list = $this->categoryModel->getCategoryList();
        } catch (\Exception $e) {
            log_message('error', 'Error inserting category: ' . $e->getMessage());
            throw new PageNotFoundException('An error occurred while adding the category. Please try again later.');
        }
    }

    public function index()
    {
        return view("Category\add_category", ['category_list' => $this->list, 'validation' => $this->validation]);
    }

    public function addCategory()
    {
        $post_data = $this->request->getPost();
        $file = $this->request->getFile('category_image');

        $category_data = [
            'name' => $post_data['category_name'],
            'description_one_line' => $post_data['category_one_line_description'],
            'description_detail' => $post_data['category_detailed_description'],
            'parent_category_id' => $post_data['parent_category'],
        ];

        $validationRules = [
            'category_name' => 'required|max_length[200]',
            'category_one_line_description' => 'required|max_length[200]',
            'category_detailed_description' => 'required|max_length[300]',
        ];

        if (!$this->validateData($post_data, $validationRules)) {
            return view('Category\add_category', ['category_list' => $this->list, 'validation' => $this->validation]);
        }
        if ($file->isValid() && !$file->hasMoved()) {
            $path = WRITEPATH . 'uploads\category';
            $file->move($path);
            $fileName = $file->getName();
            $category_data['image'] = 'category/' . $fileName;

            $sort_count = $this->categoryModel->getMaxSortingCount() + 1;
            $category_data['sorting_order'] = $sort_count;

            try {
                $this->categoryModel->insert($category_data);
            } catch (\Exception $e) {
                log_message('error', 'Error inserting category: ' . $e->getMessage());
                throw new PageNotFoundException('An error occurred while adding the category. Please try again later.');
            }
            session()->setFlashdata('message', 'Category Added Successfully');
            return redirect()->to(base_url('/admin/category/add'));
        } else {
            $this->validation->setError('category_image', 'Category Image is required');
            return view('Category\add_category', ['category_list' => $this->list, 'validation' => $this->validation]);
        }
    }
}
