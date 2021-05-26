<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input; 
use Auth;
use DB;
use Mail; 
use redirect;
use Session;
use Validator;
use Carbon\carbon;
use App\User;  
use App\TempCart;
use App\Cart;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\UserDetail;
use App\Product;
use App\Vendor;
use App\Review;
use App\Prescription;
use App\DeWallet;
use App\Package;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
use App\OrderCouponHistory;
use App\PasswordReset;
use App\Register;
use App\OrderPaymentTransaction;
use Paykun\Checkout\Payment;
use App\WalletTransactionHistory;
use App\Wallet;
use App\ConsultationTransaction;
use App\Notification;
class PaymentController extends Controller
{
    public function getPayment()
    {
         // Test Mode
        // $obj = new Payment('770238538573163', '5E8CDDCEA0FB2C45211E45CED7F4F6CF', 'E09FEB10D06E8C3D4A2FCDA43BCB1BB3', false, true);
        
    	//Live Mode
		//$obj = new Payment('888878691421548', '7781DEC1496FEB93777F6D957A82E372', '8AB4F4F7C83CF668E5303D59732752A8', true, true);
    
    	//Live Mode
		$obj = new Payment('430161163472424', '755551D83B2CCB98A36BB068AC992460', '7FF5A4C440FB3E9EBF2C7759FFE71575', true, true);
    
        return $obj;
    }
    public function getOrderDetails(){
        $obj = $this->getPayment();
        
    }
    public function showPayment($order_id){  
       
        $obj = $this->getPayment();
        $orderData = Order::where('order_id',$order_id)->first();
        $userDeatils = UserDetail::where('user_id', $orderData->user_id)->first();
        
        // default currency is 'INR'
        // $orderData->amount
        $obj->initOrder($order_id, 'all', $orderData->amount, route('payment_success'),  route('payment_fail'), 'INR');

        // Add Customer
        $obj->addCustomer($orderData->user_name, $userDeatils->email, $orderData->user_phone);

        // Add Shipping address
        $obj->addShippingAddress($orderData->user_country, $orderData->user_state, $orderData->user_city, $orderData->pin_code, $orderData->user_address);

        // Add Billing Address
        $obj->addBillingAddress($orderData->user_country, $orderData->user_state, $orderData->user_city, $orderData->pin_code, $orderData->user_address);
		$obj->setCustomFields(['udf_1' => $order_id]);
        echo $obj->submit();
    }

    public function paymentSucccess(Request $req)
    { 

        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);
        
