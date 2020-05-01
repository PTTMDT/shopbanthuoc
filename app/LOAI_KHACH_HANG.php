<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOAI_KHACH_HANG extends Model
{
    //
        protected $table = "LOAI_KHACH_HANG";
    public function KHACH_HANG(){
        return $this->hasMany('app\KHACH_HANG','ID_LKH','ID_LKH');
    }
}
