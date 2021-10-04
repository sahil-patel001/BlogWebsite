<?php

namespace App\Models;

use CodeIgniter\Model;

class Image extends Model
{
    protected $table      = 'blog_image';
    protected $primaryKey = 'img_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['bid','img_id','img','created','updated'];

    protected $useTimestamps = false;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}