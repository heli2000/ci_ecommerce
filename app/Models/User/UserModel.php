<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected bool $allowEmptyInserts = false;

    protected $allowedFields = ['name', 'phoneNumber', 'email', 'password', 'isAdmin', 'isVerified', 'created_at', 'updated_at'];
}
