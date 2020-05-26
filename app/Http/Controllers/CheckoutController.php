<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Carbon\Carbon;
use App\Http\Requests;
use PDF;
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
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf ->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_by_id = DB::table('don_dat_hang')
        ->join('khach_hang','don_dat_hang.ID_KH','=','khach_hang.ID_KH')
        ->join('nhan_vien','don_dat_hang.ID_NV','=','nhan_vien.ID_NV')
        ->join('hinh_thuc_van_chuyen','don_dat_hang.ID_VC','=','hinh_thuc_van_chuyen.ID_VC')
        ->join('hinh_thuc_thanh_toan','don_dat_hang.ID_HT','=','hinh_thuc_thanh_toan.ID_HT')
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        // ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        // ->join('khuyen_mai','khuyen_mai.ID_KM','=','don_dat_hang.ID_KM')
        ->where('don_dat_hang.ID_DDH',$checkout_code)
        ->select('don_dat_hang.*','khach_hang.*','nhan_vien.*','hinh_thuc_van_chuyen.*','hinh_thuc_thanh_toan.*')->first();
        $detail_order= DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('khuyen_mai','khuyen_mai.ID_KM','=','thuoc.ID_KM')
        ->where('don_dat_hang.ID_DDH',$checkout_code)
        ->select('don_dat_hang.*','thuoc.*','chi_tiet_don_dat_hang.*','khuyen_mai.*')->get();
        if(empty($detail_order)==NULL){
            $detail_order= DB::table('don_dat_hang')
            ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
            ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
            ->where('don_dat_hang.ID_DDH',$checkout_code)
            ->select('don_dat_hang.*','thuoc.*','chi_tiet_don_dat_hang.*')->get();
        }
        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id)->with('detail_order',$detail_order);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        $output ='';
        $output.='<style>body{
            font-family: DejaVu Sans;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
          }
        </style>
        <h3>SHOP BÁN THUỐC ONLINE LYNTT</h3>
        <p>Số điện thoại: 0782925679</p>
        <p>Địa chỉ: 17/140B Trần Văn Ơn Đường Nguyễn Văn Cừ Quận Ninh Kiều, Cần Thơ</p>
        <h1><center>HÓA ĐƠN THANH TOÁN</h1>
        <p>Số HĐ:  '.$detail_order->ID_DDH.'</P>
        <p>Ngày:  '.$detail_order->NGAY_DAT.'</P>
        <p>Tên khách hàng:  '.$order_by_id->TEN_KH.'</P>
        <p>Địa chỉ:  '.$order_by_id->DIA_CHI.'</P>
        <p>Số điện thoại:  '.$order_by_id->SDT.'</P>
        <p>Hình thức vận chuyển:  '.$order_by_id->TEN_HT.'</P>
        <table style="width:100%">
        <thead>
        <tr>
        <th>Tên thuốc</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        </tr>
        <tbody>';
        $output.='
        <tr>
        <td>'.$detail_order->TEN_THUOC.'</td>
        <td>'.$detail_order->SO_LUONG.'</td>
        <td>'.$detail_order->DON_GIA.'</td>
        <td>'.$detail_order->THANH_TIEN.'</td>
        </tr>';
        $output.='
        </tbody>

        </thead>
        </table>
        <p>Tổng tiền:  '.$detail_order->TONG_DDH.' </P>
        <p>Khuyến mãi:  '.$detail_order->GIA_TRI_KM.'</P>
        <p><b>Phí vận chuyển: </b></P>
        <p><b>Tổng thanh toán: </b></P>
        <h3><center>CẢM ƠN QUÝ KHÁCH HÀNG</center></h3>
        ';
        return $output;
    }
   public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('don_dat_hang')
        ->join('khach_hang','don_dat_hang.ID_KH','=','khach_hang.ID_KH')
        ->join('nhan_vien','don_dat_hang.ID_NV','=','nhan_vien.ID_NV')
        ->join('hinh_thuc_van_chuyen','don_dat_hang.ID_VC','=','hinh_thuc_van_chuyen.ID_VC')
        ->join('hinh_thuc_thanh_toan','don_dat_hang.ID_HT','=','hinh_thuc_thanh_toan.ID_HT')
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        // ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        // ->join('khuyen_mai','khuyen_mai.ID_KM','=','don_dat_hang.ID_KM')
        ->where('don_dat_hang.ID_DDH',$orderId)
        ->select('don_dat_hang.*','khach_hang.*','nhan_vien.*','hinh_thuc_van_chuyen.*','hinh_thuc_thanh_toan.*')->first();
        $detail_order= DB::table('don_dat_hang')
        ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('khuyen_mai','khuyen_mai.ID_KM','=','thuoc.ID_KM')
        ->where('don_dat_hang.ID_DDH',$orderId)
        ->select('don_dat_hang.*','thuoc.*','chi_tiet_don_dat_hang.*','khuyen_mai.*')->get();
        if(empty($detail_order)==NULL){
            $detail_order= DB::table('don_dat_hang')
            ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
            ->join('thuoc','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
            ->where('don_dat_hang.ID_DDH',$orderId)
            ->select('don_dat_hang.*','thuoc.*','chi_tiet_don_dat_hang.*')->get();
        }
        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id)->with('detail_order',$detail_order);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        // print_r($detail_order);
        
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
        $id_km=$request->offer;
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
      
        // $total= Cart::total(0,'','');

        $content = Cart::content();
        foreach($content as $v_content){
            $total=$v_content->price * $v_content->qty;
        }
        
        // $total_convert=chop($total,',');
        $data['TONG_DDH'] = $total;
        if($id_km==NULL){
            $total_order= $vc + $total;
        }
        else { 
            $gtrikm=DB::table('khuyen_mai')->where('ID_KM',$id_km)->value('GIA_TRI_KM');
            $total_order= ($vc + $total) - ($vc + $total)*$gtrikm;
        }
       
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
            $thuocton=DB::table('thuoc')->where('ID_THUOC',$v_content->id)->value('SO_LUONG_TON');
            $thuocconlai=$thuocton - $v_content->qty;
            DB::table('chi_tiet_don_dat_hang')->insert($order_d_data);
            DB::table('thuoc')->where('ID_THUOC',$v_content->id)->update(['SO_LUONG_TON'=>$thuocconlai]);
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
        ->join('nhan_vien','don_dat_hang.ID_NV','=','nhan_vien.ID_NV')
        // ->join('chi_tiet_don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        ->join('trang_thai','don_dat_hang.ID_TT','=','trang_thai.ID_TT')
        ->select('don_dat_hang.*','khach_hang.*','nhan_vien.*','trang_thai.*')
        ->orderby('don_dat_hang.ID_DDH','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
