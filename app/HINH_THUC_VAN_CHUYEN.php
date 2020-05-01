<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HINH_THUC_VAN_CHUYEN extends Model
{
    //
    protected $table = "HINH_THUC_VAN_CHUYEN";
    
    
    public function DON_DAT_HANG()
    {
        return $this->hasMany('App\DON_DAT_HANG','ID_VC','ID_VC')
    }
}
