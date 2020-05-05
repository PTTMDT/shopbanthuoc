<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('nhan_vien')->send();
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('don_dat_hang')
        ->join('khach_hang','don_dat_hang.ID_KH','=','khach_hang.ID_KH')
        ->join('hinh_thuc_van_chuyen','don_dat_hang.ID_VC','=','hinh_thuc_van_chuyen.ID_VC')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        ->select('don_dat_hang.*','khach_hang.*','hinh_thuc_van_chuyen.*','chi_tiet_don_dat_hang.*')->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(){

    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request){

    	$data = array();
    	$data['TEN_KH'] = $request->customer_name;
    	$data['SDT'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['PASSWORD'] = md5($request->customer_password);

    	$customer_id = DB::table('khach_hang')->insertGetId($data);

    	Session::put('ID_KH',$customer_id);
    	Session::put('TEN_KH',$request->customer_name);
    	return Redirect::to('/checkout');


    }
    public function checkout(){
    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 

    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function save_checkout_customer(Request $request){
    	$data = array();
        $data['TEN_VC'] = $request->shipping_name;
        $data['GIA_VC'] = $request->shipping_price;
    	//$data['shipping_phone'] = $request->shipping_phone;
    	//$data['shipping_email'] = $request->shipping_email;
    	//$data['shipping_notes'] = $request->shipping_notes;
    	//$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('hinh_thuc_van_chuyen')->insertGetId($data);

    	Session::put('ID_VC',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(){

        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function order_place(Request $request){
        //insert payment_method
     
        $data = array();
        $data['TEN_HT'] = $request->payment_option;
       // $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('hinh_thuc_thanh_toan')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['ID_KH'] = Session::get('ID_KH');
        $order_data['ID_VC'] = Session::get('ID_VC');
        $order_data['ID_HT'] = $payment_id;
        $order_data['TONG_DDH'] = Cart::total();
        //$order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('don_dat_hang')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['ID_DDH'] = $order_id;
            $order_d_data['ID_lO'] = $parcel_id;
            $order_d_data['ID_THUOC'] = $v_content->id;
            $order_d_data['SO_LUONG'] = $v_content->amount;
            //$order_d_data['product_name'] = $v_content->name;
            $order_d_data['DON_GIA'] = $v_content->price;
            //$order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('chi_tiet_don_dat_hang')->insert($order_d_data);
        }
        if($data['TEN_HT']==1){

            echo 'Thanh toán thẻ ATM';

        }elseif($data['TEN_HT']==2){
            Cart::destroy();

            $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
            $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('khach_hang')->where('customer_email',$email)->where('PASSWORD',$password)->first();
    	
    	
    	if($result){
    		Session::put('ID_KH',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    	
   
    	

    }
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = DB::table('don_dat_hang')
        ->join('khach_hang','don_dat_hang.ID_KH','=','khach_hang.ID_KH')
        ->select('don_dat_hang.*','khach_hang.TEN_KH')
        ->orderby('don_dat_hang.ID_DDH','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
