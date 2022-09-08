<?php

namespace App\Models;

use App\Base\Model;
use App\Traits\HasEloquent;
class User extends Model
{
    use HasEloquent;
    public function __construct() {
        parent::__construct($this);
    }
}