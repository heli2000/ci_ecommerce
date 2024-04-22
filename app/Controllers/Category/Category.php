<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use App\Models\Category\Category as CategoryModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function category_list($perPage = 10)
    {
        $searchVal = "";

        if ($this->request->getVar('perPage')) {
            $perPage = $this->request->getVar('perPage');
        }

        if ($this->request->getVar('category_search')) {
            $searchVal = $this->request->getVar('category_search');
            $this->categoryModel->like('category.name', $searchVal);
            $this->categoryModel->orWhere('category.description_one_line', $searchVal);
            $this->categoryModel->orWhere('parent.name', $searchVal);
        }

        $query = $this->categoryModel
            ->select('category.id, category.name, category.parent_category_id, category.sorting_order, category.description_one_line, parent.name AS parent_name')
            ->join('category AS parent', 'parent.id = category.parent_category_id', 'left')
            ->orderBy('category.sorting_order', 'ASC');


        $result = $query->paginate($perPage);

        $data = [
            'category_data' => $result,
            'pager' => $query->pager,
            'perPageItem' => count($result),
            'perPage' => $perPage,
            'total' => $query->countAllResults(),
            'searchVal' => $searchVal,
            'encrypter' => $this->encrypter
        ];

        return view('Category\list_category', $data);
    }

    public function export_category()
    {
        $data = $this->categoryModel
            ->select('category.id, category.name, category.parent_category_id, category.sorting_order, category.description_one_line, parent.name AS parent_name')
            ->join('category AS parent', 'parent.id = category.parent_category_id', 'left')
            ->orderBy('category.sorting_order', 'ASC')
            ->findAll();

        $file_name = 'Category.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Categories');
        $sheet->setCellValue('B1', 'Description');
        $sheet->setCellValue('C1', 'Parent Category Name');
        $count = 2;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['name']);
            $sheet->setCellValue('B' . $count, $row['description_one_line']);
            $sheet->setCellValue('C' . $count, $row['parent_name']);
            $count++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));
        flush();
        readfile($file_name);

        exit;
    }
}
