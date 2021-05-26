<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Auth;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use DB;
use Mail; 

use App\User;
use App\DeWallet;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
use App\Notification;
class OrderController extends Controller
{ 

    public function viewOrderDetail($order_id){
    	$data['flag'] = 2; 
    	$data['page_title'] = 'View Order Details'; 
        $data['order1'] = Order::where('order_id',$order_id)->first(); 
    	$data['order'] = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get(); 
    	$data['order_status1'] = DB::table('order_status')->get();
    	return view('admin/webviews/admin_manage_order',$data);
    } 

    public function viewOrderDetailTester($order_id){
    	$data['flag'] = 4; 
    	$data['page_title'] = 'View Order Details'; 
        $data['order1'] = Order::where('order_id',$order_id)->where('is_testing',1)->first(); 
    	$data['order'] = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get(); 
    	$data['order_status1'] = DB::table('order_status')->get();
    	return view('admin/webviews/admin_manage_order',$data);
    } 

    public function viewOrder(){
        $data['flag'] = 1; 
        $data['page_title'] = 'Webstore Order';     	
        $data['order'] = Order::orderBy('id','desc')->where('is_testing',0)->where('shop_id',null)->get(); 
        $data['order_status'] = DB::table('order_status')->get();
        // dd($data);
        return view('admin/webviews/admin_manage_order',$data);
    } 

    public function viewOrderkarnal(){
        $data['flag'] = 5; 
        $data['page_title'] = 'Karnal Shop Order';     	
        $data['order'] = Order::orderBy('id','desc')->where('shop_id',101)->get();
        // $data['order_status'] = DB::table('order_status')->get();
        // dd($data);
        return view('admin/webviews/admin_manage_order',$data);
    }

    public function cust_invoice_details($order_id){
  
       // dd($order_id);
    $orderDetails = DB::table('orders')->where('order_id', $order_id)->first();
    // dd($orderDetails);
     // $orders = DB::table('order_items')->where('order_id',$order_id)->get();
     $orderStatus = DB::table('order_status')->get();
     $shop_id = 101;
     // $data['order'] = DB::table('order_items')    
     // ->join('products', 'products.products_id', '=', 'order_items.prod_id')
     // ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
     // ->select('order_items.*','products.product_name','products.price','gst_tax.gst_value_percentage')
     // ->where('order_items.order_id','=', $order_id )
     // ->get(); 
      $data['order'] = DB::table('order_items')
             ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
             ->join('shop_stocks', 'shop_stocks.attribute_id', '=', 'order_items.prod_id')
             ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
             ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')
             ->join('product_attributes','product_attributes.id','=','order_items.prod_id')                       
             ->select('order_items.prod_name','product_attributes.price','product_attributes.per_stript_qty','order_items.sub_total','order_items.prod_id','order_items.quantity','gst_tax.gst_value_percentage','orders.amount','orders.order_id','orders.used_Decoin_amt','orders.created_at')
             ->where('orders.order_id','=', $order_id)
             ->where('shop_stocks.shop_id','=',$shop_id)
             ->get(); 
     //  dd($data['order']);  
 
     $data['gst_no'] =  DB::table('shop_infos')->where('id',$shop_id)->select('gst_no')->first();
    
    $data['orderDetails'] = $orderDetails;
 //    $data['order'] = $orders;
    $data['orderStatus'] = $orderStatus;
  
 //    $data['gst_count']=DB::select("select gst_tax.gst_value_percentage,SUM(order_items.sub_total * order_items.quantity) AS total from shop_stocks INNER join gst_tax ON(gst_tax.gst_id = shop_stocks.tax) INNER JOIN order_items ON(shop_stocks.products_id=order_items.prod_id) INNER JOIN orders ON(orders.order_id=order_items.order_id) WHERE( shop_stocks.shop_id= $shop_id AND orders.order_id= $order_id) GROUP BY(gst_tax.gst_value_percentage)"); 
 //    $data['gst_count']=DB::select("SELECT * FROM order_items LEFT JOIN product_attributes p_attr ON(p_attr.id=order_items.prod_id)LEFT JOIN products ON(products.products_id=p_attr.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)WHERE(order_items.order_id=60439d3c4fc06) GROUP BY(gst_tax.gst_id)"); 
    $data['gst_count'] = DB::table('order_items')
     ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
     ->join('product_attributes', 'product_attributes.id', '=', 'order_items.prod_id')
     ->join('products', 'products.products_id', '=', 'product_attributes.products_id')
     ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')                                
     ->selectRaw('SUM(order_items.sub_total * order_items.quantity) AS total,order_items.prod_name , product_attributes.price,order_items.sub_total,order_items.prod_id,order_items.quantity,gst_tax.gst_value_percentage,orders.amount,orders.order_id')
     ->where('order_items.order_id','=', $order_id)
     ->groupBy('gst_tax.gst_id')
     ->get(); 
 
 //    dd($data['gst_count']); 
    return view('admin.components/admin_view_invoice_details',$data);
}

    

