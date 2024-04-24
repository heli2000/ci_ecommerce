<?php

namespace App\Models\Category;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description_one_line', 'description_detail', 'image', 'parent_category_id', 'sorting_order'];

    protected bool $allowEmptyInserts = false;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCategoryList()
    {
        $query = $this->db->table('category')
            ->select('id, name')
            ->get();

        return $query->getResult();
    }

    public function getCategoryListWithParentId()
    {
        $query = $this->db->table('category')
            ->select('id, name, image, parent_category_id')
            ->orderBy('sorting_order', 'ASC')
            ->get();

        return $query->getResult();
    }

    public function getCategoryListForMenu()
    {
        // Retrieve the first 5 category IDs where the parent category ID is null
        $queryIds = $this->db->table('category')
            ->select('id')
            ->where('parent_category_id', 0)
            ->orderBy('sorting_order', 'ASC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $categoryIds = array_column($queryIds, 'id');

        $allCategoryIds = $categoryIds;

        while (!empty($categoryIds)) {
            $subQueryIds = $this->db->table('category')
                ->select('id')
                ->whereIn('parent_category_id', $categoryIds)
                ->get()
                ->getResultArray();

            $subCategoryIds = array_column($subQueryIds, 'id');
            $allCategoryIds = array_merge($allCategoryIds, $subCategoryIds);
            $categoryIds = $subCategoryIds;
        }

        $queryAllData = $this->db->table('category')
            ->select('id, name, parent_category_id, sorting_order, image')
            ->whereIn('id', $allCategoryIds)
            ->orderBy('sorting_order', 'ASC')
            ->get()
            ->getResult();

        return $queryAllData;
    }

    public function getMaxSortingCount()
    {
        $query = $this->db->table('category')
            ->selectMax('sorting_order')
            ->get();

        return $query->getRow()->sorting_order;
    }
}
