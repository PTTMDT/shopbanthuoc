<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NHAN_VIEN extends Model
{
    //
        protected $table = "NHAN_VIEN";
    public function DON_DAT_HANG(){
        return $this->hasMany('app\DON_DAT_HANG','ID_NV','ID_NV');
    }
    public function LOAI_NHAN_VIEN(){
        return $this->belongsTo('app\LOAI_NHAN_VIEN','ID_NV','ID_NV');
    }
}
