<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table      = 'blog';
    protected $primaryKey = 'bid';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['bid','uid','b_title','b_image','b_description','addedBy','status'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}