<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\Product;
use App\Location;
use App\Testimonial;
use App\Cart;
use DB;
use App\Package;
use App\Blog;
use App\ProductImage;
use App\Review;
use App\Brand;
use App\Order;
use App\OrderItem;
use App\ShippingCharge;
use App\DeWallet;
use App\DeliveryBoy;
use App\Vendor;
class LabTestController extends Controller
{
	public function labTest(Request $req){
		$lab_test = Product::where('categories',$req->category_id)->orderBy('products_id','desc')->select('*')->get();
		foreach($lab_test as $r){ 
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,2)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1; 
            }else{
                $r->user_wishlist = 0; 
            } 
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,2)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1; 
            }else{
                $r->user_cart = 0; 
            } 
        } 
    	if($lab_test != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => $lab_test->count().' record found',
    			'lab_test' => $lab_test 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
	}
}