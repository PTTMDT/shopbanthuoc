<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NHA_CUNG_CAP extends Model
{
    //
        protected $table = "NHA_CUNG_CAP";
    public function LO(){
        return $this->hasMany('app\LO','ID_NCC','ID_NCC');
    }
}