    public function viewOrderTester(){
        $data['flag'] = 3; 
        $data['page_title'] = 'View Order Tester';     	
        $data['order'] = Order::orderBy('id','desc')->where('is_testing',1)->get();             

        $data['order_status'] = DB::table('order_status')->get(); 
       
        return view('admin/webviews/admin_manage_order',$data);
    } 

	//public function orderStatusUpdate(Request $req){   
//         $total_sub_order = OrderItem::where('order_id',$req->order_id)->get();
//         OrderItem::where('sub_order_id',$req->sub_order_id)->update([
//          'order_status'=>$req->order_status
//         ]); 
		
//         $order = new OrderStatusHistory;
//         $order->order_id = $req->order_id;
//         $order->sub_order_id = $req->sub_order_id;
//         $order->order_status = $req->order_status;
//         $order->change_by = Auth::user()->id; 
//         $order->save();
    	
    
//         $user_id = DB::table('orders')->where('order_id',$req->order_id)->first();
//         $vendor_id = DB::table('order_items')->where('sub_order_id',$req->sub_order_id)->first(); 

//         $data = DB::table('de_wallets')->where('user_id',$user_id->user_id)->first(); 
//         $data1 = $data->coin;
//         if ($vendor_id->extra_discount != null) {
//             $total = $vendor_id->quantity * $vendor_id->sub_total - (($vendor_id->extra_discount * $vendor_id->sub_total) / 100);
//         }else{
//             $total = $vendor_id->quantity * $vendor_id->sub_total;
//         }
    
//         $tempdamount = floor($total/5);
//         if ($req->order_status == 6){ 
//         	$damount = $data1-$tempdamount;
//             DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
//                 'coin' => $damount
//             ]);
//         } 
//        /*if ($req->order_status == 5){ 
//        		$damount = $data1+$tempdamount;
//        		DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
//                 'coin' => $damount
//             ]);
//        }*/

// 		// $user = User::where('id',$user_id->user_id)->first();
// 		// $to = $user['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user->name.", \nYour OrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';        
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }  

// 		// $user1 = User::where('user_type',1)->first();
// 		// $to = $user1['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user1->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';              
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }       

