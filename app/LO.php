<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LO extends Model
{
    //
    protected $table  = "LO";
    public function LOAI_LO()
    {
        return $this->belongsTo('App\LOAI_LO','ID_LOAI_LO','ID_LO')
    }
    public function NHA_CUNG_CAP()
    {
        return $this->belongsTo('App\NHA_CUNG_CAP','ID_NCC','ID_LO')

    }
    public function CHI_TIET_LO()

    {
        return $this->hasMany('App\CHI_TIET_LO','ID_LO','ID_LO')
    }
}
