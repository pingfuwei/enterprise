<?php

namespace App\adminModel;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    protected $table="category_content";
    protected $primaryKey = "con_id";
    public $timestamps = false;
}
