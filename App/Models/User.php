<?php

namespace App\Models;

use App\Base\Model;
use App\Traits\HasEloquent;
final class User extends Model
{
    public function __construct() {
        parent::__construct($this);
    }
}