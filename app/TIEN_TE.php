<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TIEN_TE extends Model
{
    //
    protected $table = "TIEN_TE";
    public function DON_DAT_HANG(){
        return $this->hasMany('app\DON_DAT_HANG','ID_TIENTE','ID_TIENTE');
    }
}
