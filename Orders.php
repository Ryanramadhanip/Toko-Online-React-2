<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = ["id_user","id_alamat","total","bukti_bayar","status"];

    public function user(){
        return $this->belongsTo("App\User","id_user", "id");
    }

    public function alamat(){
        return $this->belongsTo("App\DataPengiriman","id", "id_alamat");
    }

    public function detail_orders(){
        return $this->hasMany("App\detail_Orders", "id_orders");
    }
}
