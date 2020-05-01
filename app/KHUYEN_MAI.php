<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KHUYEN_MAI extends Model
{
    //
        protected $table = "KHUYEN_MAI";
    public function LOAI_KHUYEN_MAI(){
        return $this->belongsTo('app\LOAI_KHUYEN_MAI','ID_KM','ID_KM');
    }
    public function DON_DAT_HANG(){
        return $this->hasMany('app\DON_DAT_HANG','ID_KM','ID_KM');
    }
    public function THUOC(){
        return $this->hasMany('app\THUOC','ID_KM','ID_KM');
    }
}
