<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOAI_KHUYEN_MAI extends Model
{
    //
        protected $table = "LOAI_KHUYEN_MAI";
    public function KHUYEN_MAI(){
        return $this->hasMany('app\KHUYEN_MAI','ID_LOAI_KM','ID_LOAI_KM');
    }
}
