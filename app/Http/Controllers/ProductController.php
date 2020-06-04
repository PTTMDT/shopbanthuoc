<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
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
        $DVT= DB::table('don_vi_tinh')->get();
        $khuyen_mai = DB::table('khuyen_mai')->where('ID_LOAI_KM',1)->orderby('ID_KM','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 
       

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product)->with('khuyenmai',$khuyen_mai)->with('DVT',$DVT);
    	

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
    
       $data['TEN_THUOC'] = $request->ten_thuoc;
       $data['product_slug'] = $request->product_slug;
       $data['ID_GOC'] = $request->goc;
       $data['ID_KM'] = $request->khuyen_mai;
       $data['HOAT_CHAT_CHINH'] = $request->hoat_chat_chinh;
       $data['HAM_LUONG'] = $request->ham_luong;
       $data['QUY_CACH_DONG_GOI'] = $request->quy_cach;
       $data['TAC_DUNG'] = $request->tac_dung;
       $data['product_desc'] = $request->product_desc;
       $data['DON_GIA'] = $request->don_gia;
       $data['CACH_DUNG'] = $request->cach_dung;
       $get_image = $request->file('HINH_ANH');
       // $data['HINH_ANH'] = $get_image;
       $data['LUU_Y'] = $request->luu_y;
       $ID_KM=$request->khuyen_mai;
       $km= DB::table('khuyen_mai')->where('ID_KM',$ID_KM)->value('GIA_TRI_KM');
       $don_gia= $request->don_gia;
       $don_gia_km=$don_gia*$km;
       // return  $don_gia_km;
       if($ID_KM==NULL){
       $data['DON_GIA_KM'] = NULL;
       }
       else {
           $don_gia_km=$don_gia-$don_gia*$km;
           $data['DON_GIA_KM']= $don_gia_km;
       }
       // $request->don_gia_km;
       $data['DVT'] = $request->dvt;
       $data['SO_LUONG_TON'] =0;
       //  $request->so_luong_ton;
       $data['product_status'] = 0;
       
     
       if($get_image){
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/product',$new_image);
           $data['HINH_ANH'] = $new_image;
           DB::table('thuoc')->insert($data);
           Session::put('message','Thêm thuốc thành công');
           return Redirect::to('all-product');

           // return $hinhanh;
       }
       $data['HINH_ANH'] = '';
       DB::table('thuoc')->insert($data);
       Session::put('message','Thêm thuốc thành công');
       return Redirect::to('all-product');
       
   }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt thuốc thành công');
        return Redirect::to('all-product');
// return Redirect::to('add-product');
    }
    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt thuốc thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
         $this->AuthLogin();
        $cate_product = DB::table('goc_thuoc')->orderby('ID_GOC','desc')->get(); 

        $DVT= DB::table('don_vi_tinh')->get();

        $brand_product = DB::table('nha_cung_cap')->orderby('ID_NCC','desc')->get(); 

        $khuyen_mai = DB::table('khuyen_mai')->where('ID_LOAI_KM',1)->orderby('ID_KM','desc')->get();

        $edit_product = DB::table('thuoc')->where('ID_THUOC',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('DVT',$DVT)->with('km',$khuyen_mai);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
       
    }
     public function update_product(Request $request,$product_id){
         $this->AuthLogin();
        $data = array();
        $data['TEN_THUOC'] = $request->ten_thuoc;
        $data['product_slug'] = $request->product_slug;
    	$data['DON_GIA'] = $request->don_gia;
    	$data['TAC_DUNG'] = $request->tac_dung;
        $data['HOAT_CHAT_CHINH'] = $request->hoat_chat_chinh;
        $data['ID_GOC'] = $request->product_cate;
        $data['HAM_LUONG'] = $request->ham_luong;
        $data['ID_KM'] = $request->khuyen_mai;
        $data['DON_GIA_KM'] = $request->don_gia_km;
        $data['product_desc'] = $request->product_desc;
        $data['DVT'] = $request->dvt;
        $data['product_status'] = $request->product_status;
        $data['HINH_ANH'] = $request->hinh_anh;
        
        $get_image = $request->file('HINH_ANH');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['HINH_ANH'] = $new_image;
            DB::table('thuoc')->where('ID_THUOC',$product_id)->update($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['HINH_ANH'] = '';
    	DB::table('thuoc')->where('ID_THUOC',$product_id)->update($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('thuoc')->where('ID_THUOC',$product_id)->delete();
        Session::put('message','Xóa thuốc thành công');
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
        // ->join('danh_gia','danh_gia.ID_THUOC','=','thuoc.ID_THUOC')
        // ->join('khach_hang','khach_hang.ID_KH','=','danh_gia.ID_KH')
        ->where('thuoc.ID_GOC',$category_ID)->whereNotIn('thuoc.product_slug',[$product_slug])->whereNotIn('thuoc.SO_LUONG_TON',[0])->get();
        $danhgia=DB::table('danh_gia')      // các thuốc liên quan
        ->join('thuoc','thuoc.ID_THUOC','=','danh_gia.ID_THUOC')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->join('danh_gia','danh_gia.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('khach_hang','khach_hang.ID_KH','=','danh_gia.ID_KH')
        ->where('thuoc.product_slug',$product_slug)->get();
        $idthuoc=DB::table('thuoc')   
        ->where('thuoc.product_slug',$product_slug)->value('ID_THUOC');
      
        Session::put('ID_THUOC',$idthuoc);
        Session::put('product_slug',$product_slug);
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('danhgia',$danhgia);

    //   print_r($danhgia);
    }
    
    
    
       public function add_binhluan(Request $request){
        $data = array();
        $tenkh = $request->TEN_KH;
        $email = $request->EMAIL_KH;
        $khachhang=DB::table('khach_hang')->where([
            ['TEN_KH', '=', $tenkh],
            ['EMAIL_KH', '=', $email]
        ])->value('ID_KH');
        $data['ID_THUOC']=Session::get('ID_THUOC');
        $data['ND_DANH_GIA'] = $request->nd_danhgia;
        $data['ID_KH']=$khachhang;
    //    $date_time=Carbon::now('Asia/Ho_Chi_Minh'); 
        $data['NGAY']=Carbon::now('Asia/Ho_Chi_Minh');  
        // $data['GIO']='09:00:00';
        
        // $data['ID_LKH'] = 1;
    	 DB::table('danh_gia')->insert($data);

        $product_slug=Session::get('product_slug');
        return Redirect::to('chi-tiet-san-pham/'.$product_slug);

    }
        
   
   
   
}