// 		// $user2 = User::where('id',$vendor_id->assign_vendor_id)->first();
// 		// $to = $user2['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user2->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';              
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }          
//         return back()->with('msg','Order Status Change successfully');
//     }
	public function orderStatusUpdate(Request $req){  
      
       
        $r = OrderItem::where('sub_order_id',$req->sub_order_id)->update([
           'order_status'=>$req->order_status,
           'status_updated_by'=>$req->user_id
        ]); 

         $r1 = Order::where('order_id',$req->order_id)->update([
            'order_status'=>$req->order_status
         ]); 

     
        $order = new OrderStatusHistory;
        $order->order_id = $req->order_id;
        $order->sub_order_id = $req->sub_order_id;
        $order->order_status = $req->order_status;
        $order->change_by = Auth::user()->id; 
        $order->save();

        $user_id = Order::where('order_id',$req->order_id)->first(); 
        $order_detail = OrderItem::where('sub_order_id',$req->sub_order_id)->first();
        if($order_detail->type == 1){
            $status = DB::table('order_status')->where('status_value',$req->order_status)->where('type',1)->pluck('status_name')->first(); 
        }elseif($order_detail->type == 2 || $order_detail->type == 3){
            $status = DB::table('order_status')->where('status_value',$req->order_status)->where('type',2)->pluck('status_name')->first(); 
        } 
        if($req->order_status == 5){ 
            if($order_detail->extra_discount != null){
                $discount = ($order_detail->sub_total * $order_detail->extra_discount)/100 ; //dd($discount);  
                $total = $order_detail->quantity * $order_detail->sub_total - $discount * $order_detail->quantity; 
            }else{
                $total = $order_detail->quantity * $order_detail->sub_total;
            } 
            
            $damount = round($total/10);
            $walletCnt = DB::table('de_wallets')->where('user_id',$user_id->user_id)->pluck('coin')->first(); 
        	//dd($walletCnt);
            if(!empty($walletCnt)){ 
                DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                    'coin'=>  $damount + $walletCnt 
                ]);

                OrderItem::where('sub_order_id',$req->sub_order_id)->update([
                   'earn_dewallet_coin'=>$damount  
                ]); 
                if ($user_id->user_phone != null) {
                    $msg = urlencode("Congratulations! ".$damount." D-Coins have been added to your Account  Details have been sent to your registered e-mail");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" .$user_id->user_phone. "&message=" . $msg);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($curl);
                    curl_close($curl);
                }
            }
        }

        // $total_sub_order = OrderItem::where('order_id',$req->order_id)->where('order_status',5)->orwhere('order_status',3)->count();
        // $total_sub_order1 = OrderItem::where('order_id',$req->order_id)->count();
        // if($total_sub_order1 == $total_sub_order1){
        //     Order::where('order_id',$req->order_id)->update([
        //        'order_status'=>3 
        //     ]); 
        // }
		$total_sub_order1 = OrderItem::where('order_id',$req->order_id)->where('order_status',5)->where('type',1)->count();
        $total_sub_order2 = OrderItem::where('order_id',$req->order_id)->count();
        $total_sub_order3 = OrderItem::where('order_id',$req->order_id)->where('order_status',3)->where('type',2)->count();
        //$total_sub_order4 = OrderItem::where('order_id',$req->order_id)->where('type',2)->count();
        $total_sub_order5 = OrderItem::where('order_id',$req->order_id)->where('order_status',3)->where('type',3)->count();
        //$total_sub_order6 = OrderItem::where('order_id',$req->order_id)->where('type',2)->count();

        // $total_sub_order = OrderItem::where('order_id',$req->order_id)->where('order_status',5)->orwhere('order_status',3)->count();
        // $total_sub_order1 = OrderItem::where('order_id',$req->order_id)->count();
        if($total_sub_order2 == $total_sub_order1+$total_sub_order3+$total_sub_order5){
            Order::where('order_id',$req->order_id)->update([
               'order_status'=>2 
            ]); 
        }
        if ($user_id->user_phone != null) {
            $msg = urlencode("Your Order is ".$status." Of this orderid:- ".$req->sub_order_id.".                                   Stay Home!!! Stay Safe!!");
            $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" .$user_id->user_phone. "&message=" . $msg);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
        }
        if($user_id->user_email != null){
            $to_name = $user_id->user_name;
            $to_email = $user_id->user_email; 
            Mail::send('emails.order-info', ['user' => $order_detail], function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)
                ->subject('Order Status Update');
                $message->from('support@drhelpdesk.in','Drhelpdesk');
            }); 
        }
        
        // $total_sub_order = OrderItem::where('order_id',$req->order_id)->get();
        // OrderItem::where('sub_order_id',$req->sub_order_id)->update([
        //  'order_status'=>$req->order_status
        // ]); 
		
        // $order = new OrderStatusHistory;
        // $order->order_id = $req->order_id;
        // $order->sub_order_id = $req->sub_order_id;
        // $order->order_status = $req->order_status;
        // $order->change_by = Auth::user()->id; 
        // $order->save();
    	
    
        // $user_id = DB::table('orders')->where('order_id',$req->order_id)->first();
        // $vendor_id = DB::table('order_items')->where('sub_order_id',$req->sub_order_id)->first(); 

        // $data = DB::table('de_wallets')->where('user_id',$user_id->user_id)->first(); 
        // $data1 = $data->coin;
        // if ($vendor_id->extra_discount != null) {
        //     $total = $vendor_id->quantity * $vendor_id->sub_total - (($vendor_id->extra_discount * $vendor_id->sub_total) / 100);
        // }else{
        //     $total = $vendor_id->quantity * $vendor_id->sub_total;
        // }
    
        // $tempdamount = floor($total/5);
        // if ($req->order_status == 6){ 
        // 	$damount = $data1-$tempdamount;
        //     DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
        //         'coin' => $damount
        //     ]);
        // } 
       /*if ($req->order_status == 5){ 
       		$damount = $data1+$tempdamount;
       		DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                'coin' => $damount
            ]);
       }*/

		// $user = User::where('id',$user_id->user_id)->first();
		// $to = $user['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user->name.", \nYour OrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';        
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }  

		// $user1 = User::where('user_type',1)->first();
		// $to = $user1['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user1->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';              
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }       

		// $user2 = User::where('id',$vendor_id->assign_vendor_id)->first();
		// $to = $user2['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user2->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';              
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }          
        return back()->with('msg','Order Status Change successfully');
    }

    public function orderStatuscancle(Request $req){  
       
        $r = OrderItem::where('sub_order_id',$req->sub_order_id)->update([
            'order_status'=>$req->order_status1,
           'status_updated_by'=>$req->user_id
        ]); 

         $r1 = Order::where('order_id',$req->order_id)->update([
            'order_status'=>$req->order_status
         ]); 
         return back()->with('msg','Order Cancle successfully');
    }

    public function vendorAssign(Request $req)
    {
        OrderItem::where('sub_order_id',$req->sub_order_id)->update([
         'assign_vendor_id'=>$req->assign_vendor_id,
         'update_status_id'=>Auth::user()->id
        ]);

        $vendor = new OrderAssignHistory;
        $vendor->order_id = $req->order_id;
        $vendor->sub_order_id = $req->sub_order_id;
        $vendor->assign_vendor_id = $req->assign_vendor_id;
        $vendor->comment = $req->comment;
        $vendor->user_type = 4;
        $vendor->assign_by = Auth::user()->id; 
        $vendor->save();
        return back()->with('msg','Vendor Status Change successfully');
    }

    public function deliveryBoyAssign(Request $req)
    {
        OrderItem::where('sub_order_id',$req->sub_order_id)->update([
         'assign_delivery_boy_id'=>$req->assign_delivery_boy_id,
         'update_status_id'=>Auth::user()->id
        ]);

        $vendor = new OrderAssignHistory;
        $vendor->order_id = $req->order_id;
        $vendor->sub_order_id = $req->sub_order_id;
        $vendor->assign_vendor_id = $req->assign_delivery_boy_id;
        $vendor->comment = $req->comment;
        $vendor->user_type = 5; 
        $vendor->assign_by = Auth::user()->id; 
        $vendor->save();
        return back()->with('msg','Delivery Boy Status Change successfully');
    }

	public function testingReportUploaded(Request $req){   
        if($req->hasFile('lab_report')) {
            $file = $req->file('lab_report');
            $filename = 'lab_report'.time().'.'.$req->lab_report->extension();
            $destinationPath = storage_path('../public/upload/labreort');
            $file->move($destinationPath, $filename);
            $labreport = 'upload/labreort/'.$filename;
        }else{
            $labreport = $req->lab_report;
        }

        $order = OrderItem::where('id',$req->id)->first();
        $user = Order::where('order_id',$order->order_id)->pluck('user_id')->first();
        OrderItem::where('id',$req->id)->update([ 
            'lab_report' => $labreport 
        ]);  
        $title='Testing Report Uploaded'; 
        $message = 'Testing Report Uploaded';
        $user = User::where('id',$user)->first(); 
        $notObj = new Notification(); 
        $regId = $user->device_token;
        $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $labreport); 
        
        $resdata = json_decode($response, true);
        return back()->with('msg','Report Uploaded Successfully');
    }

	public function awbNumberUpdate(Request $req){    
        Order::where('order_id',$req->order_id)->update([ 
            'awb_number' => $req->awb_number 
        ]);  
        return back()->with('msg','Awb Number Enter Successfully');
    }
} 