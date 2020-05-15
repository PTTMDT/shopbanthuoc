<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class KMController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function addKM_product(){
        $this->AuthLogin();
        $cate_product = DB::table('loai_km')->orderby('ID_LOAI_KM','desc')->get(); 
        $brand_product = DB::table('thuoc')->orderby('ID_THUOC','desc')->get(); 
       

        return view('admin.add_KM_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
    
    public function allKM_product(){
        $this->AuthLogin();
    	$allKM_product = DB::table('khuyen_mai')
        ->join('loai_km','loai_km.ID_LOAI_KM','=','khuyen_mai.ID_LOAI_KM')
        ->orderby('khuyen_mai.ID_KM','desc')->get();
    	$manager_product  = view('admin.all_KM_product')->with('allKM_product',$allKM_product);
    	return view('admin_layout')->with('admin.all_KM_product', $manager_product);

    }
    public function saveKM_product(Request $request){
         $this->AuthLogin();
    	$data = array();
        $data['GIA_TRI_KM'] = $request->gia_tri_km;
        $data['NGAYBD'] = $request->ngaybd;
        $data['NGAYKT'] = $request->ngaykt;
        $data['ID_LOAI_KM'] = $request->id_loai_km;
        $data['KM_status'] = $request->km_status;
        DB::table('khuyen_mai')->insert($data);
    	Session::put('message','Thêm khuyến mãi thành công');
    	return Redirect::to('all-KM-product');
    }
    public function unactiveKM_product($KM_id){
         $this->AuthLogin();
        DB::table('khuyen_mai')->where('ID_KM',$KM_id)->update(['KM_status'=>1]);
        Session::put('message','Không kích hoạt khuyến mãi thành công');
        return Redirect::to('allKM-product');

    }
    public function activeKM_product($KM_id){
         $this->AuthLogin();
        DB::table('khuyen_mai')->where('ID_KM',$KM_id)->update(['KM_status'=>0]);
        Session::put('message','Không kích hoạt khuyến mãi thành công');
        return Redirect::to('allKM-product');
    }
    public function editKM_product($KM_id){
         $this->AuthLogin();
        $cate_product = DB::table('loai_km')->orderby('ID_LOAI_KM','desc')->get(); 
        // $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get();
        $edit_product = DB::table('khuyen_mai')->where('ID_KM',$KM_id)->get();

        $manager_product  = view('admin.edit_KM_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product);

        return view('admin_layout')->with('admin.edit_KM_product', $manager_product);
    }
    public function updateKM_product(Request $request,$KM_id){
         $this->AuthLogin();
        $data = array();
        $data['GIA_TRI_KM'] = $request->gia_tri_km;
        $data['NGAYBD'] = $request->ngaybd;
        $data['NGAYKT'] = $request->ngaykt;
        $data['ID_LOAI_KM'] = $request->id_loai_km;
        DB::table('khuyen_mai')->where('ID_KM',$KM_id)->update($data);
        Session::put('message','Cập nhật khuyến mãi thành công');
        return Redirect::to('all-KM-product');
    }
    public function deleteKM_product($KM_id){
        $this->AuthLogin();
        DB::table('khuyen_mai')->where('ID_KM',$KM_id)->delete();
        Session::put('message','Xóa khuyến mãi thành công');
        return Redirect::to('all-KM-product');
    }
   
}
