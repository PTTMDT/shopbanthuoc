<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DANH_GIA extends Model
{
    //
    protected $table = "DANH_GIA";
	 public function THUOC(){
       return $this->belongsTo('app\THUOC','ID_THUOC');
  }
	 public function KHACH_HANG(){
       return $this->belongsTo('app\KHACH_HANG','ID_KH');
  }
}
