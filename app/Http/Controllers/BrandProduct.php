<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
    	return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
    	$all_brand_product = DB::table('nha_cung_cap')->get();
    	$manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);


    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
    	$data = array();
        // $data['TEN_NCC'] = $request->brand_product_name;
        // $data['SDT_NCC'] = $request->brand_sdt;
        // $data['DC_NCC'] = $request->brand_dc;
        //$data['brand_slug'] = $request->brand_slug;
    	//$data['brand_desc'] = $request->brand_product_desc;
        //$data['brand_status'] = $request->brand_product_status;
        $data['TEN_NCC'] = $request->TEN_NCC;
        $data['SDT_NCC'] = $request->SDT_NCC;
        $data['DC_NCC'] = $request->DC_NCC;
        $data['brand_slug'] = $request->slug;
        $data['brand_desc'] = $request->desc;
        $data['brand_status'] = $request->status;
        

    	DB::table('nha_cung_cap')->insert($data);
    	Session::put('message','Thêm nhà cung cấp thành công');
    	return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('nha_cung_cap')->where('ID_NCC',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('nha_cung_cap')->where('ID_NCC',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('nha_cung_cap')->where('ID_NCC',$brand_product_id)->get();

        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
   public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['TEN_NCC'] = $request->TEN_NCC;
        $data['SDT_NCC'] = $request->SDT_NCC;
        $data['DC_NCC'] = $request->DC_NCC;
        $data['brand_slug'] = $request->slug;
        $data['brand_desc'] = $request->desc;
        DB::table('nha_cung_cap')->where('ID_NCC',$brand_product_id)->update($data);
        Session::put('message','Cập nhật nhà cung cấp thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('nha_cung_cap')->where('ID_NCC',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page
     
     public function show_brand_home($brand_slug){
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        $brand_by_id = DB::table('thuoc')->join('chi_tiet_lo','thuoc.ID_THUOC','=','chi_tiet_lo.ID_THUOC')
        ->join('lo','chi_tiet_lo.ID_LO','=','lo.ID_LO')
        ->join('nha_cung_cap','lo.ID_NCC','=','nha_cung_cap.ID_NCC')
        ->where('nha_cung_cap.brand_slug',$brand_slug)->get();
        $brand_name = DB::table('nha_cung_cap')->where('nha_cung_cap.brand_slug',$brand_slug)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
