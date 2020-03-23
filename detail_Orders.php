<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_Orders extends Model
{
    protected $table = "detail_orders";
    protected $fillable = ["id_orders","id_product","quantity"];

    public function orders(){
        return $this->belongsTo("App\Orders","id", "id_orders");
    }

    public function product(){
        return $this->belongsTo("App\Product","id", "id_product");
    }
}
