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
            ->select('id, name, parent_category_id', 'sorting_order')
            ->orderBy('sorting_order', 'ASC')
            ->get();

        return $query->getResult();
    }

    public function getAllCategories()
    {
        $query = $this->db->table('category')
            ->select('category.id, category.name, category.parent_category_id, category.sorting_order, category.description_one_line, parent.name AS parent_name')
            ->join('category AS parent', 'parent.id = category.parent_category_id', 'left')
            ->orderBy('category.sorting_order', 'ASC')
            ->get();

        return $this->findAll();
    }

    public function getMaxSortingCount()
    {
        $query = $this->db->table('category')
            ->selectMax('sorting_order')
            ->get();

        return $query->getRow()->sorting_order;
    }
}
