<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DON_DAT_HANG extends Model
{
    //
    protected $table = "DON_DAT_HANG";
	public function KHUYEN_MAI(){
        return $this->belongsTo('app\KHUYEN_MAI','ID_KM');
  }
	 public function NHAN_VIEN(){
       return $this->belongsTo('app\NHAN_VIEN','ID_NV');
  }
	 public function TIEN_TE(){
       return $this->belongsTo('app\TIEN_TE','ID_TIENTE');
  }
	 public function HINH_THUC_TT(){
       return $this->belongsTo('app\HINH_THUC_TT','ID_HT');
  }
 	public function HINH_THUC_VC(){
       return $this->belongsTo('app\HINH_THUC_VC','ID_VC');
  }
	 public function TRANG_THAI(){
       return $this->belongsTo('app\TRANG_THAI','ID_TT');
  }
	 public function KHACH_HANG(){
       return $this->belongsTo('app\KHACH_HANG','ID_KH');
  }
	 public function CHI_TIET_DDH(){
       return $this->hasMany('app\CHI_TIET_DDH','ID_DDH','ID_DDH');
  }
}
