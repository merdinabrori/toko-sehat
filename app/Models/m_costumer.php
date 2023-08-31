<?php

namespace App\Models;

use CodeIgniter\Model;

class m_costumer extends Model
{
    protected $table = 'costumer';
    protected $primaryKey = 'uid';
    protected $allowedFields = ['username', 'email', 'pw', 'dob', 'gender', 'alamat', 'provinsi', 'kota', 'noHP', 'paypalID', 'foto'];

    public function getUser($uid = false)
    {
        if ($uid) {
            return $this->where(['uid' => $uid])->first();
        } else {
            return $this->findAll();
        }
    }

    public function getUserByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }
}
