<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
    	return view('admin.dashboard');
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
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/admin');
        }
        // print_r($result);
       
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('TEN_NV',null);
        Session::put('ID_NV',null);
        return Redirect::to('/admin');
    }
}
