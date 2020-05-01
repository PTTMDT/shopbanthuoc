<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TIEN_TE extends Model
{
    //
    protected $table = "LOAI_NHAN_VIEN";
    public function NHAN_VIEN(){
        return $this->hasMany('app\NHAN_VIEN','ID_LOAI','ID_LOAI');
    }
}
