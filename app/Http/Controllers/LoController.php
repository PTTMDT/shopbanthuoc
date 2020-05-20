<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class LoController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function addlo_product(){
        $this->AuthLogin();
        $cate_product = DB::table('loai_lo')->orderby('ID_LOAI_LO','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 
       

        return view('admin.add_lo_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
    
    public function alllo_product(){
        $this->AuthLogin();
    	$alllo_product = DB::table('lo')
        ->join('loai_lo','loai_lo.ID_LOAI_LO','=','lo.ID_LOAI_LO')
        ->orderby('lo.ID_LO','desc')->get();
    	$manager_product  = view('admin.all_lo_product')->with('alllo_product',$alllo_product);
    	return view('admin_layout')->with('admin.all_lo_product', $manager_product);

    }
    public function savelo_product(Request $request){
         $this->AuthLogin();
    	$data = array();
        $data['ID_NCC'] = $request->id_ncc;
        $data['ID_LOAI_LO'] = $request->id_loai_lo;
        $data['NGAY_SX'] = $request->ngaysx;
        $data['NGAY_HH'] = $request->ngayhh;
        $data['NGAY_NHAP'] = $request->ngaynhap;
        $data['LO_status'] = $request->lo_status;

        DB::table('lo')->insert($data);
    	Session::put('message','Thêm lô thành công');
        return Redirect::to('all-lo-product');


    }
    public function unactivelo_product($lo_id){
         $this->AuthLogin();
        DB::table('lo')->where('ID_LO',$lo_id)->update(['LO_status'=>1]);
        Session::put('message','Không kích hoạt lô thành công');
        return Redirect::to('alllo-product');

    }
    public function activelo_product($lo_id){
         $this->AuthLogin();
        DB::table('lo')->where('ID_LO',$lo_id)->update(['LO_status'=>0]);
        Session::put('message','Không kích hoạt lô thành công');
        return Redirect::to('alllo-product');
    }
    public function editlo_product($lo_id){
         $this->AuthLogin();
        $cate_product = DB::table('loai_lo')->orderby('ID_LOAI_LO','desc')->get(); 
        // $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get();
        $edit_product = DB::table('lo')->where('ID_LO',$lo_id)->get();

        $manager_product  = view('admin.edit_lo_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);

        return view('admin_layout')->with('admin.edit_lo_product', $manager_product);
    }
    public function updatelo_product(Request $request,$lo_id){
         $this->AuthLogin();
        $data = array();
        $data['ID_NCC'] = $request->id_ncc;
        $data['ID_LOAI_LO'] = $request->id_loai_lo;
        $data['NGAY_SX'] = $request->ngaysx;
        $data['NGAY_HH'] = $request->ngayhh;
        $data['NGAY_NHAP'] = $request->ngaynhap;

        DB::table('lo')->where('ID_LO',$lo_id)->update($data);
        Session::put('message','Cập nhật lô thành công');
        return Redirect::to('all-lo-product');
    }
    public function deletelo_product($lo_id){
        $this->AuthLogin();
        DB::table('khuyen_mai')->where('ID_LO',$lo_id)->delete();
        Session::put('message','Xóa lô thành công');
        return Redirect::to('all-lo-product');
    }
   
}
