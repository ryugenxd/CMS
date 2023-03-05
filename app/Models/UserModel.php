<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email'];
    public function updateRememberToken($userId, $token)
    {
        $this->db->table($this->table)->where('id', $userId)->update(['remember_token' => $token]);
    }
    public function getUserByRememberToken($token)
    {
        return $this->db->table($this->table)->where('remember_token', $token)->get()->getRowArray();
    }
}
