<?php

namespace App\Models;

use CodeIgniter\Model;

class m_admin extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['username', 'email', 'pw', 'foto'];

    public function getAdmin($id = false)
    {
        if ($id) {
            return $this->where(['id' => $id])->first();
        } else {
            return $this->findAll();
        }
    }

    public function getAdminByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }
}
