<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CHI_TIET_LO extends Model
{
    //
     protected $table = "CHI_TIET_LO";
    
    public function LO ()
    {
        return $this->belongsTo('App\LO','ID_LO','ID_LO')
    }
    public function THUOC()
    {
        return $this->belongsTo('App\THUOC','ID_THUOC','ID_THUOC')
    }
}
