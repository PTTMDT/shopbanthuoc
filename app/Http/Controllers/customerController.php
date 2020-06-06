<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();
class customerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }

    public function all_customer(){
        $this->AuthLogin();
        $all_customer = DB::table('khach_hang')
        ->join('loai_kh','loai_kh.ID_LKH','=','khach_hang.ID_LKH')
        ->orderby('ID_KH','desc')->get();
    	$manager_customer  = view('admin.all_customer')->with('all_customer',$all_customer);
        return view('admin_layout')->with('admin.all_customer', $manager_customer);
        // print_r($all_customer);

    }
 
 
    public function edit_customer($idcustomer){
         $this->AuthLogin();
        $loaikh = DB::table('loai_kh')->orderby('ID_LKH','desc')->get();

        $edit_customer = DB::table('khach_hang')->where('ID_KH',$idcustomer)->get();

        $manager_customer  = view('admin.edit_customer')->with('edit_customer',$edit_customer)->with('loaikh',$loaikh);

        return view('admin_layout')->with('admin.edit_customer', $manager_customer);
       
    }
     public function update_customer(Request $request,$idcustomer){
         $this->AuthLogin();
        $data = array();
        $data['TEN_KH'] = $request->ten_kh;
        $data['SDT'] = $request->sdt;
    	$data['EMAIL_KH'] = $request->email_kh;
    	$data['ID_LKH'] = $request->id_loai;
    	DB::table('khach_hang')->where('ID_KH',$idcustomer)->update($data);
    	Session::put('message','Cập nhật thông tin khách hàng thành công');
    	return Redirect::to('/customer');
    }
    public function delete_customer($idcustomer){
        $this->AuthLogin();
        DB::table('khach_hang')->where('ID_KH',$idcustomer)->delete();
        Session::put('message','Xóa khách hàng thành công');
        return Redirect::to('/customer');
    }
    
    

   
   
   
}
