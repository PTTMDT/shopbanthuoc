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

class CheckoutController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
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
    	$data['EMAIL_KH'] = $request->customer_email;
    	$data['PASSWORD'] = md5($request->customer_password);
        $data['DIA_CHI'] = $request->address;
        $data['ID_LKH'] = 1;
    	$customer_id = DB::table('khach_hang')->insertGetId($data);

    	Session::put('ID_KH',$customer_id);
    	Session::put('TEN_KH',$request->customer_name);
    	return Redirect::to('/checkout');


    }
    public function checkout(){
    	$cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        $id_customer=Session::get('ID_KH');
        $customer=DB::table('khach_hang')->where('ID_KH',$id_customer)->get();
        $tranport=DB::table('hinh_thuc_van_chuyen')->get();
        $payment=DB::table('hinh_thuc_thanh_toan')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('customer',$customer)->with('tranport',$tranport)->with('payment',$payment);
        // print_r($customer);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $id_customer=Session::get('ID_KH');
        $shipping_id=$request->vanchuyen;
        $vc=DB::table('hinh_thuc_van_chuyen')->select('GIA_VC')->where('ID_VC',$shipping_id)->value('GIA_VC');
        $data['ID_VC'] =$request->vanchuyen;
        $data['ID_KH']=$id_customer;
        $data['ID_HT'] = $request->thanhtoan;
        $data['ID_TT'] = 1;
        $data['ID_TIENTE'] = 1;
        $data['ID_KM']=$request->offer;
        $data['ID_NV']=1;
        $date=Carbon::now('Asia/Ho_Chi_Minh');  //NGÀY HIỆN TẠI
        $data['NGAY_DAT']=$date->toDateString();
    	// $data['shipping_phone'] = $request->shipping_phone;
    	// $data['shipping_email'] = $request->shipping_email;
    	$data['GHI_CHU'] = $request->shipping_notes;
        // $data['shipping_address'] = $request->shipping_address;
      
        $total= Cart::total(0,'','');
        // $total_convert=chop($total,',');
        $data['TONG_DDH'] = $total;
        
        $total_order= $vc + $total;
        $data['THANH_TIEN']=  $total_order;
    	$id_DDH= DB::table('don_dat_hang')->insertGetId($data);

        Session::put('ID_VC',$shipping_id);
        Session::put('ID_DDH',$id_DDH);
    	
        return Redirect::to('/payment');
        // print_r($total_order);
        // print_r($tranport);
    }
    public function payment(){
        $id_DDH=Session::get('ID_DDH');
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        $order=DB::table('don_dat_hang')->where('ID_DDH',$id_DDH)
              ->join('hinh_thuc_van_chuyen','don_dat_hang.ID_VC','=','hinh_thuc_van_chuyen.ID_VC')
              ->orderby('ID_DDH','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product) ->with('brand',$brand_product)->with('order',$order);

    }
    public function order_place(Request $request){
        //insert payment_method
     
        // $data = array();
        // $data['TEN_HT'] = $request->payment_option;
        // // $data['payment_status'] = 'Đang chờ xử lý';
        // $payment_id = DB::table('hinh_thuc_thanh_toan')->insertGetId($data);
        // //insert payment_status
     
        // $data = array();
        // $data['payment_status'] = $request->TEN_TT;
        // // $data['payment_status'] = 'Đang chờ xử lý';
        // $payment_id = DB::table('trang_thai')->insertGetId($data);
        // //insert order
        // $order_data = array();
        // $order_data['ID_KH'] = Session::get('ID_KH');
        // $order_data['ID_VC'] = Session::get('ID_VC');
        // $order_data['ID_HT'] = $payment_id;
        // $order_data['TONG_DDH'] = Cart::total();
        // $order_data['GHI_CHU'] = $
        // $order_id = DB::table('DON_DAT_HANG')->insertGetId($order_data);

        //insert order_details
        $id_DDH=Session::get('ID_DDH');
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['ID_DDH'] = $id_DDH;
            $order_d_data['ID_THUOC'] = $v_content->id;
            // $order_d_data[''] = $v_content->name;
            $order_d_data['DON_GIA'] = $v_content->price;
            $order_d_data['SO_LUONG'] = $v_content->qty;
            DB::table('chi_tiet_don_dat_hang')->insert($order_d_data);
        }
        // if($data['payment_method']==1){

        //     echo 'Thanh toán thẻ ATM';

        // }elseif($data['payment_method']==2){
        //     Cart::destroy();
        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get();
        $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get(); 
        return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

        // }else{
        //     echo 'Thẻ ghi nợ';

        // }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->EMAIL_KH;
    	$password = md5($request->PASSWORD);
    	$result = DB::table('khach_hang')->where('EMAIL_KH',$email)->where('PASSWORD',$password)->first();
    	
    	if($result){
    		Session::put('ID_KH',$result->ID_KH);
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
