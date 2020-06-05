<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
    	$all_category_product = DB::table('goc_thuoc')->get();
    	$manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);


    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['GOC_THUOC'] = $request->category_product_name;
        $data['slug_category_product'] = $request->slug_category_product;
    	//$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('goc_thuoc')->insert($data);
    	Session::put('message','Thêm gốc thuốc thành công');
    	return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('goc_thuoc')->where('ID_GOC',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt gốc thuốc thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('goc_thuoc')->where('ID_GOC',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt gốc thuốc thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('goc_thuoc')->where('ID_GOC',$category_product_id)->get();

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['GOC_THUOC'] = $request->category_product_name;
        $data['slug_category_product'] = $request->slug_category_product;
       // $data['category_desc'] = $request->category_product_desc;
        DB::table('goc_thuoc')->where('ID_GOC',$category_product_id)->update($data);
        Session::put('message','Cập nhật gốc thuốc thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('goc_thuoc')->where('ID_GOC',$category_product_id)->delete();
        Session::put('message','Xóa gốc thuốc thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home($slug_category_product){
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

        $category_by_id = DB::table('thuoc')->join('goc_thuoc','thuoc.ID_GOC','=','goc_thuoc.ID_GOC')->where('goc_thuoc.slug_category_product',$slug_category_product)->get();
        
        $category_name = DB::table('goc_thuoc')->where('goc_thuoc.slug_category_product',$slug_category_product)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
   //PRINT_R($category_name);
    }

}
