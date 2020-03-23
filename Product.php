<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = "id";
    protected $fillable = ["id","name","available_quantity","price","description","image"];
}
