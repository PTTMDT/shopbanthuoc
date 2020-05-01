<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CHI_TIET_DON_DAT_HANG extends Model
{
    //
    protected $table ="CHI_TIET_DON_DAT_HANG";
    public function THUOC(){
       return $this->belongsTo('app\THUOC','ID_THUOC','ID_THUOC');
  }
     public function DON_DAT_HANG(){
       return $this->belongsTo('app\THUOC','ID_DDH','ID_DDH');
  }
}
