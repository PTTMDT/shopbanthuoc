<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KHACH_HANG extends Model
{
    //
    protected $table = "KHACH_HANG";
	 public function DANH_GIA(){
       return $this->hasMany('app\DANH_GIA','ID_KH','ID_KH');
  }
	 public function DON_DAT_HANG(){
       return $this->hasMany('app\DON_DAT_HANG','ID_DDH');
  }
	 public function LOAI_KH(){
       return $this->belongsTo('app\LOAI_KH','ID_LKH');
  }
}
