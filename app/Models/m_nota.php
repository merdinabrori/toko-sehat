<?php

namespace App\Models;

use CodeIgniter\Model;

class m_nota extends Model
{
    protected $table = 'nota';
    protected $allowedFields = ['list_krjg', 'uid', 'total_harga', 'tgl', 'status'];

    public function getNota($uid = false, $id = false, $status = false)
    {
        if ($uid || $id || $status) {
            $where = [];
            if ($uid != false) {
                $where['uid'] = $uid;
            }
            if ($id != false) {
                $where['id'] = $id;
            }
            if ($status != false) {
                $where['status'] = $status;
            }

            return $this->where($where)->findAll();
        } else {
            return $this->findAll();
        }
    }

    // public function getUserByEmail($email)
    // {
    //     return $this->where(['email' => $email])->first();
    // }
}
