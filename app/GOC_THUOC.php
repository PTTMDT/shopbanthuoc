<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GOC_THUOC extends Model
{
   protected $table = "GOC_THUOC";
   public $timestamps=false;
   public function THUOC()
   {
       return $this ->hasMany('app\THUOC','ID_GOC','ID_GOC'); // 'ID_GOC là khóa ngoại của bảng THUOC

   }
}
