<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HINH_THUC_THANH_TOAN extends Model
{
    //
    protected $table = "HINH_THUC_THANH_TOAN";
    
    
    public function DON_DAT_HANG()
    {
        return $this->hasMany('App\DON_DAT_HANG','ID_HT','ID_HT')
    }
}
