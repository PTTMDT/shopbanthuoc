<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TRANG_THAI extends Model
{
    //
    protected $table = "TRANG_THAI";
    public function DON_DAT_HANG(){
        return $this->hasMany('app\DON_DAT_HANG','ID_TT','ID_TT');
    }
}
