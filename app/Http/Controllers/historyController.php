<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class historyController extends Controller
{
    public function login(){

    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        return view('pages.lichsu.login_lichsu')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function login_history(Request $request){
    	$email = $request->EMAIL_KH;
    	$password = md5($request->PASSWORD);
    	$result = DB::table('khach_hang')->where('EMAIL_KH',$email)->where('PASSWORD',$password)->first();
        if($result){
    		Session::put('ID_KH',$result->ID_KH);
    		return Redirect::to('/history');
    	}else{
    		return Redirect::to('/login');
    	}
    }
     public function add_customer(Request $request){

            $data = array();
            $data['TEN_KH'] = $request->customer_name;
            $data['SDT'] = $request->customer_phone;
            $data['EMAIL_KH'] = $request->customer_email;
            $data['PASSWORD'] = md5($request->customer_password);
            $data['DIA_CHI'] = $request->address;
            $data['ID_LKH'] = 1;
            $customer_id = DB::table('khach_hang')->insertGetId($data);
    
            Session::put('ID_KH',$customer_id);
            Session::put('TEN_KH',$request->customer_name);
            return Redirect::to('/history');
    
    
        }
     public function show_history(){
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        $ID_KH= Session::get('ID_KH');
        $history= DB::table('don_dat_hang')->where('ID_KH',$ID_KH)
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        // ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('trang_thai','don_dat_hang.ID_TT','=','trang_thai.ID_TT')->get();
        $history= DB::table('don_dat_hang')->where('ID_KH',$ID_KH)
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        // ->join('khuyen_mai','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('trang_thai','don_dat_hang.ID_TT','=','trang_thai.ID_TT')->get();
        // $detail_history= DB::table('don_dat_hang')->where('ID_DDH',$ID_KH)
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        // ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')->get();
        return view('pages.lichsu.lichsu')->with('category',$cate_product)->with('brand',$brand_product)->with('history',$history);
        // ->with('detail_history',$detail_history);
     }
    	
}
