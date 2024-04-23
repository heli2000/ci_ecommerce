<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AddEditCategory extends BaseController
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

    public function index($id = null)
    {
        $category_data = [];

        if ($id) {
            try {
                $category_id = $this->encrypter->decrypt(decodeURL($id));
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }

            $category_data = $this->categoryModel->find($category_id);
        }

        $data = [
            'category_list' => $this->list,
            'validation' => $this->validation,
            'category_data' => $category_data,
            'url' => $id ? '/admin/category/edit/' . $id : '/admin/category/add',
        ];

        return view("Category\add_category", $data);
    }

    public function addEditCategory($id = null)
    {
        $post_data = $this->request->getPost();
        $editImageFlag = false;

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
            return view('Category\add_category', ['category_list' => $this->list, 'validation' => $this->validation,  'url' => $id ? '/admin/category/edit/' . $id : '/admin/category/add']);
        }
        if ($id) {
            try {
                $category_id = $this->encrypter->decrypt(decodeURL($id));
                $data = $this->categoryModel->find($category_id);
                $editImageFlag = $data['image'] && $data['image'] != '' ? true : false;
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }
        }


        if ($file->isValid() && !$file->hasMoved()) {
            $path = WRITEPATH . 'uploads\category';
            $file->move($path);
            $fileName = $file->getName();
            $category_data['image'] = 'category/' . $fileName;
        } else if ($editImageFlag == false) {
            $this->validation->setError('category_image', 'Category Image is required');
            return view('Category\add_category', ['category_list' => $this->list, 'validation' => $this->validation, 'url' => $id ? '/admin/category/edit/' . $id : '/admin/category/add']);
        }

        if ($id) {
            try {
                $this->categoryModel->set('name', $category_data['name']);
                $this->categoryModel->set('description_one_line', $category_data['description_one_line']);
                $this->categoryModel->set('description_detail', $category_data['description_detail']);
                $this->categoryModel->set('parent_category_id', $category_data['parent_category_id']);
                key_exists('image', $category_data) && $this->categoryModel->set('image', $category_data['image']);
                $this->categoryModel->where('id', $category_id);
                $this->categoryModel->update();
            } catch (\Exception $e) {
                log_message('error', 'Error Editing category: ' . $e->getMessage());
                throw new PageNotFoundException($e);
            }
            session()->setFlashdata('message', 'Category Edited Successfully');
            return redirect()->to(base_url('/admin/category/edit/' . $id));
        } else {
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
        }
    }

    public function deleteCategory()
    {
        $post_data = $this->request->getPost();
        if ($post_data) {
            try {
                $category_id = $this->encrypter->decrypt(decodeURL(urldecode($post_data['delete_id'])));
                $this->categoryModel->where('id', $category_id)->delete();
                return redirect()->to(base_url('/admin/category/get'));
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }
        }
    }
}
