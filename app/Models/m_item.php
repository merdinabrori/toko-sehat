<?php

namespace App\Models;

use CodeIgniter\Model;

class m_item extends Model
{
    protected $table = 'item';
    protected $allowedFields = ['nama_item', 'deskripsi', 'harga', 'kategori', 'stok', 'gambar'];

    public function getItem($id = false)
    {
        if ($id) {
            return $this->where(['id' => $id])->first();
        } else {
            return $this->findAll();
        }
    }

    public function getNamaItem($id)
    {
        return $this->where(['id' => $id])->findColumn('nama_item');
    }

    public function getHarga($id)
    {
        return $this->db->table('item')->select('harga')->where(['id' => $id])->get()->getRowArray();
    }
}
