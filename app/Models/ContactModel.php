<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table      = 'contact';
    protected $primaryKey = 'cid';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cid','subject','message','sendBy'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}