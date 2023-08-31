<?php

namespace App\Models;

use CodeIgniter\Model;

class m_keranjang extends Model
{
    protected $table = 'keranjang';
    protected $allowedFields = ['uid', 'id_item', 'jumlah', 'sub_harga', 'status'];

    public function getList($uid, $status = 1, $id = false)
    {
        if ($id) {
            return $this->where(['uid' => $uid, 'status' => $status, 'id' => $id])->first();
        } else {
            return $this->where(['uid' => $uid, 'status' => $status])->findAll();
        }
    }

    public function getItem($id_item, $status = 1)
    {
        return $this->where(['id_item' => $id_item, 'status' => $status])->first();
    }
}
