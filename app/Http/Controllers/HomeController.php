<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        $all_product = DB::table('thuoc')->where('product_status','0')->whereNotIn('SO_LUONG_TON',[0])->orderby('ID_THUOC','desc')->limit(6)->get(); 

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request){

        $keywords = $request->keywords_submit;

        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        $search_product = DB::table('thuoc')->where('TEN_THUOC','like','%'.$keywords.'%')->get(); 


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);

    }
    public function getContact(){

    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
        //  $all_product = DB::table('thuoc')->where('product_status','0')->orderby('ID_THUOC','desc')->limit(6)->get(); 

    	return view('pages.lienhe.show_lienhe')->with('category',$cate_product)->with('brand',$brand_product);
    }
}
