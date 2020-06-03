<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class NvController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function addNV_product(){
        $this->AuthLogin();
        $nv_product = DB::table('loai_nhan_vien')->orderby('ID_LOAI','desc')->get(); 
       
       

        return view('admin.add_NV_product')->with('nv_product', $nv_product);
    	

    }
    
    public function allNV_product(){
        $this->AuthLogin();
    	$allNV_product = DB::table('nhan_vien')
        ->join('loai_nhan_vien','loai_nhan_vien.ID_LOAI','=','nhan_vien.ID_LOAI')
        ->orderby('nhan_vien.ID_NV','desc')->get();
    	$manager_product  = view('admin.all_NV_product')->with('allNV_product',$allNV_product);
    	return view('admin_layout')->with('admin.all_NV_product', $manager_product);

    }
    public function saveNv_product(Request $request){
         $this->AuthLogin();
        $data = array();
        $data['TEN_NV'] = $request->ten_nv;
        $data['SDT'] = $request->sdt;
        $data['EMAIL_NV'] = $request->email_nv;
        // $data['PASSWORD'] = $request->password;
        $data['ID_LOAI'] = $request->id_loai;
        DB::table('nhan_vien')->insert($data);
    	Session::put('message','Thêm nhân viên thành công');
    	return Redirect::to('all-NV-product');
    }
    // public function unactiveNv_product($KM_id){
    //      $this->AuthLogin();
    //     DB::table('nhan_vien')->where('ID_NV',$NV_id)->update(['KM_status'=>1]);
    //     Session::put('message','Không kích hoạt khuyến mãi thành công');
    //     return Redirect::to('allKM-product');

    // }
    // public function activeKM_product($KM_id){
    //      $this->AuthLogin();
    //     DB::table('khuyen_mai')->where('ID_KM',$KM_id)->update(['KM_status'=>0]);
    //     Session::put('message','Không kích hoạt khuyến mãi thành công');
    //     return Redirect::to('allKM-product');
    // }
    public function editNV_product($NV_id){
         $this->AuthLogin();
        $nv_product = DB::table('loai_nhan_vien')->orderby('ID_LOAI','desc')->get(); 
        
        $edit_product = DB::table('nhan_vien')->where('ID_NV',$NV_id)->get();

        $manager_product  = view('admin.edit_NV_product')->with('edit_product',$edit_product)->with('nv_product',$nv_product);

        return view('admin_layout')->with('admin.edit_NV_product', $manager_product);
    }
    public function updateNV_product(Request $request,$NV_id){
         $this->AuthLogin();
        $data = array();
        // $data['GIA_TRI_KM'] = $request->gia_tri_km;
        // $data['NGAYBD'] = $request->ngaybd;
        // $data['NGAYKT'] = $request->ngaykt;
        // $data['ID_LOAI_KM'] = $request->id_loai_km;
        // DB::table('khuyen_mai')->where('ID_KM',$KM_id)->update($data);
        // Session::put('message','Cập nhật khuyến mãi thành công');
        // return Redirect::to('all-KM-product');
        $data['TEN_NV'] = $request->ten_nv;
        $data['SDT'] = $request->sdt;
        $data['EMAIL_NV'] = $request->email_nv;
        // $data['PASSWORD'] = $request->password;
        $data['ID_LOAI'] = $request->id_loai;
        // DB::table('nhan_vien')->insert($data);
        DB::table('nhan_vien')->where('ID_NV',$NV_id)->update($data);
        Session::put('message','Cập nhật nhân viên thành công');
        return Redirect::to('all-NV-product');
    	// Session::put('message','Thêm nhân viên thành công');
    	// return Redirect::to('all-KM-product');
    }
    public function deleteNV_product($NV_id){
        $this->AuthLogin();
        DB::table('nhan_vien')->where('ID_NV',$NV_id)->delete();
        Session::put('message','Xóa nhân viên thành công');
        return Redirect::to('all-NV-product');
    }
   
}
