<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;


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

        $hierarchicalCategories = buildHierarchy($category_data);

        return view('Category\arrange_category', ['category_data' => $hierarchicalCategories]);
    }

    public function update_category_sequence()
    {
        $data = $this->request->getPost('sequence_obj');
        $array = json_decode($data, true);

        if ($array && count($array)) {
            $output = rearrangeCategories($array);

            try {
                foreach ($output as  $value) {
                    $this->categoryModel->set('parent_category_id', $value['parent_id']);
                    $this->categoryModel->set('sorting_order', $value['weight']);
                    $this->categoryModel->where('id', $value['id']);
                    $this->categoryModel->update();
                }
            } catch (\Exception $e) {
                log_message('error', 'Error updating category: ' . $e->getMessage());
                throw new PageNotFoundException('An error occurred while adding the category. Please try again later.');
            }
        }
        return redirect()->to(base_url('/admin/category/arrange'));
    }
}
