<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;
    	$product_info = DB::table('thuoc')->where('ID_THUOC',$productId)->first(); 

    
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] = $product_info->ID_THUOC;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->TEN_THUOC;
        $data['price'] = $product_info->DON_GIA;
        $data['weight'] = $product_info->DON_GIA;
        $data['options']['image'] = $product_info->HINH_ANH;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');
       
    }
    public function show_cart(){

        $cate_product = DB::table('goc_thuoc')->where('category_status','0')->orderby('ID_GOC','desc')->get(); 
       $brand_product = DB::table('nha_cung_cap')->where('brand_status','0')->orderby('ID_NCC','desc')->get();
       $vc =DB::table('hinh_thuc_van_chuyen')->get();
       return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('vc',$vc);
         $vc =DB::table('hinh_thuc_van_chuyen')->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('vc',$vc);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
  public function update_cart_quantity(Request $request){
        $idthuoc=$request->idthuoc;
        $soluongton=DB::table('thuoc')->where('ID_THUOC',$idthuoc)->value('SO_LUONG_TON');
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        if ($qty<=$soluongton){
            Cart::update($rowId,$qty);
            return Redirect::to('/show-cart');
        }
        else {
           
            return Redirect::to('/show-cart');
        }
        // print_r($soluongton);
    }
    
}
