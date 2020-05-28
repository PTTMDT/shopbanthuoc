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
        $idloailo=$request->id_loai_lo;
        $data['ID_LOAI_LO'] = $idloailo;
        $data['NGAY_SX'] = $request->ngaysx;
        $data['NGAY_HH'] = $request->ngayhh;
        $data['NGAY_NHAP'] = $request->ngaynhap;
        $data['LO_status'] = $request->lo_status;
        $data_lo = array();
        // $data_lo['SO_LUONG'] = $request->so_luong;
        // $data_lo['DON_GIA_LO'] = $request->don_gia_lo;
        
        $id_lo=DB::table('lo')->insertGetId($data);
        // DB::table('chi_tiet_lo')->insert($data_lo);
        Session::put('ID_LO',$id_lo);
        Session::put('ID_LOAI_LO',$idloailo);
        Session::put('message','Thêm lô thành công');
      
        return Redirect::to('/add-detail-lo');
    }
    public function add_detail_lo(){
        $this->AuthLogin();
        $thuoc = DB:: table('thuoc')->get(); 
        return view('admin.add_detail_lo')->with('thuoc',$thuoc);
    	
   }

    public function save_detail_lo(Request $request){
        $this->AuthLogin();
       $data = array();
       $idlo=Session::get('ID_LO');
       $data['ID_LO'] = $idlo;
       $idthuoc=$request->id_thuoc;
       $data['ID_THUOC'] =$idthuoc;
       $soluong=$request->so_luong;
       $data['SO_LUONG'] = $soluong;
       $data['DON_GIA_LO'] = $request->don_gia_lo;
       DB::table('chi_tiet_lo')->insert($data); // thêm vào chi tiết lô
       $soluongton=DB::table('thuoc')->where('ID_THUOC',$idthuoc)->value('SO_LUONG_TON');
       $idloailo= Session::get('ID_LOAI_LO');
       if($idloailo==1){
       $tongsoluongton= $soluong + $soluongton;
       }
       else{
       $tongsoluongton= $soluongton - $soluong;   
       }
       DB::table('thuoc')->where('ID_THUOC',$idthuoc)->update(['SO_LUONG_TON'=>$tongsoluongton]); // cập nhật lại số lượng tồn của thuốc
       Session::put('ID_LO',$idlo);
       Session::put('message','Thêm chi tiết lô thành công');
       return Redirect::to('/add-detail-lo');
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
        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 
        $detail_lo = DB::table('lo')
        ->join('chi_tiet_lo','lo.ID_LO','=','chi_tiet_lo.ID_LO')
        ->join('thuoc','chi_tiet_lo.ID_THUOC','=','thuoc.ID_THUOC')
        // ->join('loai_lo','lo.ID_LOAI_LO','=','loai_lo.ID_LOAI_LO')
        ->where('lo.ID_LO',$lo_id)
        ->select('lo.*','chi_tiet_lo.*','thuoc.*')->get();
        $manager_product  = view('admin.edit_lo_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)
        ->with('detail_lo',$detail_lo);
        return view('admin_layout')->with('admin.edit_lo_product', $manager_product);
        // print_r($detail_lo);
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
        DB::table('lo')->where('ID_LO',$lo_id)->delete();
        Session::put('message','Xóa lô thành công');
        return Redirect::to('all-lo-product');
    }
    public function view_lo($lo_id){
        $this->AuthLogin();
        $order_by_id = DB::table('lo')
        ->join('chi_tiet_lo','lo.ID_LO','=','chi_tiet_lo.ID_LO')
        ->join('thuoc','chi_tiet_lo.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('loai_lo','lo.ID_LOAI_LO','=','loai_lo.ID_LOAI_LO')
        ->where('lo.ID_LO',$lo_id)
        ->select('lo.*','chi_tiet_lo.*','thuoc.*','loai_lo.*')->get();
        $manager_order_by_id  = view('admin.view_lo')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_lo', $manager_order_by_id);
   
}
}
