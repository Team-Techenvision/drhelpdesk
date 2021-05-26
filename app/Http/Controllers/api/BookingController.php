<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\ProductImage;
use App\Product;
use App\Cart;
use App\DoctorAppointment;
use App\User;
use App\Vendor;
use App\Prescription;
use App\Package;
use App\DeWallet;
use App\VendorStatus;
use App\OrderStatusHistory;
use DB;
use Mail;
use App\OrderCouponHistory;
use App\Coupon;
use App\ShippingCharge;
use App\OrderAssignHistory;
use App\Wishlist;
use App\DeliveryTracking;
use App\Brand;
use App\Notification;

class BookingController extends Controller
{
    public function addAddress(Request $req){
        if(!$req->address_id){
            $reg = new UserAddress;

        }else{
            $req = UserAddress::find($req->address_id);
        }
        $reg->user_id = $req->user_id;
        $reg->name = $req->name;
        $reg->phone = $req->phone;
        if($req->email){
            $reg->email = $req->email;
        }
        //$reg->alternate_no = $req->alternate_no;
        $reg->address_type = $req->address_type;
        $reg->address = $req->address;
        $reg->apartment = $req->apartment;
        $reg->city = $req->city;
        $reg->state = $req->state;
        $reg->pin_code = $req->pin_code;
        $reg->country = 'india';
        $reg->save();
        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Add Successfully',
                'Address'=>UserAddress::where('id',$reg->id)->select('*')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function userAddresses(Request $req){
        $result=UserAddress::where('user_id',$req->user_id)->get();
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Addresses',
                'Address'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    /**
     * @param User $user_id
     * @param Address $address_id
     * @param Product $product_id
     * @param DeliveryType $quick_delivery [1,2(shipping needed)]
     * @param NetAmount $net_amount
     * @param TotalAmount $total_amount
     * @param Discount $total_discount
     * @param DeWalletCoin $de_wallet_coin
     * @param DeWallerPrice $de_wallet_price
     * @param Copoun $copoun_code [null,'code']
     * @param Prescription $prescription_id
     * @param PaymentMode $payment_mode
     * @param PaymentID $payment_id
     * @param PaymentStatus $payment_status
     * @param PaymentReq $payment_req_id
     * @param ShippingCharge $shipping_charge
     * #
     */
    public function placeOrderSingle(Request $req){

        $shipping = 0;
        $count = 0;
        $sub_total = 0;
        $couponPrice = 0;

        $order_id = "DHD".$req->user_id.time();
        $sub_order_id = "DHD".$req->user_id.$count.time();
        $address = DB::table('user_addresses')->where('id',$req->address_id)->first();
        $product=Product::where('products_id',$req->product_id)->first();

        if($req->quick_delivery==1){
            // $p_cat=Product::where('products_id',$req->product_id)->pluck('brand')->first();
            // $match = Vendor::where('main_category', $p_cat)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
            //shipping charge
            $brand = Product::where('products_id', $req->product_id)->pluck('brand')->first();
                        //dd($brand); die;
            $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->
            where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->
            limit(1)->pluck('vendors.user_id')->first();

            $reg = new Order;
            $reg->user_id = $req->user_id;
            $reg->order_id = $order_id;
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;
            $reg->total_discount = $req->total_discount;
            $reg->order_status = 1;
            $reg->quick_delivery = $req->quick_delivery;
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code;
            }
            $reg->prescription_id = $req->prescription_id;
            $reg->payment_mode = $req->payment_mode;
            $reg->payment_id = $req->payment_id;
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;
            $reg->user_name = $address->name;
            $reg->user_phone  = $address->phone;
            $reg->user_email  = $address->email;
            $reg->user_address = $address->address;
            $reg->user_apartment = $address->apartment;
            $reg->user_country  = 'india';
            $reg->user_state  = $address->state;
            $reg->user_city = $address->city;
            $reg->pin_code  = $address->pin_code;
            $reg->save();    //order item table


            $reg1 = new OrderItem;
            $reg1->order_id = $reg->order_id;
            $reg1->sub_order_id = $sub_order_id;
            $reg1->order_status = 1;
            $special_price=Product::where('products_id',$req->product_id)->pluck('special_price')->first();
            $price=Product::where('products_id',$req->product_id)->pluck('price')->first();
            if($special_price != null){
                $reg1->sub_total=$special_price;
            }else{
                $reg1->sub_total=$price;
            }
            $reg1->prod_name=Product::where('products_id',$req->product_id)->pluck('product_name')->first();
            $reg1->product_image=ProductImage::where('products_id',$req->product_id)->pluck('product_image')->first();
            $reg1->prod_id = $req->product_id;
            $reg1->quantity =$req->quantity;
            $reg1->extra_discount =Product::where('products_id',$req->product_id)->pluck('extra_discount')->first();
            $reg1->assign_vendor_id = $match;
            $reg1->quick_delivery = 1;
            $reg1->type= 1;
            $reg1->save();

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id;
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                    $couponPrice = $coupon->amount;;
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
            	 if($coin >= $req->de_wallet_coin){
                    $total = $coin - $req->de_wallet_coin;
                    DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                }
                // $total = $coin - $req->de_wallet_coin;
                // DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
            }

            $order_assign = new OrderAssignHistory;
            $order_assign->order_id = $reg->order_id;
            $order_assign->sub_order_id = $reg1->sub_order_id;
            $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
        	$order_assign->user_type = 4;

            $order_assign->save();

            $order_status = new OrderStatusHistory;
            $order_status->order_id = $reg->order_id;
            $order_status->sub_order_id = $reg1->sub_order_id;
            $order_status->order_status = 1;
            $order_status->save();

            if($req->payment_status == 'Failed'){
                $order =  Order::where('order_id' , $order_id)->first();
                if($order->user_phone != null || $order->user_email != null){
                    if($order->user_phone != null){
                        $msg = urlencode("Oops!!! Looks like your payment had failed due to some reasons.  Please try again.");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$order->user_phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    if($order->user_email != null){
                        $to = $order->user_email;
                        $subject = 'Order Payment Failed';
                        $message = "Oops!!! Looks like your payment had failed due to some reasons.  Please try again.";
                        $headers = 'From:support@drhelpdesk.in';
                        if(mail($to, $subject, $message, $headers)) {
                        }
                        else {
                        }
                    }
                    return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Success',
                        'order' => Order::where('order_id' , $req->order_id)->first()
                    ]);
                }
            }

        }
        elseif($req->quick_delivery==2){
            $brand = Product::where('products_id', $req->product_id)->pluck('brand')->first();
                        //dd($brand); die;
            $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->
            where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->
            limit(1)->pluck('vendors.user_id')->first();

            $reg = new Order;
            $reg->user_id = $req->user_id;
            $reg->order_id = $order_id;
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;
            $reg->total_discount = $req->total_discount;
            $reg->order_status = 1;
            $reg->quick_delivery = $req->quick_delivery;
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code;
            }
            $reg->prescription_id = $req->prescription_id;
            $reg->payment_mode = $req->payment_mode;
            $reg->payment_id = $req->payment_id;
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;
            $reg->user_name = $address->name;
            $reg->user_phone  = $address->phone;
            $reg->user_email  = $address->email;
            $reg->user_address = $address->address;
            $reg->user_apartment = $address->apartment;
            $reg->user_country  = 'india';
            $reg->user_state  = $address->state;
            $reg->user_city = $address->city;
            $reg->pin_code  = $address->pin_code;
            $reg->save();    //order item table

