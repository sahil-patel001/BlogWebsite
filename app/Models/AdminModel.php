<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'signup_admin';
    protected $primaryKey = 'aid';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fname', 'lname', 'email', 'password', 'phone'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}