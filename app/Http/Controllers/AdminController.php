<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('ID_NV');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }
   public function show_dashboard(){
        $this->AuthLogin();
        $date=Carbon::now('Asia/Ho_Chi_Minh'); // ngày giờ hiện tại
        $ngay= $date->toDateString();  // ngày hiện tại
        $thuoc=DB::table('thuoc')->count(); // đếm số lượng thuốc
        $thuochethan=DB::table('chi_tiet_lo') 
        ->join('thuoc','chi_tiet_lo.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('lo','chi_tiet_lo.ID_LO','=','lo.ID_LO')
        ->select('thuoc.*','chi_tiet_lo.*','lo.*')->get();
        $ngayhethan= array();
        foreach($thuochethan as $value){    // tìm thuốc có ngày hết hạn trong 30 ngày 
            $hh=$value->NGAY_HH;
            $prevMonth = Carbon::parse($ngay);
            $thisMonth = Carbon::parse($hh);
            // $part1 = ($prevMonth->format('Y') * 12) + $prevMonth->format('m');
            // $part2 = ($thisMonth->format('Y') * 12) + $thisMonth->format('m');
            $nam = abs(($thisMonth->format('Y')-$prevMonth->format('Y'))*365) ;
            $thang =abs(($thisMonth->format('m')-$prevMonth->format('m'))*30) ;
            $ngayhh= abs($thisMonth->format('d')  - $prevMonth->format('d'));
            $diff = $nam + $thang + $ngayhh ; // To make the result always positive abs()
            // return $ngay." ".$hh." ".$nam." ".$thang." ".$ngayhh;
            // print_r($diff);
            if($diff<=30){
             array_push($ngayhethan,$value);
            }
        }
            // print_r( $ngayhethan); 
             $khachhang=DB::table('khach_hang')->count(); // đếm số khách hàng
        $order=DB::table('don_dat_hang')->count(); // đếm số đơn đặt hàng

        $doanhthu=DB::table('don_dat_hang')->where('NGAY_DAT','=',$ngay)->sum('THANH_TIEN'); // tính doanh thu ngày
        $thuocbanchay=DB::table('thuoc') // đếm những thuốc có số lượng bán nhiều nhất
        // DB::raw('COUNT(thuoc.TEN_THUOC) as SOLUONGBAN'))
        ->join('chi_tiet_don_dat_hang','chi_tiet_don_dat_hang.ID_THUOC','=','thuoc.ID_THUOC')
        ->join('don_dat_hang','don_dat_hang.ID_DDH','=','chi_tiet_don_dat_hang.ID_DDH')
        ->select('thuoc.*','chi_tiet_don_dat_hang.*','don_dat_hang.*',DB::raw('COUNT(thuoc.TEN_THUOC) as SOLUONGBAN'))
        ->groupBy('thuoc.TEN_THUOC')
        ->orderBy('SOLUONGBAN','desc')
        ->limit(6)
        ->get();
        // $ngay_today = Carbon::parse($ngay);
        // print_r($ngay_today);
         $doanhthuthang= array();
        //  $i=1;
        //  while($i<=12){
            // $ngay_homnay= $ngay->subDay(2);
            // $date_today = $ngay_homnay->toDateString();

            $dothidoanhthu=DB::table('don_dat_hang')  //tổng đơn theo ngày
            ->select(DB::raw('MONTH(don_dat_hang.NGAY_DAT) as THANG') ,DB::raw('SUM(don_dat_hang.THANH_TIEN) as DOANHTHU'))
            // ->where('THANG',$i)
            ->groupBy('THANG')
            ->orderBy('THANG','desc')
            ->get();
            // if(empty($dothidoanhthu)==NULL){
            //     array_push($doanhthuthang,'THANG'=$i,'DOANHTHU'=0);
            // }
            // array_push($doanhthuthang,$dothidoanhthu);
   
       
       
         return view('admin.dashboard')->with('thuoc', $thuoc )->with('dondathang', $order)->with('khachhang',$khachhang)->with('doanhthu',$doanhthu)->with('thuochethan',$ngayhethan)->with('thuocbanchay',$thuocbanchay)->with('doanhthuthang',$dothidoanhthu);
        //    print_r($ngayhethan);
        
   }
    public function dashboard(Request $request){
    	$admin_email = $request->EMAIL_NV;
    	$admin_password = md5($request->PASSWORD);
        // print_r($admin_email);
        // print_r($admin_password);
        $result = DB::table('nhan_vien')->where('EMAIL_NV',$admin_email)->where('PASSWORD',$admin_password)->first();
    	if($result){
            Session::put('TEN_NV',$result->TEN_NV);
            Session::put('ID_NV',$result->ID_NV);
            Session::put('ID_LOAI',$result->ID_LOAI);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/admin');
        }
        // print_r($result);
       
    }
    public function mkdashboard(){
        $this->AuthLogin();
    

        return view('admin.xthucmk');

        
       
        //  $data['PASSWORD'] = $request->password;
         
        // $passwordold = $request->passwordold;
        // $passwordnew = $request->passwordnew;
        //$password = $request->password;
        // $result = DB::table('nhan_vien')->where('ID_NV',$admin_id)->where('passwordold',$passwordold)->first();
    	// if($result){
        //     Session::put('TEN_NV',$result->TEN_NV);
        //     Session::put('ID_NV',$result->ID_NV);
        //     return Redirect::to('/updateNV-product');
        // }else{
        //     Session::put('message','Mật khẩu bị sai.Làm ơn nhập lại');
        //     return Redirect::to('/mkdashboard');
        // }
        //  print_r($result);
       
    }
    public function updateMK_product(Request $request){
        $this->AuthLogin();
        $admin_id = Session::get('ID_NV');
        return view('admin.newpass');
    //    $data = array();

    //     $data['PASSWORD'] = $request->password;
    //    DB::table('nhan_vien')->where('ID_NV',$admin_id)->update($data);
    //    Session::put('message','Cập nhật mật khẩu nhân viên thành công');
    //    return Redirect::to('/admin');
       
   }
   public function check_updateMK(Request $request){
    $this->AuthLogin();
    $admin_id = Session::get('ID_NV');

    $data = array();
    $mk=$request->PASSWORD;
    $mk1=$request->password1;

    if($mk===$mk1){
    $data['PASSWORD'] =md5($mk);
    DB::table('nhan_vien')->where('ID_NV',$admin_id)->update($data);
    Session::put('message','Cập nhật mật khẩu nhân viên thành công');
    return Redirect::to('/admin');
    }
    else {
    Session::put('message','Mật khẩu nhân viên không khớp');
    return Redirect::to('/updateMK-product');
    }
    // print_r($mk);
    // print_r($mk1);


   
}  
public function mkdashboard_xt(Request $request){
   
    $admin_password = md5($request->password);
    // print_r($admin_email);
    // print_r($admin_password);
    $result = DB::table('nhan_vien')->where('PASSWORD',$admin_password)->first();
    if($result){
       
        return Redirect::to('/updateMK-product');
    }else{
        Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
        return Redirect::to('/mkdashboard');
    }
    // print_r($result);
   
}
    public function ttinNV_product(){
        $admin_id = Session::get('ID_NV');
        $NV_by_id = DB::table('nhan_vien')
        ->join('loai_nhan_vien','loai_nhan_vien.ID_LOAI','=','nhan_vien.ID_LOAI')
        ->select('nhan_vien.*','loai_nhan_vien.*')
        ->where('nhan_vien.ID_NV',$admin_id)->first();
        return view ('admin.ttinNv')->with ('NV_by_id',$NV_by_id) ;
        // print_r($NV_by_id);
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('TEN_NV',null);
        Session::put('ID_NV',null);
        return Redirect::to('/admin');
    }
}
