<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'likebtn';
    // protected $primaryKey = 'aid';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['uid','bid'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}