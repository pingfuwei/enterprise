<?php

namespace App\adminModel;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="admin";
    protected $primaryKey = "id";
    public $timestamps = false;

}
