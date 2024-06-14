<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Variant extends BaseController
{
    public function index($perPage = 10)
    {

        $searchVal = "";

        if ($this->request->getVar('perPage')) {
            $perPage = $this->request->getVar('perPage');
        }

        if ($this->request->getVar('variant_search')) {
            $searchVal = $this->request->getVar('variant_search');
            $this->variantModel->like('name', $searchVal);
            $this->variantModel->orWhere('description', $searchVal);
        }

        $variant_list = $this->variantModel->paginate($perPage);

        $total = $this->variantModel->countAllResults(false);

        $data = [
            'variant_data' => $variant_list,
            'searchVal' => $searchVal,
            'pager' => $this->variantModel->pager,
            'perPageItem' => count($variant_list),
            'perPage' => $perPage,
            'total' => $total,
            'encrypter' => $this->encrypter
        ];

        return view('Product\Variant\list_variants', $data);
    }

    public function add_variant($id = null)
    {
        $variant_data = [];
        $url = '/admin/product/variant';

        if ($id) {
            try {
                $variant_id = $this->encrypter->decrypt(decodeURL($id));
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }

            $variant_data = $this->variantModel->find($variant_id);

            $variant_option = $this->variantOptionModel->getVariantOptionsByVariantId($variant_data['id']);
            $variant_data['variant_option'] = $variant_option;
        }

        $data = [
            'url' => '/admin/product/variant/add',
            'validation' => $this->validation,
            'variant_data' => $variant_data,
            'url' => $id ? $url . '/edit/' . $id : $url . '/add',
        ];

        return view('Product\Variant\add_variants', $data);
    }



    public function add_variant_data($id = null)
    {
        $post_data = $this->request->getPost();
        $url = $id ? '/admin/product/variant/edit/' . $id : '/admin/product/variant/add';

        $variant_data = [
            'name' => $post_data['variant_name'],
            'description' => $post_data['variant_description']
        ];

        $validationRules = [
            'variant_name' => 'required|max_length[200]',
        ];

        if (!$this->validateData($post_data, $validationRules)) {
            $data = ['validation' => $this->validation,  'url' => $url];
            return view('Product\Variant\add_variants', $data);
        }

        if ($id) {
            try {
                $variant_id = $this->encrypter->decrypt(decodeURL($id));
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }
            try {
                $this->variantModel->set('name', $variant_data['name']);
                $this->variantModel->set('description', $variant_data['description']);
                $this->variantModel->where('id', $variant_id);
                $this->variantModel->update();
            } catch (\Exception $e) {
                log_message('error', 'Error Editing variant: ' . $e->getMessage());
                throw new PageNotFoundException($e);
            }
            session()->setFlashdata('message', 'Category Edited Successfully');
            return redirect()->to(base_url($url));
        } else {
            try {
                $this->variantModel->insert($variant_data);
            } catch (\Exception $e) {
                log_message('error', 'Error inserting variant: ' . $e->getMessage());
                throw new PageNotFoundException('An error occurred while adding the variant. Please try again later.');
            }

            $insert_id = $this->variantModel->insertID();

            foreach ($post_data['select-tag'] as $value) {
                $optionData = [
                    'name' => $value,
                    'variant_id' => $insert_id
                ];
                $this->variantOptionModel->insert($optionData);
            }

            session()->setFlashdata('message', 'Variant Added Successfully');
            return redirect()->to(base_url($url));
        }
    }

    public function deleteVariant()
    {
        $post_data = $this->request->getPost();
        if ($post_data) {
            try {
                $variant_id = $this->encrypter->decrypt(decodeURL(urldecode($post_data['delete_id'])));
                $this->variantModel->where('id', $variant_id)->delete();
                $this->variantOptionModel->where('variant_id', $variant_id)->delete();
                return redirect()->to(base_url('/admin/product/variant/get'));
            } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $e) {
                echo 'Decryption error: ' . $e->getMessage();
                exit;
            }
        }
    }
}