        if(is_array($response) && !empty($response)) {

            if($response['status'] && $response['data']['transaction']['status'] == "Success") {
                $order_id = $response['data']['transaction']['order']['order_id'];
                Order::where('order_id', $order_id)->update([ 
                    'order_status' => 1
                ]);
                OrderItem::where('order_id', $order_id)->update([ 
                    'order_status' => 1
                ]);
                $orderDeatils = Order::where('order_id', $order_id)->first();
//                 $damount = round($orderDeatils->amount/5);
            	
//                 $walletCnt = DB::table('de_wallets')->where('user_id',Auth::user()->id)->count();
//                 if($walletCnt > 0){
//                     DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
//                     'coin' => $damount
//                     ]);
//                 }else{
//                     DB::Select(DB::raw("insert into de_wallets set coin='".$damount."', user_id='".Auth::user()->id."'"));
//                 }
                    
                $reg = new OrderPaymentTransaction;
                $reg->order_id = $order_id;
                $reg->payment_id = $req['payment-id'];   
                $reg->status = 1;  
                $reg->response_data = json_encode($response); 
                $reg->save();
            	$order_detail = Order::where('order_id',$order_id)->first();
                $order_detail2 = User::where('id',$order_detail->user_id)->first();
                if($order_detail->phone != null) { 
                    $msg=urlencode("Thank you for shopping with DrHelpDesk.
                            Order ID - ".$order_id."
                            Total Amount - Rs ".$order_detail->amount."
                            Payment Mode - Online 
                            Enjoy Shopping on Drhelpdesk. 
                            Stay Home !!! Stay Safe !!!");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$address->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                } 
                
                $to_name = $order_detail2->name;
                $to_email = $order_detail2->email; 
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
                        if($value  != null){
                            $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                            $title = "New Order"; 
                            $message = 'New Order of this '.$order_id.' is assign to you';
                            $user = User::where('id',$value->assign_vendor_id)->first(); 
                            if($user->device_token != null){
                                $notObj = new Notification(); 
                                $regId = $user->device_token;
                                $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image); 
                            }
                        }
                    }
                }
                return redirect('order-suceess/'.$order_id);
            } else {
                $order_id = $response['data']['transaction']['order']['order_id'];
                Order::where('order_id', $order_id)->update([ 
                    'order_status' => 0
                ]);
                OrderItem::where('order_id', $order_id)->update([ 
                'order_status' => 0
                ]);
            
            	$user_id = Order::where('order_id',$order_id)->where('order_status', 0)->first(); 
                $walletCnt = DB::table('de_wallets')->where('user_id',$user_id->user_id)->pluck('coin')->first(); 
                //dd($walletCnt);
                if(!empty($walletCnt)){ 
                    DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                        'coin'=>  $user_id->de_wallet_coin + $walletCnt 
                    ]);  
                }
                $reg = new OrderPaymentTransaction;
                $reg->order_id = $order_id;
                $reg->payment_id = $req['payment-id'];  
                $reg->status = 2;  
                $reg->response_data = json_encode($response); 
                $reg->save();
                return redirect('order-fail/'.$order_id);
            }
        }
        
        
    }

    public function paymentFail(Request $req)
    { 
        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);
        
        $order_id = $response['data']['transaction']['order']['order_id'];
        
        Order::where('order_id', $order_id)->update([ 
            'order_status' => 0
        ]);
        OrderItem::where('order_id', $order_id)->update([ 
            'order_status' => 0
        ]);
    
    			$user_id = Order::where('order_id',$order_id)->where('order_status', 0)->first(); 
                $walletCnt = DB::table('de_wallets')->where('user_id',$user_id->user_id)->pluck('coin')->first(); 
                //dd($walletCnt);
                if(!empty($walletCnt)){ 
                    DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                        'coin'=>  $user_id->de_wallet_coin + $walletCnt 
                    ]);  
                }
      
        $reg = new OrderPaymentTransaction;
        $reg->order_id = $order_id;
        $reg->payment_id = $req['payment-id']; 
        $reg->status = 2;  
        $reg->response_data = json_encode($response); 
        $reg->save();
        return redirect('order-fail/'.$order_id);
    }
    
    public function showUserPaymet(Request $req){  
       
        $obj = $this->getPayment();
        $order_id = $req->user_id.time();
        $userDeatils = UserDetail::where('user_id', $req->user_id)->first();
        
        Session::put('call_back', $req->call_back);
        Session::put('user_id', $req->user_id);
        Session::put('doc_id', $req->doc_id);
        
        $reg = new WalletTransactionHistory;
        $reg->user_id = $req->user_id;
        $reg->amount = $req->amount;
        $reg->payment_request_id = $order_id;  
        $reg->save();
        
        // default currency is 'INR'
        $obj->initOrder($order_id, 'all', $req->amount, url('payment-user-success'),  url('payment-user-fail'), 'INR');
        $mobile = !empty($userDeatils->mobile) ? $userDeatils->mobile:'';
        // Add Customer
        $obj->addCustomer($userDeatils->user_name, $userDeatils->email, $mobile);

        // Add Shipping address
        $obj->addShippingAddress($userDeatils->country, $userDeatils->state, $userDeatils->city, $userDeatils->pin_code, $userDeatils->address);

        // Add Billing Address
        $obj->addBillingAddress($userDeatils->country, $userDeatils->state, $userDeatils->city, $userDeatils->pin_code, $userDeatils->address);

        echo $obj->submit();
    }
    
    public function paymentUserSucccess(Request $req)
    { 

        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);
        
        if(is_array($response) && !empty($response)) {

            if($response['status'] && $response['data']['transaction']['status'] == "Success") {
                $order_id = $response['data']['transaction']['order']['order_id'];
                
                $payment_id = $response['data']['transaction']['payment_id'];
                
                WalletTransactionHistory::where('payment_request_id', $order_id)->update([ 'payment_status' => 'success',
                    'payment_id' => $payment_id,
                ]);
                
                $totalAmt = 0;
                $user_id = Session::get('user_id');
                $doc_id = Session::get('doc_id');
                
                $orderDetail = WalletTransactionHistory::where('user_id', $user_id)->first();
                if(!empty($user_id) && $user_id > 0) {
                    $wallet_details = DB::table('wallets')->where('user_id', Auth::user()->id)->first();
                    if(empty($wallet_details)) {
                        $wallet = new Wallet;
                        $wallet->user_id = $user_id;
                        $wallet->amount = $orderDetail->amount; 
                        $totalAmt = $orderDetail->amount;
                        $wallet->save();
                    } else {
                        $alAmt = (int) $wallet_details->amount;
                        $currentAmt = (int) $orderDetail->amount;
                        $totalAmt = $alAmt+$currentAmt;
                        Wallet::where('user_id',$user_id)->update([
                        'amount'=>$totalAmt
                        ]);
                    }
        
                    $doctor = UserDetail::where('user_id', $doc_id)->first();
                    $cunsultRes = ConsultationTransaction::where('user_id', $req->user_id)->where('doc_id', $doc_id)->orderBy('id', 'DESC')->first();
        
                   if(empty($cunsultRes)) {
                        $cultTxn = new ConsultationTransaction();
                        $cultTxn->user_id = $user_id;
                        $cultTxn->doc_id = $doc_id; 
                        $cultTxn->consultation_credit = $doctor->number_of_consultation; 
                        $cultTxn->save();
        
                        $rest_amount = $totalAmt - (int) $doctor->consultation_fees;
        
                        Wallet::where('user_id', $user_id)->update([
                        'amount'=>$rest_amount
                        ]);
        
                    }
                }
            } else {
                
                $order_id = $response['data']['transaction']['order']['order_id'];
                
                $payment_id = $response['data']['transaction']['payment_id'];
                
                WalletTransactionHistory::where('payment_request_id', $order_id)->update([ 'payment_status' => 'fail',
                    'payment_id' => $payment_id,
                ]);
            }
        }
        
        $req->session()->forget('user_id');
        $req->session()->forget('doc_id');
        
        $call_back = Session::get('call_back');
       return redirect($call_back);
    }
    
    public function paymentUserFail(Request $req)
    { 

        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);
        
        if(is_array($response) && !empty($response)) {

            if($response['status'] && $response['data']['transaction']['status'] == "Success") {
                $order_id = $response['data']['transaction']['order']['order_id'];
                
                $payment_id = $response['data']['transaction']['payment_id'];
                
                WalletTransactionHistory::where('payment_request_id', $order_id)->update([ 'payment_status' => 'success',
                    'payment_id' => $payment_id,
                ]);
               
            } else {
                
                $order_id = $response['data']['transaction']['order']['order_id'];
                
                $payment_id = $response['data']['transaction']['payment_id'];
                
                WalletTransactionHistory::where('payment_request_id', $order_id)->update([ 'payment_status' => 'fail',
                    'payment_id' => $payment_id,
                ]);
            }
        }
        
        $req->session()->forget('user_id');
        $req->session()->forget('doc_id');
        
        $call_back = Session::get('call_back');
       return redirect($call_back);
    }

    
     
} 