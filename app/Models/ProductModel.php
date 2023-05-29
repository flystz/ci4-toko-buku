<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'master_product';
    protected $useTimestamps = false;
    protected $allowedFields = ['photo', 'name', 'price', 'writer', 'quantity'];


    public function getProduct($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function updateQuantity($id)
    {
        return $this->select('quantity')->where('id', $id)->first();
    }
}
