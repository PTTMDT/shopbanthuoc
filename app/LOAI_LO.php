<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOAI_LO extends Model
{
    //
    protected $table = "LOAI_LO";
	 public function LO(){
       return $this->hasMany('app\LO','ID_LO');
  }
}
