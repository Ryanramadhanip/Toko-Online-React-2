<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengiriman extends Model
{
    protected $table = "alamat";
    protected $primaryKey = "id_alamat";
    protected $fillable = ["id_user", "username", "jalan", "rt", "rw", "kecamatan", "kode_pos", "kota"];

    public function user()
    {
        return $this->belongsTo("App\User", "id");
    }
}