            $reg1 = new OrderItem;
            $reg1->order_id = $reg->order_id;
            $reg1->sub_order_id = $sub_order_id;
            $reg1->order_status = 1;
            $special_price=Product::where('products_id',$req->product_id)->pluck('special_price')->first();
            $price=Product::where('products_id',$req->product_id)->pluck('price')->first();
            if($special_price != null){
                $reg1->sub_total=$special_price;
            }else{
                $reg1->sub_total=$price;
            }
            $reg1->prod_name=Product::where('products_id',$req->product_id)->pluck('product_name')->first();
            $reg1->product_image=ProductImage::where('products_id',$req->product_id)->pluck('product_image')->first();
            $reg1->prod_id = $req->product_id;
            $reg1->quantity =$req->quantity;
            $reg1->extra_discount =Product::where('products_id',$req->product_id)->pluck('extra_discount')->first();
            $reg1->assign_vendor_id = $match;
            $reg1->quick_delivery = 2;
            $reg1->type= 1;
            $reg1->save();

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id;
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                    $couponPrice = $coupon->amount;;
                }
            }

            $order_assign = new OrderAssignHistory;
            $order_assign->order_id = $reg->order_id;
            $order_assign->sub_order_id = $reg1->sub_order_id;
            $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
        	                    $order_assign->user_type = 4;

            $order_assign->save();

            $order_status = new OrderStatusHistory;
            $order_status->order_id = $reg->order_id;
            $order_status->sub_order_id = $reg1->sub_order_id;
            $order_status->order_status = 1;
            $order_status->save();


            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
            	if($coin >= $req->de_wallet_coin){
                    $total = $coin - $req->de_wallet_coin;
                    DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                }
                //$total = $coin - $req->de_wallet_coin;
                //DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
            }

            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
              ),
            ));

            $response1 = curl_exec($curl1);

            curl_close($curl1);
            $data1 = json_decode($response1);
            $curl = curl_init();
            $token =   $data1->token;
            //dd($token);
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$address->name\",\n  \"billing_last_name\": \"$address->name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$address->email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"\",\n  \"shipping_pincode\": \"\",\n  \"shipping_country\": \"\",\n  \"shipping_state\": \"\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \"\",\n  \"order_items\": [\n    {\n      \"name\": \" $reg1->prod_name\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $reg1->sub_total\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $req->shipping_charge,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $sub_total,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
            $Shiprocket_Order_Id     =   $data->order_id;
            $Shiprocket_Shipment_Id      =   $data->shipment_id;
            DB::table('order_items')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>null,
                'awb_number'=>null
            ]);
            DB::table('orders')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>null,
                'awb_number'=>null
            ]);


            if($req->payment_status == 'Failed'){
                $order =  Order::where('order_id' , $order_id)->first();
                if($order->user_phone != null || $order->user_email != null){
                    if($order->user_phone != null){
                        $msg = urlencode("Oops!!! Looks like your payment had failed due to some reasons.  Please try again.");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$order->user_phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    if($order->user_email != null){
                        $to = $order->user_email;
                        $subject = 'Order Payment Failed';
                        $message = "Oops!!! Looks like your payment had failed due to some reasons.  Please try again.";
                        $headers = 'From:support@drhelpdesk.in';
                        if(mail($to, $subject, $message, $headers)) {
                        }
                        else {
                        }
                    }
                    return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Success',
                        'order' => Order::where('order_id' , $req->order_id)->first()
                    ]);
                }
            }
        }
    				 $order_detail = Order::where('order_id',$order_id)->first();
    				if ($address->phone!=null) {
                        $msg = urlencode("Thank you for shopping with DrHelpDesk.
                        Order ID - ".$order_id."
                        Total Amount - Rs ".$order_detail->amount."
                        Payment Mode - ".$reg->payment_mode."
                        Enjoy Shopping on Drhelpdesk.
                        Stay Home !!! Stay Safe !!!");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$address->phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    $to_name = $address->name;
                    $to_email = $address->email;
                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Order Placed');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
    				$admin = User::where('user_type',1)->first();
                    $to_name1 = $admin->name;
                    $to_email1 = $admin->email;
                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Order Placed');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
            if($match != null){
                $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                $title = "New Order";
                $message = 'New Order of this '.$order_id.' is assign to you';
                $user = User::where('id',$match)->first();
                if($user->device_token != null){
                    $notObj = new Notification();
                    $regId = $user->device_token;
                    $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                }
            }
        if ($reg && $reg1) {
            /******** insert data into crm  *********/
    		$user = User::where('id', $order_detail->user_id)->first();
        	$lmsData = array(
            	'company' => 'aensahealthsolution',
           		'lead_source' => 10,
                'division' => 1,
            	'name' => $user->name,
            	'email' => $user->email,
            	'phone' => $user->phone,
            	'order_id' => $order_id,
            	'amount' => $order_detail->amount,
            	'total_discount' => $order_detail->total_discount,
            	'order_status' => $order_detail->order_status,
            	'copoun_code' => $couponPrice,
            	'payment_mode' => $order_detail->payment_mode,
            	'shipping_charge' => $order_detail->shipping_charge,
            	'payment_status' => $order_detail->payment_status,
            	'shipping_address' => 'na',
            	'product_details' => 'na',
            );
            $url = "http://192.168.100.3:80/website-order";

            $curl = curl_init();
            $url = sprintf("%s?%s", $url, http_build_query($lmsData));

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            $result = curl_exec($curl);

			curl_close($curl);

            /************************** */
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Order Place Successfullyy',
                'user'=>Order::where('id',$reg->id)->select('id','user_id','order_id')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }

    /**
     * @param User $user_id
     * @param Address $address_id
     * @param Product $product_id
     * @param DeliveryType $quick_delivery [1,2(shipping needed)]
     * @param NetAmount $net_amount
     * @param TotalAmount $total_amount
     * @param Discount $total_discount
     * @param DeWalletCoin $de_wallet_coin
     * @param DeWallerPrice $de_wallet_price
     * @param Copoun $copoun_code [null,'code']
     * @param Prescription $prescription_id
     * @param PaymentMode $payment_mode
     * @param PaymentID $payment_id
     * @param PaymentStatus $payment_status
     * @param PaymentReq $payment_req_id
     * @param ShippingCharge $shipping_charge
     * #
     */
    public function placeOrderCart(Request $req){
    	 $vendor = [];
         $couponPrice = 0;
        if($req->quick_delivery==1){
            $data=Cart::where('user_id',$req->user_id)->get();
            $address = DB::table('user_addresses')->where('id',$req->address_id)->first();
            $order_id = "DHD".$req->user_id.time();

            $total_amount1=0;
            $sub_total= 0;
            $extra_discount = 0;
            $balance=0;
            $total_amount_with_shipping = 0;


            $reg = new Order;
            $reg->user_id = $req->user_id;
            $reg->order_id = $order_id;
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;
            $reg->total_discount = $req->total_discount;
            $reg->order_status = 1;
            $reg->quick_delivery = $req->quick_delivery;

            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;

            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code;
            }

            $reg->prescription_id = $req->prescription_id;
            $reg->payment_mode = $req->payment_mode;
            $reg->payment_id = $req->payment_id;
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;
            $reg->user_name = $address->name;
            $reg->user_phone  = $address->phone;
            $reg->user_email  = $address->email;
            $reg->user_address = $address->address;
            $reg->user_apartment = $address->apartment;
            $reg->user_country  = 'india';
            $reg->user_state  = $address->state;
            $reg->user_city = $address->city;
            $reg->pin_code  = $address->pin_code;
            $reg->save();    //order item table
            //dd($reg);
            $count=0;

            foreach ($data as $r) {
                $sub_order_id = "DHD".$req->user_id.$count.time();
                $reg1 = new OrderItem;
                $reg1->order_id = $reg->order_id;
                $reg1->sub_order_id = $sub_order_id;
                if($r->type == 1 || $r->type == 2){
                    // $categories = Product::where('products_id', $r->product_id)->pluck('brand')->first();
                    // $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                    $brand = Product::where('products_id', $r->product_id)->pluck('brand')->first();
                        //dd($brand); die;
                    $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->
                    where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->
                    limit(1)->pluck('vendors.user_id')->first();
                    $reg1->assign_vendor_id = $match;
                    $reg1->quick_delivery = $req->quick_delivery;
                    $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();
                    $reg1->product_image=ProductImage::where('products_id',$r->product_id)->pluck('product_image')->first();
                    $reg1->prod_id = $r->product_id;
                    $reg1->quantity =$r->quantity;
                    $reg1->type =$r->type;
                    $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
                    $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
                    if($special_price != null){
                        $reg1->sub_total = $special_price;
                    }else{
                        $reg1->sub_total = $price;
                    }
                    $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();
                    $reg1->order_status = 1;
                }elseif($r->type == 3){
                    // $categories = 15;
                    // $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                    // $categories = 15;
                    // $brand = Brand::where('parent_id', $categories)->pluck('id')->first();
                    // $match = Vendor::where('main_category', $brand)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                    $categories = 15;
                    $brand = Brand::where('parent_id', $categories)->pluck('id')->first();
                    $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->limit(1)->pluck('vendors.user_id')->first();
                    $reg1->assign_vendor_id = $match;
                    $reg1->quick_delivery = $req->quick_delivery;
                    $reg1->prod_name=Package::where('id',$r->product_id)->pluck('package_name')->first();
                    $reg1->product_image=Package::where('id',$r->product_id)->pluck('image')->first();
                    $reg1->prod_id = $r->product_id;
                    $reg1->quantity =$r->quantity;
                    $reg1->type =$r->type;
                    $price=Package::where('id',$r->product_id)->pluck('package_cost')->first();
                    $discount = ($r->offer_discount * $price) / 100;
                    $discount1 =  $price - $discount;
                    $special_price = $discount1;
                    if($special_price != null){
                        $reg1->sub_total=$special_price;
                    }else{
                        $reg1->sub_total=$price;
                    }
                    $reg1->extra_discount=Package::where('id',$r->product_id)->pluck('offer_discount')->first();
                    $reg1->order_status = 1;
                }
                $sub_order[] = $reg1->sub_order_id;
                $vendor[] = $reg1->assign_vendor_id;
                $count++;
                $reg1->save();

                $order_assign = new OrderAssignHistory;
                $order_assign->order_id = $reg->order_id;
                $order_assign->sub_order_id = $reg1->sub_order_id;
                $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
            	                    $order_assign->user_type = 4;

                $order_assign->save();

                $order_status = new OrderStatusHistory;
                $order_status->order_id = $reg->order_id;
                $order_status->sub_order_id = $reg1->sub_order_id;
                $order_status->order_status = 1;
                $order_status->save();
            }

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id;
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
            	 if($coin >= $req->de_wallet_coin){
                    $total = $coin - $req->de_wallet_coin;
                    DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                }
                //$total = $coin - $req->de_wallet_coin;

                //DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);

            }

            if($req->payment_status == 'Failed'){
                $order =  Order::where('order_id' , $order_id)->first();
                if($order->user_phone != null || $order->user_email != null){
                    if($order->user_phone != null){
                        $msg = urlencode("Oops!!! Looks like your payment had failed due to some reasons.  Please try again.");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$order->user_phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    if($order->user_email != null){
                        $to = $order->user_email;
                        $subject = 'Order Payment Failed';
                        $message = "Oops!!! Looks like your payment had failed due to some reasons.  Please try again.";
                        $headers = 'From:support@drhelpdesk.in';
                        if(mail($to, $subject, $message, $headers)) {
                        }
                        else {
                        }
                    }
                    return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Success',
                        'order' => Order::where('order_id' , $req->order_id)->first()
                    ]);
                }
            }

        }
        elseif($req->quick_delivery==2){

            $data=Cart::where('user_id',$req->user_id)->get();
            $address = DB::table('user_addresses')->where('id',$req->address_id)->first();
            $order_id = "DHD".$req->user_id.time();

            $total_amount1=0;
            $sub_total= 0;
            $extra_discount = 0;
            $balance=0;
            $total_amount_with_shipping = 0;

            $reg = new Order;
            $reg->user_id = $req->user_id;
            $reg->order_id = $order_id;
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;
            $reg->total_discount = $req->total_discount;
            $reg->order_status = 1;
            $reg->quick_delivery = $req->quick_delivery;
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;

            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code;
            }
            $reg->prescription_id = $req->prescription_id;
            $reg->payment_mode = $req->payment_mode;
            $reg->payment_id = $req->payment_id;
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;
            $reg->user_name = $address->name;
            $reg->user_phone  = $address->phone;
            $reg->user_email  = $address->email;
            $reg->user_address = $address->address;
            $reg->user_apartment = $address->apartment;
            $reg->user_country  = 'india';
            $reg->user_state  = $address->state;
            $reg->user_city = $address->city;
            $reg->pin_code  = $address->pin_code;
            $reg->save();    //order item table

            $prod_name = [];
            $sub = [];
            $count=0;

            foreach ($data as $r) {
                $sub_order_id = "DHD".$req->user_id.$count.time();
                $reg1 = new OrderItem;
                $reg1->order_id = $reg->order_id;
                $reg1->sub_order_id = $sub_order_id;
                $reg1->type=$r->type;
                // $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
                // $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                $brand = Product::where('products_id', $r->product_id)->pluck('brand')->first();
                //dd($brand); die;
                $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->
                where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->
                limit(1)->pluck('vendors.user_id')->first();

                $reg1->assign_vendor_id = $match;
                $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();
                $reg1->product_image=ProductImage::where('products_id',$r->product_id)->pluck('product_image')->first();
                $reg1->prod_id = $r->product_id;
                $reg1->quantity =$r->quantity;
                $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
                $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
                if($special_price != null){
                    $reg1->sub_total=$special_price;
                }else{
                    $reg1->sub_total=$price;
                }
                $reg1->quick_delivery = $req->quick_delivery;
                $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();
                $reg1->order_status = 1;
                //dd($reg1);
                $prod_name[] = $reg1->prod_name;
                $sub[] = $reg1->sub_total;
            	$vendor[] = $reg1->assign_vendor_id;
                $count++;
                $reg1->save();

                $order_assign = new OrderAssignHistory;
                $order_assign->order_id = $reg->order_id;
                $order_assign->sub_order_id = $reg1->sub_order_id;
                $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
            	$order_assign->user_type = 4;

                $order_assign->save();

                $order_status = new OrderStatusHistory;
                $order_status->order_id = $reg->order_id;
                $order_status->sub_order_id = $reg1->sub_order_id;
                $order_status->order_status = 1;
                $order_status->save();
            }

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id;
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                    $couponPrice = $coupon->amount;;
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
            	 if($coin >= $req->de_wallet_coin){
                    $total = $coin - $req->de_wallet_coin;
                    DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                }
                //$total = $coin - $req->de_wallet_coin;

                //DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);

            }

            $p = implode("", $prod_name);
            $s  = implode("", $sub);
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));
            $response1 = curl_exec($curl1);
            curl_close($curl1);
            $data1 = json_decode($response1);
            $curl = curl_init();
            $token =   $data1->token;
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$address->name\",\n  \"billing_last_name\": \"$address->name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$address->email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"\",\n  \"shipping_pincode\": \"\",\n  \"shipping_country\": \"\",\n  \"shipping_state\": \"\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \"\",\n  \"order_items\": [\n    {\n      \"name\": \" $p\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $s\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $req->shipping_charge,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $sub_total,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
        	//dd($data);
            //$Shiprocket_Order_Id     =   $data->order_id ;
            //$Shiprocket_Shipment_Id      =   $data->shipment_id ;

            DB::table('order_items')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>null,
                'awb_number'=>null
            ]);
            DB::table('orders')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>null,
                'awb_number'=>null
            ]);


            if($req->payment_status == 'Failed'){
                $order =  Order::where('order_id' , $order_id)->first();
                if($order->user_phone != null || $order->user_email != null){
                    if($order->user_phone != null){
                        $msg = urlencode("Oops!!! Looks like your payment had failed due to some reasons.  Please try again.");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$order->user_phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    if($order->user_email != null){
                        $to = $order->user_email;
                        $subject = 'Order Payment Failed';
                        $message = "Oops!!! Looks like your payment had failed due to some reasons.  Please try again.";
                        $headers = 'From:support@drhelpdesk.in';
                        if(mail($to, $subject, $message, $headers)) {
                        }
                        else {
                        }
                    }
                    return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Success',
                        'order' => Order::where('order_id' , $req->order_id)->first()
                    ]);
                }
            }
        }
        Cart::where('user_id',$req->user_id)->delete();
    				 $order_detail = Order::where('order_id',$order_id)->first();
    				if ($address->phone!=null) {
                        $msg = urlencode("Thank you for shopping with DrHelpDesk.
Order ID - ".$order_id."
Total Amount - Rs ".$order_detail->amount."
Payment Mode - ".$reg->payment_mode."
Enjoy Shopping on Drhelpdesk.
Stay Home !!! Stay Safe !!!");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$address->phone."&message=".$msg);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }
                    $to_name = $address->name;
                    $to_email = $address->email;
                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Order Placed');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
    				$admin = User::where('user_type',1)->first();
                    $to_name1 = $admin->name;
                    $to_email1 = $admin->email;
                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Order Placed');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
    	$vendor1 = OrderAssignHistory::where('order_id',$order_id)->get();
        if(!empty($vendor1) || $vendor1->count() > 0){
            foreach ($vendor1 as $key => $value) {
                if($value->count() > 0){
                    $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                    $title = "New Order";
                    $message = 'New Order of this '.$order_id.' is assign to you';
                    $user = User::where('id',$value->assign_vendor_id)->first();
                	//dd($user);
                	if(!empty($user)){
                    	if(!empty($user->device_token) || $user->device_token != null){
                        	$notObj = new Notification();
                        	$regId = $user->device_token;
                        	$response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                    	}
                    }
                }
            }
        }
        if ($reg != null) {
        	/******** insert data into crm  *********/
    	// 	$user = User::where('id', $order_detail->user_id)->first();
      //   	$lmsData = array(
      //       	'company' => 'aensahealthsolution',
      //      		'lead_source' => 10,
      //           'division' => 1,
      //       	// 'name' => $user->name,
      //       	'email' => $user->email,
      //       	'phone' => $user->phone,
      //       	'order_id' => $order_id,
      //       	'amount' => $order_detail->amount,
      //       	'total_discount' => $order_detail->total_discount,
      //       	'order_status' => $order_detail->order_status,
      //       	'copoun_code' => $couponPrice,
      //       	'payment_mode' => $order_detail->payment_mode,
      //       	'shipping_charge' => $order_detail->shipping_charge,
      //       	'payment_status' => $order_detail->payment_status,
      //       	'shipping_address' => 'na',
      //       	'product_details' => 'na',
      //       );
      //       $url = "http://192.168.100.3:80/website-order";
      //
      //       $curl = curl_init();
      //       $url = sprintf("%s?%s", $url, http_build_query($lmsData));
      //
      //       curl_setopt($curl, CURLOPT_URL, $url);
      //       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      //       curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      //       $result = curl_exec($curl);
      //
			// curl_close($curl);

            /************************** */
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Order Place Successfully',
                'user'=>Order::where('id',$reg->id)->select('id','user_id','order_id')->first()
            ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]);
        }
    }
    public function cartUpdate(Request $req){
        $r=Cart::where('id',$req->cart_id)->update([
            'quantity'=>$req->quantity
        ]);
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Cart Quantity Update',
                'cart_item'=>Cart::where('id',$req->cart_id)->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function removeProduct(Request $req){
        $r=Cart::where('id',$req->cart_id)->delete();
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Product Remove From Cart'
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function orderDetails(Request $req){
        $data = OrderItem::where('sub_order_id',$req->order_id)->first();
        if(!empty($data->assign_delivery_boy_id) || $data->assign_delivery_boy_id != null){
            $delivery_boy_detail = DB::table('delivery_boys')->where('user_id',$data->assign_delivery_boy_id)->first();
            $total_delivery_boy_order=OrderItem::where('assign_delivery_boy_id',$delivery_boy_detail->user_id)->where('order_status',5)->count();
        }
     	if($data->assign_vendor_id != null){
            $vendor_detail = DB::table('vendors')->where('user_id',$data->assign_vendor_id)->first();

        }else{
            $vendor_detail =  null;
        }
        //dd($data);
        $address_id=Order::where('order_id',$data->order_id)->pluck('address_id')->first();
        $category1= Order::where('order_id',$data->order_id)->first();
        if($category1 !=  null){
            $extra_discount = ($data->sub_total * $data->quantity *  $data->extra_discount)/100;
            $sub_total = $data->sub_total * $data->quantity;
            $data->total = round($sub_total-$extra_discount);
            $t = OrderItem::where('order_id',$data->order_id)->where('type',1)->count();
            if($t > 0 ){
                if($category1->shipping_charge != null){
                    $ship = $category1->shipping_charge/$t;
                }else{
                    $ship = 0;
                }
                if($category1->de_wallet_coin != null){
                    $coin = ($category1->de_wallet_coin * 0.25)/$t;
                }else{
                    $coin = 0;
                }
                $data->complete_total =  round($data->total + $ship + $coin);
            }
        }else{
            $extra_discount = ($data->sub_total * $data->quantity *  $data->extra_discount)/100;
            //dd($extra_discount);
            $sub_total = $data->sub_total * $data->quantity;
            $data->total = round($sub_total-$extra_discount);
            //dd($total);
        }
        $details=Order::where('order_id',$data->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25;
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$data->order_id)->first();
        $address=UserAddress::where('id',$address_id)->first();
     	if (!empty($data)) {
			if (!empty($delivery_boy_detail)) {
        		return response()->json($data=[
            'status'=>200,
            'msg'=>'success',
            'address'=>$address,
            'details'=>$details,
            'coupen'=>$coupen,
            'result'=>$data,
            'dewallet'=>$dewllet_ruppee,
            'vendor_detail'=>$vendor_detail,
            'delivery_boy_detail'=>$delivery_boy_detail,
            'total_delivery_boy_order'=>$total_delivery_boy_order,
            'invoice'=>"https://drhelpdesk.in/download-user-invoice/".$data->order_id
        	]);
    		}
    		else{
       		return response()->json($data=[
            'status'=>200,
            'msg'=>'success',
            'address'=>$address,
            'details'=>$details,
            'coupen'=>$coupen,
            'result'=>$data,
            'dewallet'=>$dewllet_ruppee,
        	'vendor_detail'=>$vendor_detail,
            'invoice'=>"https://drhelpdesk.in/download-user-invoice/".$data->order_id
        	]);
    	}
	}
	else{
    return response()->json($data=[
        'status'=>404,
        'msg'=>'order not found'
    ]);
		}

    }
   public function myOrder(Request $req){
   		$order2 = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type IN(1) group by order_id) and user_id='".$req->user_id."' ORDER BY id DESC"));
        $order = collect($order2)->where('order_status', '!=', 0);
        //$order=Order::Join('order_items','orders.order_id','order_items.order_id')->where('order_items.type', 1)->where('orders.user_id',$req->user_id)->where('orders.order_status', '!=', 0)->select('orders.*')->orderBy('orders.id','desc')->get();
        foreach ($order as  $value) {
            $single_order = OrderItem::where('order_id',$value->order_id)->select('prod_name','product_image')->first();
            if($single_order->count() > 1){
                $value->product_name = OrderItem::where('order_id',$value->order_id)->pluck('prod_name')->first();
            	$value->product_image = OrderItem::where('order_id',$value->order_id)->pluck('product_image')->first();
            }
        	$order_check = OrderItem::where('order_id',$value->order_id)->where('order_status',4)->count();
        	//dd($order_check);
            if($order_check > 0){
                $value->order_picked = 1;
            }else{
                $value->order_picked = 0;
            }
        	$order2=OrderItem::where('order_id',$value->order_id)->where('order_status',5)->count();
            if($order2 > 1){
                $value->order_deliver = 1;
            }else{
                $value->order_deliver = 0;
            }
        }
    	if ($order!=null) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>count($order).' order found',
               'result'=>($order)
           ]);
        }
        else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No order Found'
           ]);
       }
    }
   public function myBooking(Request $req){
    	$order2 = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type IN(2,3) group by order_id) and user_id='".$req->user_id."' ORDER BY id DESC"));
        $order = collect($order2)->where('order_status', '!=', 0);
        //$order=Order::Join('order_items','orders.order_id','order_items.order_id')->where('type','!=' , 1)->where('user_id',$req->user_id)->where('orders.order_status', '!=', 0)->select('orders.*')->orderBy('orders.id','desc')->get();
        foreach ($order as  $value) {
        	$single_order = OrderItem::where('order_id',$value->order_id)->select('prod_name','product_image')->first();
            if($single_order->count() > 1){
                $value->product_name = OrderItem::where('order_id',$value->order_id)->pluck('prod_name')->first();
            	 $value->product_image = OrderItem::where('order_id',$value->order_id)->pluck('product_image')->first();
            }
            $order2=OrderItem::where('order_id',$value->order_id)->where('order_status',3)->count();
            if($order2 > 1){
                $value->order_deliver = 1;
            }else{
                $value->order_deliver = 0;
            }
        }
    	if ($order!=null) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>count($order).' Booking found',
               'result'=>($order)
           ]);
        }
        else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No Booking Found'
           ]);
       }
    }
    public function subOrderDetails(Request $req){
        $data=OrderItem::where('order_id',$req->order_id)->Where('type',1)->orderBy('id','desc')->get();
        //dd($data);
        foreach($data as $r){
            $review = DB::table('reviews')->where('product_id', $r->prod_id)->where('user_id', $req->user_id)->count();
            //$rating = Review::where('product_id',$r->product_id)->get();

            if($review > 0){
                $r->is_review = 1;
            }else{
                $r->is_review = 0;
            }
        }
        $details=Order::where('order_id',$req->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25;
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$req->order_id)->first();
        // $address=UserAddress::where('id',$address_id)->first();
        if (!empty($data)) {
            return response()->json($data=[
                'status'=>200,
                'msg'=>'success',
                // 'address'=>$address,
                'details'=>$details,
                'coupen'=>$coupen,
                'result'=>$data,
                'dewallet'=>$dewllet_ruppee,
                'invoice'=>"https://drhelpdesk.in/download-user-invoice/".$req->order_id
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    }
    public function subBookingDetails(Request $req){
        $data=OrderItem::where('order_id',$req->order_id)->where('type','!=',1)->orderBy('id','desc')->get();
        //dd($data);
        $details=Order::where('order_id',$req->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25;
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$req->order_id)->first();
        // $address=UserAddress::where('id',$address_id)->first();
        if (!empty($data)) {
            return response()->json($data=[
                'status'=>200,
                'msg'=>'success',
                // 'address'=>$address,
                'details'=>$details,
                'coupon'=>$coupen,
                'result'=>$data,
                'dewallet'=>$dewllet_ruppee
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'booking not found'
            ]);
        }
    }
    public function cancleOrder(Request $req){
        //dd($req->order_id);

        $data=OrderItem::where('sub_order_id',$req->order_id)->first();
        $amount=Order::where('order_id',$data->order_id)->pluck('amount')->first();
        $r=OrderItem::where('sub_order_id',$req->order_id)->update([
            'order_status'=>5
        ]);
        if($r!=null){
            Order::where('order_id',$data->order_id)->update([
                'amount'=>$amount-$data->sub_total
            ]);
            $data1=OrderItem::where('sub_order_id',$req->order_id)->first();
            return response()->json($data=[
                'status'=>200,
                'msg'=>'order cancle successfully',
                'result'=>$data1
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    }
    public function doctorAppointment(Request $req){
        $reg = new DoctorAppointment;
        $reg->user_id = $req->user_id;
        $reg->doctor_id = $req->doctor_id;
        $reg->appointment_date = $req->appointment_date;
        $reg->description = $req->description;
        $reg->status = 0; //0 for recieve and 1 for confirm
        $reg->save();
        //email send to doctor
        // $docor=user::where('id',$req->doctor_id)->first();
        // $user=user::where('id',$req->user_id)->first();

        //     $to = $doctor->email;
        //     $subject = 'New Appointment Enquery';
        //     $message = "You have new appointment from which name is- ".$user->name." and Email and Phone No are ".$user->email." , ".$user->phone." and which have the following problem ".$reg->description."";
        //     $headers = 'From: noreply@tklpvtltd.com';
        //     if(mail($to, $subject, $message, $headers)) {

        //     } else {

        //     }

        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Appointment Fixed',
                'user'=>DoctorAppointment::where('id',$reg->id)->select('id','user_id','doctor_id')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function uploadPrescription(Request $req){
        if($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = 'prescription'.time().'.'.$req->image->extension();
            $destinationPath = storage_path('../public/upload/prescription');
            $file->move($destinationPath, $filename);
            $prescription = 'upload/prescription/'.$filename;
        }
        $reg = new Prescription;
        $reg->user_id = $req->user_id;
        $reg->prescription_image = $prescription;
        $reg->comment = $req->comment;
        $reg->save();
        if ($reg != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'prescription upload Successfully',
                'result'=>Prescription::where('id',$reg->id)->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function userPrescription(Request $req){
        $result = Prescription::where('user_id',$req->user_id)->get();
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Prescription',
                'prescription'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function userPrescriptionDelete(Request $req){
        $result=Prescription::where('id',$req->id)->delete();
        if ($result != null)  {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Prescription Delete Successfully'
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function vendorList(Request $req){
        $brand = Brand::where('parent_id',$req->category_id)->get();
        //dd($brand);
        foreach ($brand as $value) {
            $result = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $value->id)->get();
        }

        $affordable=Package::where('type',1)->get();
        foreach($affordable as $r){
            $package_id = explode(",",$r->package);
            $r->total_include_test = count($package_id);
            $p1 = Wishlist::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if ($result->count()>0 || $affordable->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Lab Test Vendor',
                'affordable_package'=>$affordable,
                'certified_lab'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function HealthPackage(Request $req){
        $result=Package::orderBy('id','desc')->get();
        foreach($result as $r){
            if($r->offer_discount != null){
                $discount = ($r->offer_discount * $r->package_cost) / 100;
                $r->offer_price = round($r->package_cost - $discount);
            }
            $package_id = explode(",",$r->package);
            $r->total_include_test = count($package_id);
            $p1 = Wishlist::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Health Packages',
                'packages'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
     public function myCartCount(Request $req){
        $data=Cart::where('user_id',$req->user_id)->count();
        $wishlist=Wishlist::where('user_id',$req->user_id)->count();
     	if($wishlist > 0 && $data > 0) {
            return response()->json($data=[
               'status'=>200,
               'msg'=>'success',
               'count'=>$data,
               'wishlist_count'=>$wishlist
           ]);
        }
        if($data > 0) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>$data. '  Item Found In Cart',
               'count'=>$data,
               'wishlist_count'=>0
           ]);
        }if($wishlist > 0) {
            return response()->json($data=[
               'status'=>200,
               'msg'=>$wishlist. '  Item Found In Cart',
               'count'=>0,
               'wishlist_count'=>$wishlist
           ]);
        }
        else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No Item Found'
           ]);
        }
    }
    public function vendorOrderList(Request $req){
        $result=OrderItem::where('assign_vendor_id',$req->vendor_id)->where('order_status', '>', 0)->where('order_status', '<', 6)->orderby('id','desc')->get();
            foreach($result as $r){
                $category1= VendorStatus::where('sub_order_id',$r->sub_order_id)->where('vendor_id',$req->vendor_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_accept = 1;
                }else{
                    $r->is_accept = 0;
                }
            }
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Vendor Order',
                'order'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
	public function vendorOrderAccept(Request $req){
        if (VendorStatus::where(['sub_order_id' => $req->sub_order_id,'vendor_id'=>$req->vendor_id,'user_type'=>$req->user_type , 'is_accept'=>1])->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Already Save Status'
            ]);
        }
        elseif($req->user_type == 4){
            if($req->type==2){
                $r1 = OrderItem::where('sub_order_id', $req->sub_order_id)->first();
                if($r1->type == 1 || $r1->type == 2){
                    $brand = DB::table('products')->where('products_id', $r1->prod_id)->pluck('brand')->first();
                    //dd($brand); die;
                    $vv = OrderAssignHistory::where('sub_order_id', $req->sub_order_id)->where('user_type',4)->select('assign_vendor_id')->get();


                    $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $brand)->whereNotIn('user_id', $vv)->orderBy('vendor_brands.assign_priority','asc')->limit(1)->pluck('vendors.user_id')->first();
                    //dd($match);

                }elseif($r1->type == 3){
                    $categories = 15;
                    $brand = DB::table('brands')->where('parent_id', $categories)->pluck('id')->first();
                    $vv = OrderAssignHistory::where('sub_order_id', $req->sub_order_id)->where('user_type',4)->select('assign_vendor_id')->get();



                    $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $brand)->whereNotIn('user_id', $vv)->orderBy('vendor_brands.assign_priority','asc')->limit(1)->pluck('vendors.user_id')->first();

                }
                $r= OrderItem::where('sub_order_id',$req->sub_order_id)->update(['assign_vendor_id'=>$match]);
                //dd($match); die;
                //insert the code for order assign history table
                if($r){//here history assign order save at time of order place time assign vendor code time.
                    $vendor = new OrderAssignHistory;
                    $vendor->order_id = $req->order_id;
                    $vendor->sub_order_id = $req->sub_order_id;
                    $vendor->assign_vendor_id = $match;
                    $vendor->user_type = $req->user_type;
                    $vendor->save();

                    $reg=new VendorStatus();
                    $reg->vendor_id=$req->vendor_id;
                    $reg->order_id=$req->order_id;
                    $reg->sub_order_id=$req->sub_order_id;
                    $reg->is_accept=$req->type;
                    $reg->user_type = $req->user_type;
                    $reg->save();
                    //status change
                    if($match != null){
                        $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                        $title = "New Order";
                        $message = 'New Order of this '.$req->order_id.' is assign to you';
                        $user = User::where('id',$match)->first();
                        if($user->device_token != null){
                            $notObj = new Notification();
                            $regId = $user->device_token;
                            $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                        }
                    }
                    return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Status Changes'
                    ]);
                }
            }
            else{
                //assign delivery boy to the orders;
                 $vendor=Vendor::where('user_id',$req->vendor_id)->first();
                    //dd($vendor);
                    $result =DB::select(DB::raw("
                    SELECT
                    id, (
                      3959 * acos (
                        cos ( radians($vendor->latitude) )
                        * cos( radians( latitude ) )
                        * cos( radians( longitude ) - radians($vendor->longitude) )
                        + sin ( radians($vendor->latitude) )
                        * sin( radians( latitude ) )
                      )
                    ) AS distance
                  FROM delivery_boys
                  ORDER BY distance asc LIMIT 1;
                    ")
                    );
                    //dd($result);
                    $result1 = DB::table('delivery_boys')->where('id',$result[0]->id)->pluck('user_id')->first();
                    //dd($result1);
                    //delivery boy id update on the table
                    OrderItem::where('sub_order_id',$req->sub_order_id)->update(['assign_delivery_boy_id'=>$result1
                    ]);

                $reg=new VendorStatus();
                $reg->vendor_id=$req->vendor_id;
                $reg->order_id=$req->order_id;
                $reg->sub_order_id=$req->sub_order_id;
                $reg->is_accept=$req->type;
                $reg->user_type = $req->user_type;
                $reg->save();
            	if($result1 != null){
                    $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                    $title = "New Order";
                    $message = 'New Order of this '.$req->order_id.' is assign to you';
                    $user = User::where('id',$result1 )->first();
                    if($user->device_token != null){
                        $notObj = new Notification();
                        $regId = $user->device_token;
                        $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                    }
                }
                if($reg){
                    return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Status Changes'
                 ]);
                }
            }
        }
        elseif($req->user_type == 5){
            if($req->type==2){
                $vv = OrderAssignHistory::where('sub_order_id', $req->sub_order_id)->where('user_type',5)->select('assign_vendor_id')->get();

                $vendor1=DB::table('delivery_boys')->where('user_id','!=',$req->vendor_id)->whereNotIn('user_id', $vv)->limit(1)->pluck('user_id')->first();
                //$vendor=DB::table('delivery_boys')->where('user_id',$vendor1)->first();
                //$vendor_details = DB::table('delivery_boys')->where('user_id',$req->vendor_id)->first();
                //dd($vendor1);
                // $result =DB::select(DB::raw("
                //     SELECT
                //     id, (
                //     3959 * acos (
                //     cos ( radians($vendor_details->latitude) )
                //         * cos( radians( latitude ) )
                //         * cos( radians( longitude ) - radians($vendor_details->longitude) )
                //             + sin ( radians($vendor_details->latitude) )
                //         * sin( radians( latitude ) )
                //     )
                //     ) AS distance
                //     FROM delivery_boys
                //     ORDER BY distance asc LIMIT 1;
                //     ")
                // );
                 $result1 = DB::table('delivery_boys')->where('user_id',$vendor1)->first();
                    //dd($result1);
                    //delivery boy id update on the table
            if(!empty($vendor1) || $vendor1 != null){
                $r=  OrderItem::where('sub_order_id',$req->sub_order_id)->update(['assign_delivery_boy_id'=>$vendor1
                    ]);


                //insert the code for order assign history table
                if($r){//here history assign order save at time of order place time assign vendor code time.
                    $vendor = new OrderAssignHistory;
                    $vendor->order_id = $req->order_id;
                    $vendor->sub_order_id = $req->sub_order_id;
                    $vendor->assign_vendor_id =  $req->vendor_id;
                    $vendor->user_type = 5;
                    $vendor->save();

                	 if($result1 != null){
                        $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                        $title = "New Order";
                        $message = 'New Order of this '.$req->order_id.' is assign to you';
                        $user = User::where('id',$result1 )->first();
                        if($user->device_token != null){
                            $notObj = new Notification();
                            $regId = $user->device_token;
                            $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                        }
                    }

                }
            }
            	return response()->json($data = [
                        'status' => 200,
                        'msg' => 'Status Changes'
                    ]);
            }
            else{
                $reg=new VendorStatus();
                $reg->vendor_id=$req->vendor_id;
                $reg->order_id=$req->order_id;
                $reg->sub_order_id=$req->sub_order_id;
                $reg->is_accept=$req->type;
                $reg->user_type = 5;
                $reg->save();
                if($reg){
                    return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Status Changes'
                 ]);
                }
            }
        }}
    public function orderStatusUpdate(Request $req){
        // $total_sub_order = OrderItem::where('order_id',$req->order_id)->get();
        $r = OrderItem::where('sub_order_id',$req->sub_order_id)->update([
           'order_status'=>$req->order_status,
           'status_updated_by'=>$req->user_id
        ]);

        $order = new OrderStatusHistory;
        $order->order_id = $req->order_id;
        $order->sub_order_id = $req->sub_order_id;
        $order->order_status = $req->order_status;
        $order->change_by = $req->user_id;
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
            $walletCnt = DB::table('de_wallets')->where('user_id',$user_id->user_id)->first();
            if(!empty($walletCnt) || $walletCnt->count() > 0){
                DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                    'coin'=>  $damount + $walletCnt->coin
                ]);

                OrderItem::where('sub_order_id',$req->sub_order_id)->update([
                   'earn_dewallet_coin'=>$damount
                ]);
                if ($user_id->user_phone != null) {
                    $msg = urlencode("Congratulations! ".$damount." D-Coins have been added to your Account Details have been sent to your registered e-mail");
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
     	// Order::where('order_id',$req->order_id)->update([
     	// 'order_status'=>2
     	// ]);
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
    	if($order_detail->type != 2 && $order_detail->order_status != 3){
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
        }

        // if($req->order_status == 5){
        //     DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
        //         'coin' => 0.50 * $total + $data1
        //     ]);
        // }
        if($r){
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Status Changes'
            ]);
        }
        else{
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Status Does Not Changes'
            ]);
        }
    }
	public function DeliveryBoyOrderList(Request $req){
        $result=OrderItem::where('assign_delivery_boy_id',$req->delivery_boy_id)->where('order_status', '>', 0)->where('order_status', '<', 6)->orderby('id','desc')->get();
    	 foreach($result as $r){
                $category1= VendorStatus::where('sub_order_id',$r->sub_order_id)->where('vendor_id',$req->delivery_boy_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_accept = 1;
                }else{
                    $r->is_accept = 0;
                }
            }
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Delivery Boy Orders',
            	'count'=>$result->count(),
                'order'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function userCancelOrder(Request $req){
        $order_data =  DB::table('orders')->where('order_id', $req->order_id)->first();
        DB::table('orders')->where('order_id', $req->order_id)->update([
            'order_status' => 3
        ]);
        DB::table('order_items')->where('order_id', $req->order_id)->update([
            'order_status' => 6
        ]);

        DB::table('order_status_histories')->where('order_id', $req->order_id)->update([
            'order_status' => 6
        ]);
        if($order_data!=null){
            return response()->json($data=[
                'status'=>200,
                'msg'=>'This ' .  $req->order_id  . ' Order Cancelled Successfully'
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    }
    public function userAddressDelete(Request $req){
        $result = UserAddress::where('id',$req->id)->delete();
        if ($result!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Delete Successfully',
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Address Not Found'
             ]);
        }
    }
    public function editAddress(Request $req){
        UserAddress::where('id',$req->id)->update([
            'user_id' => $req->user_id,
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'address_type' => $req->address_type,
            'address' => $req->address,
            'apartment' => $req->apartment,
            'city' => $req->city,
            'state' => $req->state,
            'pin_code' => $req->pin_code,
            'country' => 'india'
        ]);
        if ($req->id) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Edit Successfully',
                'Address'=>UserAddress::where('id',$req->id)->select('id','user_id','name','email','phone','address_type','address','apartment','city','state','pin_code','country')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function removeProductFromWishlist(Request $req){
        $r=Wishlist::where('id',$req->wishlist_id)->delete();
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Product Remove From Wishlist'
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function allHealthPackage(Request $req){
        $result=DB::table('packages')->join('products', 'products.products_id', '=', 'packages.package')->select('packages.id','packages.package_name', 'products.product_name', 'packages.package_cost' ,'packages.offer_discount' ,'packages.status','packages.image' ,'packages.type')->get();
        foreach($result as $r){
            $p1 = Wishlist::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' =>  $result->count(). ' Health Packages',
                'packages'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function packageDetailById(Request $req){
        $result=DB::table('packages')->where('id',$req->id)->select('*')->first();
        $package_id = explode(",", $result->package);
        foreach ($package_id as  $value) {
            $package = DB::table('products')->where('products_id', $value)->select('product_name')->first();
            //print_r($package);
            $total[] = $package;
        }
         $testing1= json_decode(json_encode($total),true);
        //dd($total);
        if ($result != null) {
            return response()->json($data = [
                 'status' => 200,
                 'msg' => 'Success',
                 'test'=>$result,
                 'testing_name'=>$testing1
              ]);
       }else {
           return response()->json($data = [
               'status' => 404,
               'msg' => 'Data Not Found'
            ]);
       }
    }
    public function updateDeliveryBoyLocation(Request $req){
        if (DeliveryTracking::where('delivery_boy_id' , $req->delivery_boy_id)->count()>0) {
            DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->update([
                'latitude' => $req->latitude,
                'longitude' => $req->longitude
            ]);
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Location Update Successfully',
                'data' => DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->first()
            ]);
        }else{
            $reg = new DeliveryTracking;
            $reg->delivery_boy_id = $req->delivery_boy_id;
            $reg->latitude =  $req->latitude;
            $reg->longitude =  $req->longitude;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                   'status' => 200,
                    'msg' => 'Location Update Successfully',
                    'data' => DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->first()
                ]);
            }
            else {
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Something Went Wrong'
                ]);
            }
        }
    }
    public function trackOrderRoute(Request $req){
        ini_set("allow_url_fopen", 1);
        if(OrderItem::where('sub_order_id' , $req->sub_order_id)->count()>0) {
            $delivery_boy = OrderItem::where('sub_order_id' , $req->sub_order_id)->first();
            if  (DeliveryTracking::where('delivery_boy_id', $delivery_boy->assign_delivery_boy_id)->count()>0){
                $location = DeliveryTracking::Join('delivery_boys','delivery_trackings.delivery_boy_id','delivery_boys.user_id')->where('delivery_boy_id', $delivery_boy->assign_delivery_boy_id)->select('delivery_trackings.*','delivery_boys.delivery_boy_name','delivery_boys.logo as image')->first();


                $pickup_latitude = "";
                $pickup_longitude = "";
                if(!empty($delivery_boy->assign_vendor_id)) {
                    $data = Vendor::where('user_id', $delivery_boy->assign_vendor_id)->first();
                    if(!empty($data->latitude)) {
                        $pickup_latitude = $data->latitude;
                        $pickup_longitude = $data->longitude;
                    }
                }
                $location['pickup_latitude'] = $pickup_latitude;
                $location['pickup_longitude'] = $pickup_longitude;

                $drop_latitude = "";
                $drop_longitude = "";
                $order_data = Order::where('order_id', $delivery_boy->order_id)->first();

                $address1 = $order_data->user_address.','.$order_data->user_city.','.$order_data->user_state;

                $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $geo1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                $geo = json_decode($response, true); // Convert the JSON to an array
                if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                    $drop_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                    $drop_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                }

                $location['drop_latitude'] = $drop_latitude;
                $location['drop_longitude'] = $drop_longitude;

                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Delivery Current Location',
                    'data' => $location
                ]);
            }else{
                return response()->json($data = [
                    'status' => 400,
                    'msg' => 'Delivery Boy Location Not Found'
                ]);
            }

        }else{
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]);
        }
    }
}
