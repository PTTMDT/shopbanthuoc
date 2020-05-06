<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('goc_thuoc')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 
       

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('thuoc')
        ->join('goc_thuoc','goc_thuoc.ID_GOC','=','thuoc.ID_GOC')
        #->join('nha_cung_cap','nha_cung_cap.ID_NCC','=','thuoc.ID_NCC')
        ->orderby('thuoc.ID_THUOC','desc')->get();
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = array();
    	$data['TEN_THUOC'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
    	$data['DON_GIA'] = $request->product_price;
    	#$data['product_desc'] = $request->product_desc;
        $data['HOAT_CHAT_CHINH'] = $request->product_content;
        $data['ID_GOC'] = $request->product_cate;
        $data['HAM_LUONG'] = $request->product_hl;
        $data['ID_KM'] = $request->product_km;
        #$data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['HINH_ANH'] = $request->product_status;
        $get_image = $request->file('HINH_ANH');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['HINH_ANH'] = $new_image;
            DB::table('thuoc')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['HINH_ANH'] = '';
    	DB::table('thuoc')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
         $this->AuthLogin();
        $cate_product = DB::table('goc_thuoc')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 

        $edit_product = DB::table('thuoc')->where('ID_THUOC',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
         $this->AuthLogin();
        $data = array();
        $data['TEN_THUOC'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
    	$data['DON_GIA'] = $request->product_price;
    	#$data['product_desc'] = $request->product_desc;
        $data['HOAT_CHAT_CHINH'] = $request->product_content;
        $data['ID_GOC'] = $request->product_cate;
        $data['HAM_LUONG'] = $request->product_hl;
        $data['ID_KM'] = $request->product_km;
        #$data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['HINH_ANH'] = $request->product_status;
        
        $get_image = $request->file('HINH_ANH');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('thuoc')->where('ID_THUOC',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('thuoc')->where('ID_THUOC',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_slug){
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        // $offer_product = DB::table('khuyen_mai')->orderby('ID_KM','desc')->get(); 
        $offer_details_product = DB::table('thuoc')   // ID_KM khác NULL trong bảng thuoc
        ->join('goc_thuoc','goc_thuoc.ID_GOC','=','thuoc.ID_GOC')
        ->join('khuyen_mai','khuyen_mai.ID_KM','=','thuoc.ID_KM')
        ->where('thuoc.product_slug',$product_slug)->get();
        $normal_details_product = DB::table('thuoc')         // ID_KM = NULL trong bảng thuoc
        ->join('goc_thuoc','goc_thuoc.ID_GOC','=','thuoc.ID_GOC')
        ->where('thuoc.product_slug',$product_slug)->get();
 
        if(empty($offer_details_product)==NULL){            
        
            $details_product=$normal_details_product;

        }
        else {
            $details_product=$offer_details_product;
        }
        foreach($details_product as $key => $value){
            $category_ID = $value->ID_GOC;
           }
        $offer_price = DB::table('thuoc')->select('DON_GIA_KM')->where('thuoc.product_slug',$product_slug)->get();  // lấy giá khuyến mãi trong bảng thuoc
        // if($offer==NULL) {
        //     $offer
        // }
        $related_product = DB::table('thuoc')      // các thuốc liên quan
        ->join('goc_thuoc','goc_thuoc.ID_GOC','=','thuoc.ID_GOC')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('danh_gia','danh_gia.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('khach_hang','khach_hang.ID_KH','=','danh_gia.ID_KH')
        ->where('thuoc.ID_GOC',$category_ID)->whereNotIn('thuoc.product_slug',[$product_slug])->get();

      
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product);

    //   print_r($related_product);
    }
   
   
   
}
