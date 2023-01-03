<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    public function listMaster() {
        $_master = [
            ['name' => 'Branch', 'link' => base_url('admin/branch/list'), 'group' => 'branch'],
            ['name' => 'News Category', 'link' => base_url('admin/category/list'), 'group' => 'category'],
            ['name' => 'Slider', 'link' => base_url('admin/slider/list'), 'group' => 'slider'],
            ['name' => 'Type', 'link' => base_url('admin/type/list'), 'group' => 'type'],
            ['name' => 'Team', 'link' => base_url('admin/team/list'), 'group' => 'team'],
        ];

        return $_master;
    }

    public function listTransaction() {
        $_transact = [
            ['name' => 'Client', 'link' => base_url('admin/client/list'), 'group' => 'client'],
            ['name' => 'Contact', 'link' => base_url('admin/contact/list'), 'group' => 'contact'],
            ['name' => 'News', 'link' => base_url('admin/news/list'), 'group' => 'news'],
            ['name' => 'Tariff', 'link' => base_url('admin/tariff/list'), 'group' => 'tariff'],
        ];

        return $_transact;
    }
}
