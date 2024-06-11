<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;

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
}
