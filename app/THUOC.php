<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class THUOC extends Model
{
    //
  protected $table = "THUOC";
    public $timestamp= false;
    public function GOC_THUOC(){
        return $this->belongsTo('app\GOC_THUOC','ID_GOC','ID_THUOC');
    }
       public function DON_VI_TINH(){
        return $this->belongsTo('app\DON_VI_TINH','DVT','ID_THUOC');
    }
       public function CHI_TIET_LO(){
        return $this->hasMany('app\CHI_TIET_LO','ID_THUOC','ID_THUOC');
    }
       public function GOC_THUOC(){
        return $this->belongsTo('app\KHUYEN_MAI','ID_KM','ID_THUOC');
    }  
       public function CHI_TIET_DDH(){
        return $this->hasMany('app\CHI_TIET_DDH','ID_THUOC','ID_THUOC');
    }
       public function DANH_GIA(){
        return $this->hasMany('app\DANH_GIA','ID_THUOC','ID_THUOC');
    }
    
}
