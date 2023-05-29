<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaction_sale';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id_product', 'quantity', 'id_account', 'id_office', 'buyer'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_time';
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

    public function getProduct($id = false)
    {
        if ($id == false) {
            $this->select('transaction_sale.*,master_product.name,master_product.price,master_account.username,master_office.office_name');
            $this->join('master_product', 'master_product.id = id_product');
            $this->join('master_account', 'master_account.id = id_account');
            $this->join('master_office', 'master_office.id = id_office');
            $this->orderBy('transaction_sale.created_time', 'DESC');

            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
