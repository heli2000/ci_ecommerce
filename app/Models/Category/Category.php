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
            ->get();

        return $query->getResult();
    }

    public function getAllCategories()
    {
        return $this->findAll();
    }
}
