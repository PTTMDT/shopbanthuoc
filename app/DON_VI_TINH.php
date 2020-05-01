<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DON_VI_TINH extends Model
{
    //
    protected $table = "DON_VI_TINH";
    public function THUOC(){
        return $this->hasMany('app\THUOC','DVT','DVT');
    }
}
