<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ["id","name","username","password","role",];

    public function alamat(){
        return $this->hasMany("App\alamat","id_user");
    }
}
