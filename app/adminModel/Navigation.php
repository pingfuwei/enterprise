<?php

namespace App\adminModel;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table="navigation";
    protected $primaryKey = "nav_id";
    public $timestamps = false;
}
