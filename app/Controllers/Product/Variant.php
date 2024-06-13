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

    public function add_variant()
    {
        $data = [
            'url' => '/admin/product/variant/add',
            'validation' => $this->validation
        ];

        return view('Product\Variant\add_variants', $data);
    }

    public function add_variant_data()
    {
        $post_data = $this->request->getPost();
        $url = '/admin/product/variant/add';

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
