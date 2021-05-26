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
use App\ShippingSetting;
use App\TempCart;
use App\Cart;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\UserDetail;
use App\Product;
use App\Vendor;
use App\Refer_code;
use App\DeTransaction;
use App\Review;
use App\Prescription;
use App\DeWallet;
use App\Package;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
use App\OrderCouponHistory;
use App\PasswordReset;
use App\Register;
use App\ApplyReferCode;
use App\Brand;
use App\Notification;
use JWTAuth;
use Razorpay\Api\Api;
use Razorpay\Api\Order as ROrder;
use App\ProductAttribute;
use Socialite;

class UserController extends Controller
{
    public function userRegistration(){
        $data['flag'] = 1;
        return view('UI/webviews/user.manage_user',$data);
    }

    public function userLogin(){
        $data['flag'] = 6;
        return view('UI/webviews/user.manage_user',$data);
    }

    public function guestLogin(){
        $data['flag'] = 7;
        return view('UI/webviews/user.manage_user',$data);
     }

    /*public function userRegistrationSubmit1(Request $request) {
    //   	$request->validate([
    //         'name'=> 'required',
    //         'email'=>'required|email|unique:users',
    //         'phone'=>'required|numeric|unique:users',
    //         'password' => 'min:6|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    //         'password_confirmation' => 'min:6'
    //     ],

    //       [
    //         'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
    //       ]

    //             );
    //     try{
    //         $otp=rand(0000,9999);  //varification work pending
    //         $data = new User;
    //         $data->name=$request->name;
    //         $data->email=$request->email;
    //         $data->phone=$request->phone;
    //         $data->password=bcrypt($request->password);
    //         $data->user_type=$request->user_type;
    //         $data->save();


    //         $data1 = new UserDetail;
    //         $data1->user_id=$data->id;
    //         $data1->user_name=$data->name;
    //         $data1->email= $data->email;
    //         $data1->mobile=$data->phone;
    //         $data1->speciality=$request->speciality;

    //         $data1->save();

    //         $data2 = new DeWallet;
    //         $data2->user_id=$data->id;
    //         $data2->coin=0;
    //         $data2->save();

    //         $user = User::where('email',$request->email)->first();
    //         if ($request->phone!=null) {
    //             $otp = rand (1000, 9999);
    //             $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.Stay Home !!!  Stay safe !!!");
    //             $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
    //             curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
    //             $response=curl_exec($curl);
    //             curl_close($curl);
    //         }
    //         $user1 = User::where('user_type',1)->first();
    //         if($user->user_type == 2){
    //             $user_type = 'User';
    //         }elseif($user->user_type == 3){
    //             $user_type = 'Doctor';
    //         }
    //         if($request->user_type == 2){
    //             $to_name = $data->name;
    //             $to_email = $data->email;
    //             Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
    //                 $message->to($to_email, $to_name)
    //                 ->subject('Registration In DHD');
    //                 $message->from('support@drhelpdesk.in','Drhelpdesk');
    //             });
    //         }elseif($request->user_type == 3){
    //             $to_name = $data->name;
    //             $to_email = $data->email;
    //             Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
    //                 $message->to($to_email, $to_name)
    //                 ->subject('Registration In DHD');
    //                 $message->from('support@drhelpdesk.in','Drhelpdesk');
    //             });
    //         }

    //         // $user = User::where('email',$request->email)->first();
    //         // if ($request->phone!=null) {
    //         //     $otp = rand (1000, 9999);
    //         //     $msg=urlencode("Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You
    //         //         .");
    //         //     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
    //         //     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
    //         //     $response=curl_exec($curl);
    //         //     curl_close($curl);
    //         // }

    //         // $to = $data['email'];
    //         // $subject = 'WelCome In DHD';
    //         // $message = "Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You.";
    //         // $headers = 'From:support@drhelpdesk.in';
    //         // if(mail($to, $subject, $message, $headers)) {

    //         // }
    //         // else {

    //         // }

    //         // $user1 = User::where('user_type',1)->first();
    //         // if($user->user_type == 2){
    //         //     $user_type = 'User';
    //         // }elseif($user->user_type == 3){
    //         //     $user_type = 'Doctor';
    //         // }
    //         // $to = $user1['email'];
    //         // $subject = 'New'.$user_type.'Registration with DHD';
    //         // $message = "Dear ".$request->name.", \nEmail-       ".$request->email."\n And Password is-     ".$request->password." \n\nThank You.";
    //         // $headers = 'From:support@drhelpdesk.in';
    //         // if(mail($to, $subject, $message, $headers)) {
    //         //     // echo 'Your Login Credentials Is Send To your registered email Address';
    //         // }
    //         // else {
    //         //     // echo 'Sorry! something went wrong, please try again.';
    //         // }
    //     }
    //     catch(\Exception $e){
    //         echo $e;
    //         dd($e);
    //     }
    //     return back()->with('msg','Registration Successfull Please Complete Your Profile After Login !'); }
    public function userRegistrationSubmit(Request $request) {
        $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users',
                'phone'=>'required|numeric|unique:users',
                'password' => 'min:4',
                //'password_confirmation' => 'min:6'
            ],

            [
                'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
            ]

        );
        $session = Session::getId();
        $result = DB::table('registers')->where('session_id',$session)->first();
        try{
            $otp=rand(0000,9999);  //varification work pending
            $data = new User;
            $data->name=$result->name;
            $data->email=$result->email;
            $data->phone=$result->phone;
            $data->password=bcrypt($result->password);
            $data->user_type=$result->user_type;
            $data->save();


            $data1 = new UserDetail;
            $data1->user_id=$data->id;
            $data1->user_name=$data->name;
            $data1->email= $data->email;
            $data1->mobile=$data->phone;
            $data1->speciality=$result->speciality;

            $data1->save();

            $data2 = new DeWallet;
            $data2->user_id=$data->id;
            $data2->coin=20;
            $data2->save();

            $user = User::where('email',$request->email)->first();
            if ($request->phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.                                                     Stay Home !!!  Stay safe !!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }
            $user1 = User::where('user_type',1)->first();
            if($user->user_type == 2){
                $user_type = 'User';
            }elseif($user->user_type == 3){
                $user_type = 'Doctor';
            }
            if($request->user_type == 2){
                $to_name = $data->name;
                $to_email = $data->email;
                Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });
            }elseif($request->user_type == 3){
                $to_name = $data->name;
                $to_email = $data->email;
                Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });
            }

            // $user = User::where('email',$request->email)->first();
            // if ($request->phone!=null) {
            //     $otp = rand (1000, 9999);
            //     $msg=urlencode("Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You
            //         .");
            //     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
            //     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
            //     $response=curl_exec($curl);
            //     curl_close($curl);
            // }

            // $to = $data['email'];
            // $subject = 'WelCome In DHD';
            // $message = "Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You.";
            // $headers = 'From:support@drhelpdesk.in';
            // if(mail($to, $subject, $message, $headers)) {

            // }
            // else {

            // }

            // $user1 = User::where('user_type',1)->first();
            // if($user->user_type == 2){
            //     $user_type = 'User';
            // }elseif($user->user_type == 3){
            //     $user_type = 'Doctor';
            // }
            // $to = $user1['email'];
            // $subject = 'New'.$user_type.'Registration with DHD';
            // $message = "Dear ".$request->name.", \nEmail-       ".$request->email."\n And Password is-     ".$request->password." \n\nThank You.";
            // $headers = 'From:support@drhelpdesk.in';
            // if(mail($to, $subject, $message, $headers)) {
            //     // echo 'Your Login Credentials Is Send To your registered email Address';
            // }
            // else {
            //     // echo 'Sorry! something went wrong, please try again.';
            // }
        }
        catch(\Exception $e){
            echo $e;
            dd($e);
        }
        return redirect('thank-you-reg');
        //return back()->with('msg','Registration Successfull Please Complete Your Profile After Login !');
    }
    public function otpSubmit(Request $request) {
        $session = Session::getId();
        $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users',
                'phone'=>'required|numeric|unique:users',
                'password' => 'min:4',
                //'password_confirmation' => 'min:6'
            ],

            [
                'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
            ]

        );
        try{
            $token = rand(111111, 999999);    //varification work pending

            $data = new Register;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->password=bcrypt($request->password);
            $data->user_type=$request->user_type;
            $data->otp=$token;
            $data->speciality=$request->speciality;
            $data->session_id = $session;
            $data->save();

            if ($request->phone!=null) {
                $msg=urlencode($token." is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }

        }
        catch(\Exception $e){
            echo $e;
            dd($e);
        }
        return redirect('otp')->with('msg','Your Otp is send to your mobile number please verify first to complete registration process!');
    }
    public function otp(){
        return view('UI/components/user/otp_submit');
    }
    public function otpresend(Request $request){
        try{
            $token = rand(111111, 999999);
            $session = Session::getId();
            $result = DB::table('registers')->select('id','phone')->where('session_id',$session)->first();
            $tabId = $result->id;
            DB::select(DB::raw('update registers set otp='.$token.' where id='.$tabId));
                $msg=urlencode($token." is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$result->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            echo  '1';
        }catch(\Exception $e){
            echo '2';
        }
    }
    public function otpSubmit1(Request $request) {
        $otp_verify = DB::table('registers')->where('otp',$request->otp)->first();
            if($otp_verify != null){
                $session = Session::getId();
                $result = DB::table('registers')->where('otp',$request->otp)->first();

                $data = new User;
                $data->name=$result->name;
                $data->email=$result->email;
                $data->phone=$result->phone;
                $data->password= $result->password;
                $data->user_type=$result->user_type;
                $data->save();


                $data1 = new UserDetail;
                $data1->user_id=$data->id;
                $data1->user_name=$data->name;
                $data1->email= $data->email;
                $data1->mobile=$data->phone;
                $data1->speciality=$result->speciality;

                $data1->save();

                $data2 = new DeWallet;
                $data2->user_id=$data->id;
                $data2->coin=0;
                $data2->save();

                $user = User::where('email',$result->email)->first();
                if ($result->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.                                                     Stay Home !!!  Stay safe !!!");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$result->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }

                $user1 = User::where('user_type',1)->first();
                if($user->user_type == 2){
                    $user_type = 'User';
                }elseif($user->user_type == 3){
                    $user_type = 'Doctor';
                }
                if($user->user_type == 2){
                    $to_name = $data->name;
                    $to_email = $data->email;
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
                }elseif($user->user_type == 3){
                    $to_name = $data->name;
                    $to_email = $data->email;
                    Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
                }
                DB::table('registers')->where('otp',$request->otp)->delete();

                return redirect('login-user')->with('message','Registration Successfull Please Complete Your Profile After Login !');
            }else{
                return back()->with('msg','Otp Not Match');
            }
    }*/

    public function userRegistrationSubmit(Request $request) {
        $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users',
                'phone'=>'required|numeric|unique:users',
                'password' => 'min:4',
               // 'password_confirmation' => 'min:6'
            ],

            [
                'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
            ]

        );
        $session = Session::getId();
        $result = DB::table('registers')->where('session_id',$session)->first();
        try{
            $otp=rand(0000,9999);  //varification work pending
            $data = new User;
            $data->name=$result->name;
            $data->email=$result->email;
            $data->phone=$result->phone;
            $data->password=bcrypt($result->password);
            $data->user_type=$result->user_type;
            $data->save();


            $data1 = new UserDetail;
            $data1->user_id=$data->id;
            $data1->user_name=$data->name;
            $data1->email= $data->email;
            $data1->mobile=$data->phone;
            $data1->speciality=$result->speciality;

            $data1->save();

            $data2 = new DeWallet;
            $data2->user_id=$data->id;
            $data2->coin=20;
            $data2->save();

            $user = User::where('email',$request->email)->first();
            if ($request->phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900579607316&sendto=".$request->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }
            $user1 = User::where('user_type',1)->first();
            if($user->user_type == 2){
                $user_type = 'User';
            }elseif($user->user_type == 3){
                $user_type = 'Doctor';
            }
            if($request->user_type == 2){
                $to_name = $data->name;
                $to_email = $data->email;
                Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });
            }elseif($request->user_type == 3){
                $to_name = $data->name;
                $to_email = $data->email;
                Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });
            }

            // $user = User::where('email',$request->email)->first();
            // if ($request->phone!=null) {
            //     $otp = rand (1000, 9999);
            //     $msg=urlencode("Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You
            //         .");
            //     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$request->phone."&message=".$msg);
            //     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
            //     $response=curl_exec($curl);
            //     curl_close($curl);
            // }

            // $to = $data['email'];
            // $subject = 'WelCome In DHD';
            // $message = "Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You.";
            // $headers = 'From:support@drhelpdesk.in';
            // if(mail($to, $subject, $message, $headers)) {

            // }
            // else {

            // }

            // $user1 = User::where('user_type',1)->first();
            // if($user->user_type == 2){
            //     $user_type = 'User';
            // }elseif($user->user_type == 3){
            //     $user_type = 'Doctor';
            // }
            // $to = $user1['email'];
            // $subject = 'New'.$user_type.'Registration with DHD';
            // $message = "Dear ".$request->name.", \nEmail-       ".$request->email."\n And Password is-     ".$request->password." \n\nThank You.";
            // $headers = 'From:support@drhelpdesk.in';
            // if(mail($to, $subject, $message, $headers)) {
            //     // echo 'Your Login Credentials Is Send To your registered email Address';
            // }
            // else {
            //     // echo 'Sorry! something went wrong, please try again.';
            // }
        }
        catch(\Exception $e){
            echo $e;
            dd($e);
        }
       // return back()->with('msg','Registration Successfull Please Complete Your Profile After Login !');
    	return redirect('thank-you-reg');
    }
    public function otpSubmit(Request $request) {
        // dd($request);
        // $phone = $request->phone;
        $check_existing_user = DB::table('users')->where('phone',$request->phone)->count();
        // dd($check_existing_user);
        if($check_existing_user > 0){
            toastr()->error('You are Already Registered');
            return back();

        }else{

        if($request->refer_code){
            $check_refer_code = User::where('refer_code', $request->refer_code)->first();
            if($check_refer_code == null){
                return back()->with('msg', 'Oops!!! Wrong Referral Code, Pls Enter Correct Referral Code to Earn D-Coins');
            }else{
                $session = Session::getId();
                $request->validate(
                    [
                        'name' => 'required',
                        'phone' => 'required|numeric|unique:users',
                        'password' => 'min:4',
                        //'password_confirmation' => 'min:6'
                    ],

                    [
                        'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
                    ]

                );
                try {
                    $token = rand(111111, 999999);    //varification work pending

                    $data = new Register;
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->phone = $request->phone;
                    $data->password = bcrypt($request->password);
                    $data->user_type = $request->user_type;
                    $data->apply_refer_code = $request->refer_code;
                    $data->otp = $token;
                    $data->speciality = $request->speciality;
                    $data->session_id = $session;
                    $data->save();

                    if ($request->phone != null) {
                        $msg = urlencode($token . " is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900607736794&sendto=" . $request->phone . "&message=" . $msg);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($curl);
                        curl_close($curl);
                    }
                } catch (\Exception $e) {
                    echo $e;
                    dd($e);
                }
                toastr()->info('Your Otp is send to your mobile number please verify first to complete registration process!');
                return redirect('otp');
            }
        }else{

            $session = Session::getId();
            $request->validate([
                    'name'=> 'required',
                    'phone'=>'required|numeric|unique:users',
                    'password' => 'min:4',
                    //'password_confirmation' => 'min:6'
                ],

                [
                    'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
                ]

            );
            try{
                $token = rand(111111, 999999);    //varification work pending
                // dd($token);
                $data = new Register;
                $data->name=$request->name;
                $data->email=$request->email;
                $data->phone=$request->phone;
                $data->password=bcrypt($request->password);
                $data->user_type=$request->user_type;
                $data->apply_refer_code = $request->refer_code;
                $data->otp=$token;
                $data->speciality=$request->speciality;
                $data->session_id = $session;
                $data->save();

                if ($request->phone!=null) {
                    $msg = urlencode($token ." is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900607736794&sendto=".$request->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }

            }
            catch(\Exception $e){
                echo $e;
                dd($e);
            }
            toastr()->info('Your Otp is send to your mobile number please verify first to complete registration process!');
            return redirect('otp');
        }
    }
    }
    public function otp(){
        return view('UI/components/user/otp_submit');
    }
    public function otpresend(Request $request){
        try{
            $token = rand(111111, 999999);
            $session = Session::getId();
            $result = DB::table('registers')->select('id','phone')->where('session_id',$session)->first();
            $tabId = $result->id;
            DB::select(DB::raw('update registers set otp='.$token.' where id='.$tabId));
                $msg = urlencode($token . " is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900607736794&sendto=".$result->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            echo  '1';
        }catch(\Exception $e){
            echo '2';
        }
    }
    public function otpSubmit1(Request $request) {
        $otp_verify = DB::table('registers')->where('otp',$request->otp)->first();
            if($otp_verify != null){
                $session = Session::getId();
                $result = DB::table('registers')->where('otp',$request->otp)->first();
           		$cart = TempCart::where('session_id',Session::getId())->get();

                $data = new User;
                $data->name=$result->name;
                $data->email=$result->email;
                $data->phone=$result->phone;
                $data->password= $result->password;
                $data->user_type=$result->user_type;
                $is_saved = $data->save();

                $refer_code = rand(100000, 999999);
                //dd($refer_code);
                if ($is_saved) {
                    DB::table('users')->where('id', $data->id)->update([
                        'refer_code' => $refer_code
                    ]);
                }

                $data1 = new UserDetail;
                $data1->user_id=$data->id;
                $data1->user_name=$data->name;
                $data1->email= $data->email;
                $data1->mobile=$data->phone;
                $data1->speciality=$result->speciality;

                $data1->save();
            	foreach ($cart as $r){
                    $result1=DB::table('carts')->where('product_id',$r->product_id)->where('user_id',$data->id)->first();
                    if($result1 == null){
                        $data_cart = new Cart;
                        $data_cart->user_id= $data->id;
                        $data_cart->product_id= $r->product_id;
                        $data_cart->quantity=  $r->quantity;
                        $data_cart->type=  $r->type;
                        $data_cart->save();
                    }
                    TempCart::where('session_id',$r->session_id)->delete();
                }

                if ($result->apply_refer_code == null) {
                    $data2 = new DeWallet;
                    $data2->user_id = $data->id;
                    $data2->coin = 0;
                    $data2->save();
                }

                if ($result->apply_refer_code != null) {
                    $refer_code1 = new ApplyReferCode;
                    $refer_code1->user_id = $data->id;
                    $refer_code1->apply_refer_code = $result->apply_refer_code;
                    $refer_code1->save();
                }

                $user = User::where('phone',$result->phone)->first();
                if ($result->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Your refer code is " . $refer_code . "Thank you for registering with DrHelpDesk.Enjoy Online Shopping.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900660923784&sendto=".$result->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }
                if ($result->apply_refer_code != null) {
                    $check_refer_code = User::where('refer_code', $result->apply_refer_code)->first();
                    DB::table('de_wallets')->where('user_id', $check_refer_code->id)->update([
                        'coin' => $check_refer_code->coin + 20
                    ]);

                    $data2 = new DeWallet;
                    $data2->user_id = $data->id;
                    $data2->coin = 20;
                    $data2->save();

                    if ($check_refer_code->phone != null) {
                        $otp = rand(1000, 9999);
                        $msg = urlencode("Your refer code is used by other and you earn 20 coin in your de-wallet account");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" . $check_refer_code->phone . "&message=" . $msg);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($curl);
                        curl_close($curl);
                    }
                }

                $user1 = User::where('user_type',1)->first();
                if($user->user_type == 2){
                    $user_type = 'User';
                }elseif($user->user_type == 3){
                    $user_type = 'Doctor';
                }
                // dd($user->email);
                if($user->user_type == 2 && $user->email !=''){
                    $to_name = $data->name;
                    $to_email = $data->email;
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });

                    // send mail to drdelpdesk manager after newuser register

                    // if ($to_email != null) {
                    //     $to = 'anujrathoure9889@yahoo.com';
                    //     $subject = 'New User Register in  DHD';
                    //     $message = "Dear Sir New User Register in website has name".$to_name."and mail".$to_email;
                    //     $headers = 'From:support@drhelpdesk.in';
                    //     if(mail($to, $subject, $message, $headers)) {
                    //         //
                    //     }
                    //     else {
                    //         //
                    //     }

                    // }
                    $to = 'anujrathoure9889@yahoo.com';
                         $subject = 'New User Register in  DHD';
                         $message = "Dear Sir New User Register in website has name".$to_name."and mail".$to_email;
                    Mail::send('emails.approve', ['msg' => $message], function($message) use ($to) {
                        $message->to($to)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });



                	$admin = User::where('user_type',1)->first();
                    $to_name1 = $admin->name;
                    $to_email1 = $admin->email;
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name1, $to_email1) {
                        $message->to($to_email1, $to_name1)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
                }elseif($user->user_type == 3){
                    $to_name = $data->name;
                    $to_email = $data->email;
                    Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
                	$admin = User::where('user_type',1)->first();
                    $to_name1 = $admin->name;
                    $to_email1 = $admin->email;
                    Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name1, $to_email1) {
                        $message->to($to_email1, $to_name1)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    });
                }
                DB::table('registers')->where('otp',$request->otp)->delete();
                if($user->user_type == 2){
                    Auth::login($data);
                    //return redirect('/dashboard')->with('message','Registration Successfull Please Complete Your Profile After Login !');
                	return redirect('thank-you-reg')->with('message','Registration Successfull Please Complete Your Profile After Login !');
                }elseif($user->user_type == 3){
                    //return redirect('/login-user')->with('message','Registration Successfull Please Wait For An Approval By Admin');
                	return redirect('thank-you-reg')->with('message','Registration Successfull Please Wait For An Approval By Admin');
                }
            }else{
                toastr()->error('Otp Not Match');
                return back();
            }
    }

    public function userLoginSubmit(Request $request) {
        $mode = $this->isEmail($request->get('phn_or_email'));
       $session = Session::getId();
        $cart = TempCart::where('session_id',Session::getId())->get();
       $data = [];
        if($mode){
            $data['email'] = $request->get('phn_or_email');
            $data['password'] = $request->get('password');
            // $data['user_type'] = $request->get('user_type');
        }else{
           $data['phone'] = $request->get('phn_or_email');
            $data['password'] = $request->get('password');
            // $data['user_type'] = $request->get('user_type');
        }


         if(Auth::attempt($data))
        {
            session ( [
                'name' => ($mode == 'email')?$data['email']:$data['phone'] ,
            ]);
            foreach ($cart as $r){
               $result1=DB::table('carts')->where('product_id',$r->product_id)->where('user_id',Auth::user()->id)->first();
                    if($result1 == null){
                        $data = new Cart;
                        $data->user_id= Auth::user()->id;
                        $data->product_id= $r->product_id;
                        $data->quantity=  $r->quantity;
                        $data->type=  $r->type;
                        $data->save();
                    }
                    TempCart::where('session_id',$r->session_id)->delete();
            }
            $doc_id = $request->get('doc_id');

            if(!empty($doc_id)) {
                return back();
            } else {
                return redirect('/dashboard');
            }
        }else {

            toastr()->error('Invalid Username Or Password Please Try Again');

            return back();
        }
    }

    // public function dashboard(){
    //     if(Auth::user()->user_type == 1){
    //         return redirect('admin');
    //     }elseif(Auth::user()->user_type == 2){
    //         return redirect('/');
    //     }elseif(Auth::user()->user_type == 3){
    //         return redirect('/');
    //     }elseif(Auth::user()->user_type == 4){
    //         return redirect('/');
    //     }
    // }
    public function dashboard(){
        if(Auth::user()->user_type == 1){
            return redirect('admin');
        }elseif(Auth::user()->user_type == 2 &&  Auth::user()->is_block == 0){
            return redirect('/');
        }elseif(Auth::user()->user_type == 3 &&  Auth::user()->is_block == 0 &&  Auth::user()->is_active == 1){
            return redirect('/');
        }else{
            return redirect('/block');
        }
    }
	public function logout(Request $request) {
      Auth::logout();
      return back()->with('message','Oops!!! Sorry for the inconvenience, Please contact customer support.');
    }

    public function addtoCart(Request $req){
        $session = Session::getId();
        $type = 1;
        if(!empty($req->cat_id) && $req->cat_id==15){
            $type = 2;
        }
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count();
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'attribute_id'=>$req->attribute_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>1
                ]);
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count();
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'attribute_id'=>$req->attribute_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>1
                ]);
            }
        }
        // Session::flash ( 'message1', "Item Added into Cart" );
        toastr()->success('Item Added into Cart');
        return back();
    }

    public function addtoCart1(Request $req){
        // dd($req);
        $session = Session::getId();
        $type = 1;
        if(!empty($req->cat_id) && $req->cat_id==15){
            $type = 2;
        }
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count();
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'attribute_id'=>$req->attribute_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>$req->quantity
                ]);

            }
            $this->removeInvalidReferCodes();
            $refer_code = Refer_code::where('refer_code',Session::get('refer_code_'. $req->products_id))->first();
            // dd($refer_code);
            if(isset($refer_code)){
                $from = $refer_code->user_id;
                $to = Auth::user()->id;
                $product_attribute = ProductAttribute::where('products_id',$refer_code->product_id)->first();
                if($product_attribute->special_price){
                    $price = $product_attribute->special_price;
                    }else{
                        $price = $product_attribute->price;
                    }
                    
                    $coin = (round(($price/100)*2));
                    // dd($coin);
                //Added to referer account
                $this->deWalletTransaction($from,$to,'refer',$coin,$refer_code->refer_code,'In Cart');
                //Added to current user account
                $this->deWalletTransaction($to,$from,'company',$coin,$refer_code->refer_code,'Pending');
                // dd($refer_code);
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count();
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'attribute_id'=>$req->attribute_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>$req->quantity
                ]);
            }
        }
        // Session::flash ( 'message1', "Item Added into Cart" );
        toastr()->success('Item Added into Cart');
        //return back();
        return Auth::check() ? back() : back();
    }
    function getCity($lat,$lng)

    {
         $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM';
         $json = @file_get_contents($url);
         $data=json_decode($json);

         $status = $data->status;
         if($status=="OK")
         {
          //Get address from json data
          for ($j=0;$j<count($data->results[0]->address_components);$j++) {
            $cn=array($data->results[0]->address_components[$j]->types[0]);
            if(in_array("administrative_area_level_2", $cn)) {
                $city= $data->results[0]->address_components[$j]->long_name;
            }
           }
           return $city;
         }
         else
         {
           return false;
         }
    }

    public function find_shipping_cost(Request $req){
        // echo "<pre>"; print_r($req->latitude); exit;
        $lat = $req->latitude;
        $long = $req->longitude;
        $tamount = $req->total;

        $selected_city = $this->getCity($lat,$long);


        if(!$selected_city || !$lat || !$long){
            echo json_encode(array(
                "status" => false,
                "msg"=>"Unable to find your city"
            )); exit;
        }

         $cur_location = strtolower($req->session()->get('location_name'));


        // Shipping charge calculation
        $locations = DB::table("locations")->where("status","0")->get();
        $product_locations = [];
        foreach ($locations as $key => $value) {
            $product_locations[] = strtolower($value->location_name);
        }

         $shipping_data = ShippingSetting::where('id',1)->first();

        if(!empty($cur_location) && $cur_location != "notfound"){
            if(in_array($cur_location, $product_locations)){
              // if user purchased greater than max order , no shipping charge
            if($tamount <= $shipping_data->min_order_price){
              $shipping_percent = $shipping_data->charge_inside_location;
            }else{
              $shipping_percent = 0;
            }

              echo json_encode(array(
                "status" => true,
                "shipping_cost" => round($shipping_percent,2),
                "total" => round(($tamount + $shipping_percent),2)
             )); exit;
            }
        }


        if($tamount >= $shipping_data->min_order_price){
            $shipping_percent = 0;
        }else if(!in_array($selected_city, $product_locations)){
          // if user purchased min order , outside location
          $shipping_percent = $shipping_data->charge_outside_location;
        }elseif(in_array($selected_city, $product_locations) && $tamount <= $shipping_data->min_order_price){
          // if user purchased min order , inside location
          $shipping_percent = $shipping_data->charge_inside_location;
        }else{
          // if user purchased greater than max order , no shipping charge
          $shipping_percent = 0;
        }

        echo json_encode(array(
            "status" => true,
            "shipping_cost" => round($shipping_percent,2),
            "total" => round(($tamount + $shipping_percent),2)
        )); exit;

    }
    public function userMyCart(Request $req){

        $refer_code = false;
        if(Session::get('refer_code')){
            // dd(Session::get('refer_code'));
            $this->removeInvalidReferCodes();
            $refer_code = Refer_code::where('refer_code',Session::get('refer_code'))->first();
            if(isset($refer_code)){
                $from = $refer_code->user_id;
                $to = Auth::user()->id;
                if($product_attribute->special_price){
                    $price = $product_attribute->special_price;
                    }else{
                        $price = $product_attribute->price;
                    }
                    // dd($price);
                    $coin = (round(($price/100)*2));
                //Added to referer account
                $this->deWalletTransaction($from,$to,'refer',$coin,$refer_code->refer_code,'In Cart');
                //Added to current user account
                $this->deWalletTransaction($to,$from,'company',$coin,$refer_code->refer_code,'Pending');

                Session::put('refer_code_message','Refer code appliend you get 2% discount.');
            }else{
                Session::put('refer_code_message','Refer code is not valid.');
            }
            //$this->storeReferTransaction(Session::get('refer_code'));
        }

        $value = $req->session()->get('location_name');
        $data['map_location']= $value;
       // dd($value);
        $data['flag'] = 2;
    	//dd($req->remove);
        $dt = Carbon::now()->toDateString();
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first();
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get();
          // dd($match->count());
        }
        //dd($req->session()->get('couponData')['type1']);
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;
        $data['coupon_error'] = '0';
    	$data['result1'] = "";

    	if(!empty($req->remove) && $req->remove=='1') {
        	$req->session()->forget('couponData');
        	$req->session()->save();
        	Session::forget('couponData');
    		Session::save();
        } else {
        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied";
                $data['type'] = $coupon1->type;
                $type1 = $coupon1->type;
                $cc = $coupon1->amount;
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]);
                //session(['amount'=>$cc]);
                $data['copoun_amount']=$cc;
                $data['type_price']=$type1;
               // dd( $data['copoun_amount']);
               $data['coupon_error'] = '1';
            }else{
                $data['coupon_error'] = '2';
                $data['result1']='Your coupon code limit exceed.';
            }
            //($data['result1']);
        }
        if($coupon1 == null && !empty($req->coupon_code)){
            $data['coupon_error'] = '3';
            $data['result1']='';
        }
    	}
        $session = Session::getId();
        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get();
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type','attribute_id')->get();
        // dd($cart);
        $count = DB::table('temp_carts')->where('session_id',$session)->count();
        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }

        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                ->select('products.products_id','products.product_name' ,'product_attributes.price' ,'product_attributes.extra_discount' , 'product_attributes.special_price','temp_carts.quantity','temp_carts.temp_carts_id', 'temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
            //   ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
              ->select('packages.id','packages.special_price','packages.package_name','packages.package' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
            //dd($data1);
        }

        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                ->select('products.products_id','products.product_name' ,'product_attributes.price','product_attributes.extra_discount' , 'product_attributes.special_price','product_attributes.id','carts.quantity','carts.id','carts.attribute_id', 'carts.type')
                ->where('product_attributes.id',$r2->attribute_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id As package_id','packages.special_price','packages.package_name','packages.package' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            //   dd($data1);
            }
        }
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;
            // dd( $data['result']);
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }

    //    dd($data);
        return view('UI/webviews/user.manage_user',$data);
    }

    // public function userMyCart1(){
    //     $data['flag'] = 2;
    //     $session = Session::getId();
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count();

    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price' ,'products.extra_discount' , 'products.special_price','temp_carts.quantity','temp_carts.temp_carts_id')->where('products.products_id',$r1)
    //         ->first();
    //     }

    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price','products.extra_discount' , 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping';
    //     }
    //     return view('UI/webviews/user.manage_user',$data);
    // }

    public function cartUpdate(Request $req){
        if(Auth::check()){
           Cart::where('id',$req->cart_id)->update([
             'quantity'=>$req->new_quantity
            ]);
        }else{
            TempCart::where('temp_carts_id',$req->cart_id)->update([
             'quantity'=>$req->new_quantity
            ]);
        }

        return 1;
    }

    public function removeProduct(Request $req){

    	if(Auth::check()){
             Cart::where('id',$req->cart_id)->delete();
        }else{
            TempCart::where('temp_carts_id',$req->cart_id)->delete();
        }
    	$session_id = Session::getId();
    	$count1 = DB::table('carts')->where('user_id',Auth::id())->count();
        $count = DB::table('temp_carts')->where('session_id',$session_id)->count();
    	if($count1=='0' && $count=='0') {
        	Session::forget('couponData');
        	Session::save();
        }
        toastr()->error('product successfully deleted from cart');
    	return 1;
    }

    // public function userCheckout2(Request $req){
    //     $data['flag'] = 3;
    //     // $latitude = 26.2657;
    //     // $longitude =  77.9940;
    //     // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyCx7vsP8llZYTAmjxBD6-yM6z_UJvff2W4";
    //     // $geocodeResponseData = file_get_contents($googleMapUrl);
    //     // $responseData = json_decode($geocodeResponseData, true);
    //     // if($responseData['status']=='OK')
    //     // {
    //     //     foreach ($responseData['results'][0]['address_components'] as $r) {
    //     //         if ($r['types'][0]== 'locality') {
    //     //             //$city = $r['long_name'];
    //     //             break;
    //     //         }
    //     //     }
    //     // }
    //     //session(['city'=>$city]);
    //     $data['session']=session('city');
    //     $data['url'] = "";
    //     $session = Session::getId();
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count();
    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
    //         ->first();
    //     }
    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping';
    //     }
    //     return view('UI/webviews/user.manage_user',$data);
    // }

    // public function userCheckout3(Request $req){
    //     $data['flag'] = 3;
    //     // $latitude = 26.4947;
    //     // $longitude =  77.9940;
    //     // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyCx7vsP8llZYTAmjxBD6-yM6z_UJvff2W4";
    //     // $geocodeResponseData = file_get_contents($googleMapUrl);
    //     // $responseData = json_decode($geocodeResponseData, true);
    //     // if($responseData['status']=='OK')
    //     // {
    //     //     foreach ($responseData['results'][0]['address_components'] as $r) {
    //     //         if ($r['types'][0]== 'locality') {
    //     //             $city = $r['long_name'];
    //     //             break;
    //     //         }
    //     //     }
    //     // }
    //     // session(['city'=>$city]);
    //     $data['session']=session('city');
    //     $data['url'] = $req->prescription_id;
    //     $session = Session::getId();
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count();
    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.categories' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
    //         ->first();
    //     }
    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.categories' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping';
    //     }
    //     return view('UI/webviews/user.manage_user',$data);
    // }
    public function userCheckout(Request $req){

        $data['flag'] = 3;

        $value = $req->session()->get('location_name');
        $data['map_location']= $value;

        $data['session']=$value;
        $data['url'] = "";
        $session = Session::getId();
    //dd($req->coupon_code, $req->session()->get('couponData'));
        //add couponn funcinility
        $dt = Carbon::now()->toDateString();
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first();
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get();
          // dd($match->count());
        }
        //dd($req->session()->get('couponData'));
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;

        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied";
                $data['type'] = $coupon1->type;
                $type1 = $coupon1->type;
                $cc = $coupon1->amount;
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]);
                //session(['amount'=>$cc]);
                $data['copoun_amount']=$cc;
                $data['type_price']=$type1;
               // dd( $data['copoun_amount']);
            }else{
                $data['result1']='Your coupon code limit exceed.';
            }
            //($data['result1']);
        }
        else{
            $data['result1']='';
        }
   // dd($req->session()->get('couponData'));
    	$r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type','attribute_id')->get();
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type','attribute_id')->get();

    	$p_type = false;
    	if(count($cart) > 0) {
            foreach($cart as $val) {
                  if($val->type==2) {
                  		$p_type = true;
                  		break;
                  }
             }
        }

    	if(count($r) > 0) {
            foreach($r as $val) {
                  if($val->type==2) {
                  		$p_type = true;
                  		break;
                  }

             }
        }
    	//end coupon functionolity
        $prescriptionReqTempCart = DB::Select(DB::raw("SELECT count(temp_carts_id) as ptotal FROM `temp_carts` as tc inner join products as p on p.products_id = tc.product_id inner join product_attributes as a on p.products_id = a.products_id where p.prescription='1' and tc.session_id='".$session."'"));
        $prescriptionReqCart = DB::Select(DB::raw("SELECT count(tc.id) as ptotal FROM `carts` as tc inner join products as p on p.products_id = tc.product_id inner join product_attributes as a on p.products_id = a.products_id where p.prescription='1' and tc.user_id='".Auth::id()."'"));


        if($prescriptionReqTempCart[0]->ptotal > 0 || $prescriptionReqCart[0]->ptotal > 0){
        	if($p_type==true){
            	return redirect('upload-prescription/2');
            } else {
            	return redirect('upload-prescription/1');
            }

        }

        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id  WHERE c.type in (1) and c.user_id='.Auth::id()));
        }

        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;

        $count = DB::table('temp_carts')->where('session_id',$session)->count();
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                ->select('products.products_id','products.product_name' ,'product_attributes.price', 'products.prescription' ,'product_attributes.extra_discount', 'product_attributes.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')
                ->where('product_attributes.id',$r1->attribute_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
            //   ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
              ->select('packages.id','packages.special_price','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        // price fetch by attribute wise
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                ->select('products.products_id','products.product_name' ,'product_attributes.price', 'products.prescription' , 'product_attributes.extra_discount', 'product_attributes.special_price','carts.quantity','carts.id','carts.type')
                ->where('product_attributes.id',$r2->attribute_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.special_price','packages.package_name','packages.package','packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }

        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }

        // Shipping charge calculation
        $locations = DB::table("locations")->where("status","0")->get();
        $product_locations = [];
        foreach ($locations as $key => $value) {
            $product_locations[] = strtolower($value->location_name);
        }

        $lab_locations = DB::table("lab_locations")->where("status","0")->get();
        $lab_locs = [];

        foreach ($lab_locations as $key => $value) {
            $lab_locs[] = strtolower($value->location_name);
        }

        $selected_address = DB::table('user_addresses')->where('user_id',Auth::id())->where('selected',"1")->first();
        $selected_city = $selected_address?strtolower($selected_address->city):"";

        $data["locations"]        =  $product_locations;
        $data["lab_locations"]    =  $lab_locs;
        $data["selected_address"] =  DB::table('user_addresses')->where('user_id',Auth::id())->first();
        $data["selected_city"] = strtolower($selected_city);

        $data['shipping_data'] = ShippingSetting::where('id',1)->first();

        // echo "<pre>"; print_r($data["selected_city"]); exit;
        return view('UI/webviews/user.manage_user',$data);
    }

    /*public function userCheckout1(Request $req){
        $data['flag'] = 3;
        $value = $req->session()->get('location_name');
           $data['map_location']= $value;
        $data['session']=$value;
        $data['url'] = $req->prescription_id;
        $session = Session::getId();
        $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
        $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
        $count = DB::table('temp_carts')->where('session_id',$session)->count();
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        // foreach ($r as $key => $r1) {
        //     $data1[]=DB::table('products')
        //     ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
        //     ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription', 'products.categories' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
        //     ->first();
        // }
        // foreach ($cart as $key => $r2) {
        //     $data1[]=DB::table('products')
        //     ->join('carts', 'products.products_id', '=', 'carts.product_id')
        //     ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription', 'products.categories' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
        //     ->first();
        // }
        $data1 = [];
        foreach ($r as $key => $r1) {
            if($r1['type'] == 1 || $r1['type'] == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1['type'] == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2['type'] == 1 || $r2['type'] == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2['type'] == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }
        dd($data);
        return view('UI/webviews/user.manage_user',$data);
    }*/
    /*public function userCheckout1(Request $req){
        $data['flag'] = 3;
        $value = $req->session()->get('location_name');
        $data['map_location']= $value;

        $data['session']=$value;
        $data['url'] = $req->prescription_id;
        $session = Session::getId();

        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get();
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type')->get();
        $count = DB::table('temp_carts')->where('session_id',$session)->count();

        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;

        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.prescription', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.prescription', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        $data['type1totalitem'] = $type1Toatl;
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }

        return view('UI/webviews/user.manage_user',$data);
    }*/

    public function userCheckout1(Request $req){
        $data['flag'] = 3;
        $value = $req->session()->get('location_name');
        $data['map_location']= $value;

        $data['session']=$value;
        $data['url'] = !empty($req->prescription_id) ? $req->prescription_id: "";
        $session = Session::getId();
        //add couponn funcinility
        $dt = Carbon::now()->toDateString();
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first();
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get();
          // dd($match->count());
        }
        //dd($req->session()->get('couponData')['type1']);
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;

        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied";
                $data['type'] = $coupon1->type;
                $type1 = $coupon1->type;
                $cc = $coupon1->amount;
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]);
                //session(['amount'=>$cc]);
                $data['copoun_amount']=$cc;
                $data['type_price']=$type1;
               // dd( $data['copoun_amount']);
            }else{
                $data['result1']='Your coupon code limit exceed.';
            }
            //($data['result1']);
        }
        else{
            $data['result1']='';
        }

        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type','attribute_id')->get();
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type','attribute_id')->get();

        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            // $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
           $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }

        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;

        $count = DB::table('temp_carts')->where('session_id',$session)->count();
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
            //     $data1[]=DB::table('products')
            //     ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
            //     ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')
            // //    old  price by product table
            //     // ->where('products.products_id',$r1->product_id)
            //     ->first();

            $data1[]=DB::table('products')
            ->join('carts', 'products.products_id', '=', 'carts.product_id')
            ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
            ->select('products.products_id','products.product_name','products.prescription','product_attributes.price','product_attributes.extra_discount' , 'product_attributes.special_price','product_attributes.id','carts.quantity','carts.id','carts.attribute_id', 'carts.type')
            ->where('product_attributes.id',$r1->attribute_id)
            ->first();

            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.special_price','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                // $data1[]=DB::table('products')
                // ->join('carts', 'products.products_id', '=', 'carts.product_id')
                // ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')
                //  ->where('products.products_id',$r2->product_id)
               // ->first();
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                ->select('products.products_id','products.product_name','products.prescription','product_attributes.price','product_attributes.extra_discount' , 'product_attributes.special_price','product_attributes.id','carts.quantity','carts.id','carts.attribute_id', 'carts.type')
                ->where('product_attributes.id',$r2->attribute_id)
                ->first();
                
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.special_price','packages.package_name','packages.package','packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }

        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }

        return view('UI/webviews/user.manage_user',$data);
    }

    public function userAddressSubmit(Request $req){
        if($req->id){
            $data = Auth::id();
            UserAddress::where('id',$req->id)->update([
                'user_id' => Auth::id(),
                'name' => $req->name,
                'phone' => $req->phone,
            	'email' => $req->email,
                'address' => $req->address,
                'apartment' => $req->apartment,
                'city' => $req->city,
                'state' => $req->state,
                'pin_code' => $req->pin_code,
                'country' => $req->country,
                'locality' => $req->locality,
                'landmark' => $req->landmark,
                'phone_alt' => $req->phone_alt
            ]);

            if($req->url == 'https://drhelpdesk.in/user-address'){
                toastr()->success('Your Address Edit Successfull');
                return back();
            }else{
                toastr()->success('Your Address Edit Successfull');
                return redirect('checkout/');
            }

        }else{
            $existing_addr = UserAddress::where('user_id',Auth::id())->count();
            $data= new UserAddress;
            $data->user_id = Auth::id();
            $data->name = $req->name;
            $data->phone  = $req->phone;
        	$data->email  = $req->email;
            $data->selected = empty($existing_addr)?"1":"0";
            $data->address = $req->address;
            $data->apartment = $req->apartment;
            $data->city = $req->city;
            $data->state  = $req->state;
            $data->pin_code  = $req->pin_code;
            $data->country  = $req->country;
            $data->locality  = $req->locality;
            $data->landmark  = $req->landmark;
            $data->phone_alt  = $req->phone_alt;
            $data->save();
            //dd($req->url);
            if($req->url == 'https://drhelpdesk.in/user-address'){
                toastr()->success('Your Address Add Successfull');
               return back();
            }else{
                toastr()->success('Your Address Add Successfull');
                if($req->prescription){
                    return back();
                }else{
                return redirect('checkout/');
                }
            }
        }

    }

    public function userAddressDelete($id){
        UserAddress::where('id',$id)->delete();
        toastr()->error('Your Address Delete Successfully');
        return back();
    }

    public function checkoutSubmit(Request $req)
    {
        // dd($req);
    	$vendor = [];
        $name =  Auth::user()->name;
        $email =  Auth::user()->email;
        if(!$req->address_id){
            toastr()->error('Please Fill A Address');
            return back();
        }
        $session = Session::getId();
        $cart = DB::table('carts')->where('user_id',Auth::id())->count();
        $tempcart = DB::table('temp_carts')->where('session_id',$session)->count();

        if($cart==0 && $tempcart==0){
            return redirect('/');
        }

        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;

        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;

        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }

        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(a.special_price is not null, a.special_price, a.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id inner join product_attributes as a on p.products_id = a.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);

        if ($req->address_id) {


                $total_amount1=0;
                $total_amount=0;
                $tamount = 0;
                $extra_discount = 0;
                $balance=0;
                $total_amount_with_shipping = 0;


                $data=Cart::where('user_id',Auth::user()->id)->get();
                $address = DB::table('user_addresses')->where('id',$req->address_id)->first();
                $location_name = DB::table('locations')->where('location_name',$address->city)->first();
                $user_test=User::where('id',Auth::user()->id)->value('is_testing');
                // dd($user_test);
                $order_id = "DHD".Auth::user()->id.time();

                $reg = new Order;
                $reg->user_id = Auth::user()->id;
                $reg->order_id = $order_id;
                $reg->address_id = $req->address_id;
                $reg->order_status = 1;
                $reg->prescription_id = $req->prescription_id;
                if ($location_name) {
                    $reg->quick_delivery = 1;
                } elseif ($location_name == null) {
                    $reg->quick_delivery = 2;
                }
                $reg->payment_mode = $req->payment_mode;
                $reg->user_name = $address->name;
        		$reg->user_email = $email;
                $reg->user_phone  = $address->phone;
                $reg->user_address = $address->address;
                $reg->user_apartment = $address->apartment;
                $reg->user_city = $address->city;
                $reg->user_state  = $address->state;
                $reg->pin_code  = $address->pin_code;
                $reg->user_country  = $address->country;
                $reg->is_testing = $user_test;
                $reg->save();

                $count=0;
                $prod_name = [];
                $sub = [];
                $extra_discount_1 = 0;
                $totaltype1Amount = 0;
                $totaltype1Amt = 0;
                $total_discount = 0;
                // dd($data);
                foreach ($data as $r) {
                    $sub_order_id = "DHD".Auth::user()->id.$count.time();
                    $reg1 = new OrderItem;
                    $reg1->order_id = $reg->order_id;
                    $reg1->sub_order_id = $sub_order_id;

                    if(!empty($r->type) && ($r->type == 1 || $r->type == 2)){
                        // $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
                        // $match = Vendor::where('main_category', $categories)->where('city', $address->city)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                        // $brand = Product::where('products_id', $r->product_id)->pluck('brand')->first();
                        // $match = Vendor::where('main_category', $brand)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                        $brand = Product::where('products_id', $r->product_id)->pluck('brand')->first();
                    	//dd($brand); die;
                        $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->limit(1)->pluck('vendors.user_id')->first();
                        //dd($match); die;
                    	if($location_name){
                            $reg1->assign_vendor_id = $match;
                            $reg1->quick_delivery = 1;
                        }elseif($location_name == null){
                            $reg1->assign_vendor_id = $match;
                            $reg1->quick_delivery = 2;
                        }
                    	//$prodName = Product::where('products_id',$r->product_id)->pluck('product_name')->first();
                       // dd($prodName);
                        $reg1->prod_name = Product::where('products_id',$r->product_id)->pluck('product_name')->first();
                        $reg1->prod_id = $r->product_id;
                        $reg1->attribute_id = $r->attribute_id;
                        $reg1->quantity =$r->quantity;
                        $reg1->type =$r->type;
                        $special_price=Product::where('product_attributes.id',$r->attribute_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->pluck('special_price')->first();
                        $price=Product::where('product_attributes.id',$r->attribute_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->pluck('price')->first();
                        echo $r->quantity;
                        if($special_price != null){
                            $reg1->sub_total=$special_price;
                            $total_amount+= $special_price*$r->quantity;
                        }else{
                            $reg1->sub_total=$price;
                            $total_amount+=$price*$r->quantity;
                        }

                        $ext_amount = Product::where('product_attributes.id',$r->attribute_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->pluck('extra_discount')->first();
                        $reg1->extra_discount=$ext_amount;

                        if($special_price != null && $ext_amount != null)
                        {
                            $extra_discount+= ($special_price * $r->quantity *  $ext_amount)/100;
                            $extra_discount_1 = ($special_price * $r->quantity *  $ext_amount)/100;
                            $total_discount+=($special_price * $r->quantity *  $ext_amount)/100;
                        }
                        elseif($price != null && $ext_amount != null)
                        {
                            $extra_discount+= ($price * $r->quantity *  $ext_amount)/100;
                            $extra_discount_1 = ($price * $r->quantity *  $ext_amount)/100;
                            $total_discount+=($price * $r->quantity *  $ext_amount)/100;
                        }

                        if(!empty($r->type) && $r->type == 1)
                        {
                            if($special_price != null) {
                                $totaltype1Amount+=$special_price  * $r->quantity;
                            } else {
                                $totaltype1Amount+=$price  * $r->quantity;
                            }
                            $totaltype1Amount = $totaltype1Amount - $extra_discount_1;
                        }

                        $reg1->order_status = 1;
                        $prod_name[] = $reg1->prod_name;
                        $sub[] = $reg1->sub_total;
                    }elseif(!empty($r->type) && $r->type == 3){

                    		// $categories = 15;
                    		// $match = Vendor::where('main_category', $categories)->where('city', $address->city)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                        // $brand = Brand::where('parent_id', $categories)->pluck('id')->first();
                        // $match = Vendor::where('main_category', $brand)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                        // $categories = 15;
                        // $brand = Brand::where('parent_id', $categories)->pluck('id')->first();
                        // $match = Vendor::where('main_category', $brand)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                        $categories = 15;
                        $brand = Brand::where('parent_id', $categories)->pluck('id')->first();
                        $match = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('vendor_brands.brand', $brand)->orderBy('vendor_brands.assign_priority','asc')->limit(1)->pluck('vendors.user_id')->first();
                    	if($location_name){
                            $reg1->assign_vendor_id = $match;
                            $reg1->quick_delivery = 1;
                        }elseif($location_name == null){
                        	$reg1->assign_vendor_id = $match;
                            $reg1->quick_delivery = 2;
                        }
                        $reg1->prod_name=Package::where('id',$r->product_id)->pluck('package_name')->first();
                        $my_special_price=Package::where('id',$r->product_id)->pluck('special_price')->first();
                        $reg1->prod_id = $r->product_id;
                        $reg1->quantity =$r->quantity;
                        $reg1->type =$r->type;
                        $price=Package::where('id',$r->product_id)->pluck('package_cost')->first();
                        $offer_discount=Package::where('id',$r->product_id)->pluck('offer_discount')->first();

                        // if($r->offer_discount != null){
                        $discount = ($offer_discount * $price) / 100;
                        $discount1 =  $price - $discount;
                        // }
                        $special_price = $discount1;
                        if($special_price != null){
                            $reg1->sub_total=$special_price;
                        }else{
                            $reg1->sub_total=$price;
                        }

                        if($offer_discount == null){
					        $total_amount+=$price* $r->quantity;
					    }else {
					       $total_amount+=$discount1* $r->quantity;
					       $total_discount+=$discount;
					    }
                    	if($my_special_price > 0){
                            $reg1->sub_total = $my_special_price;
                         }

                        $reg1->extra_discount=$discount;
                        $reg1->order_status = 1;
                        $prod_name[] = $reg1->prod_name;
                        $sub[] = $reg1->sub_total;
                    }
                	 $vendor[] = $reg1->assign_vendor_id;
                    $reg1->save();
                     $count++;
                }



                    $coupon = Session::get('couponData')?Session::get('couponData')['amount']:0;
                    
                    $null_session= Session::get('couponData');
                    if($null_session != null){
                        $code_coupon = Session::get('couponData')['copoun_code']; 
                    }else{
                        $code_coupon = 0;
                    }
                    // $code_coupon = Session::get('couponData')['copoun_code']?:0;
                    // dd($code_coupon);
                    $type1 = Session::get('couponData')?Session::get('couponData')['type1']:0;
                    // $coupon =null;
                    if($coupon != null){
                        if($type1 =='fixed'){
                            $tamount+= $total_amount - $extra_discount - $coupon;

                        }elseif($type1 =='percentage'){
                            $disamt = $total_amount - $extra_discount;
                        	$tamount+= $disamt - ($disamt * $coupon / 100);
                        	$totaltype1Amount = $totaltype1Amount - ($totaltype1Amount * $coupon/ 100);
                           
                        }
                    }else{
                        $tamount+= $total_amount - $extra_discount;
                    }

                    $totaltype1Amount = $totaltype1Amount > 0 ? $totaltype1Amount : 1;

	                $shipping = DB::table('shipping_charges')->where('min','<=',  $totaltype1Amount)->where('max','>=',$totaltype1Amount)->first();

	                // if($totaltype1Amount <= 1000 ){
	                // if($location_name){

	                //         $shipping_percent = ($totaltype1Amount * $shipping->percent)/100;
	                // }else{
                    //           $shipping_percent = 99;
	                //      }
	                // }else{
	                //     $shipping_percent = 0;
	                // }

                    // Shipping charge calculation
                    $selected_address = DB::table('user_addresses')->where('user_id',Auth::id())->where('selected',"1")->first();
                    $selected_city = $selected_address?strtolower($selected_address->city):"";
                    $locations = DB::table("locations")->where("status","0")->get();
                    $product_locations = [];
                    foreach ($locations as $key => $value) {
                        $product_locations[] = strtolower($value->location_name);
                    }

                    $selected_city = strtolower($selected_city);
                    $shipping_data = ShippingSetting::where('id',1)->first();
                    if($tamount >= $shipping_data->min_order_price){
                      // if user purchased greater than max order , no shipping charge
                      $shipping_percent = 0;
                    }elseif(!in_array($selected_city, $product_locations)){
                      // if user purchased min order , outside location
                      $shipping_percent = $shipping_data->charge_outside_location;
                    }elseif(in_array($selected_city, $product_locations) && $tamount <= $shipping_data->min_order_price){
                      // if user purchased min order , inside location
                      $shipping_percent = $shipping_data->charge_inside_location;
                    }else{
                      // if user purchased greater than max order , no shipping charge
                      $shipping_percent = 0;
                    }

	                $wallet = DB::table('de_wallets')->where('user_id',Auth::user()->id)->pluck('coin')->first();
                    $coin = $wallet * 0.25;

                    if($req->coin == 'on'){
                        if($tamount > $coin){
                            $t_amount_with_shipping = $tamount + $shipping_percent - $coin;
                            DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                                'coin' => $wallet - $coin / 0.25
                            ]);
                        }elseif($tamount < $coin){
                            $left_coin = $coin - $tamount;
                            $t_amount_with_shipping =  $coin - $tamount + $shipping_percent;
                            DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                                'coin' =>  $left_coin / 0.25
                            ]);
                        }
                    }else{

                        $t_amount_with_shipping = $tamount + $shipping_percent ;

                    }
                    $total_amount_with_shipping = round($t_amount_with_shipping, 2);
                    //dd('sub_total='.$total_amount, 'extra_discount='.$extra_discount, 'tamount='.$tamount, '$totaltype1Amount='.$totaltype1Amount, '$shipping_percent='.$shipping_percent, '$coin'.$coin, '$total_amount_with_shipping'.$total_amount_with_shipping);
                    $p = implode("", $prod_name);
                    $s  = implode("", $sub);
                    if(! $location_name){
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
                          CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$name\",\n  \"billing_last_name\": \"$name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"$address->name\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"$address->apartment\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"$address->city\",\n  \"shipping_pincode\": \"$address->pin_code\",\n  \"shipping_country\": \"$address->country\",\n  \"shipping_state\": \" $address->state\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \" $address->phone\",\n  \"order_items\": [\n    {\n      \"name\": \" $p\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $s\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $shipping_percent,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $total_amount_with_shipping,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                          CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "Authorization: Bearer $token"
                          ),
                        ));
                        $response = curl_exec($curl);
                        //echo "<pre>"; print($address->name);
                        curl_close($curl);
                        $data = json_decode($response, true);

                        //dd($data);

                        // $Shiprocket_Order_Id     =  $data['order_id'];
                        // $Shiprocket_Shipment_Id      =   $data['shipment_id'];
                        DB::table('order_items')->where('order_id',$reg->order_id)->update(['Shiprocket_Order_Id'=>null ,'awb_number'=>null]);
                        DB::table('orders')->where('order_id', $reg->order_id)->update(['Shiprocket_Order_Id' => null, 'awb_number' => null]);

                    }

                    $order_assign = new OrderAssignHistory;
                    $order_assign->order_id = $reg->order_id;
                    $order_assign->sub_order_id = $reg1->sub_order_id;
                    $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
        			$order_assign->user_type = 4;

                    if(!$location_name){
                        $order_assign->Shiprocket_Order_Id = null;
                        $order_assign->Shiprocket_Shipment_Id    = null;
                    }
                    $order_assign->save();

                    $order_status = new OrderStatusHistory;
                    $order_status->order_id = $reg->order_id;
                    $order_status->sub_order_id = $reg1->sub_order_id;
                    $order_status->order_status = 1;
                    $order_status->save();
                    $count++;

                    // coupon code hide code

                    // dd($shipping_percent , $total_amount_with_shipping ,$balance , $extra_discount);
                    $coupon_history = new OrderCouponHistory;
                    $coupon_history->user_id = Auth::user()->id;
                    $coupon_history->order_id = $reg->order_id;
                    $coupon_history->coupon_price = $coupon;
                    $coupon_history->coupon_code = $code_coupon;
                    $coupon_history->coupon_type = $type1;
                    $coupon_history->save();

                    if($req->coin == 'on'){
                        if($tamount > $coin){
                            DB::table('orders')->where('order_id', $order_id)->update([
                            'shipping_charge' => round($shipping_percent, 2),
                            'amount' =>  round($total_amount_with_shipping,2),
                            'de_wallet_coin' =>  $wallet
                        ]);
                        }elseif($tamount < $coin){
                            DB::table('orders')->where('order_id', $order_id)->update([
                            'shipping_charge' => round($shipping_percent, 2),
                            'amount' =>  round($total_amount_with_shipping,2),
                            'de_wallet_coin' =>  $wallet - $left_coin / 0.25
                        ]);
                        }
                    }else{
                            DB::table('orders')->where('order_id', $order_id)->update([
                            'shipping_charge' => round($shipping_percent, 2),
                            'amount' =>  round($total_amount_with_shipping,2),
                            'de_wallet_coin' => 0
                        ]);
                    }


                    Cart::where('user_id',Auth::user()->id)->delete();
                    Session::forget('couponData');
                    Session::forget('location_name');
                    Session::forget('set_location_name');
                if($req->payment_mode=='COD') {
                	$order_detail = Order::where('order_id',$order_id)->first();
                	 if($req->payment_mode == 'COD'){
                        $payment_mode = "COD";
                    } if($req->payment_mode == 'CLD'){
                        $payment_mode = "CLD";
                    } if($req->payment_mode == 'ON'){
                        $payment_mode = "Online Payment";
                    }
                	if ($address->phone!=null) {
                        $msg=urlencode("Thank you for shopping with DrHelpDesk.
								Order ID - ".$order_id.",
								Total Amount - Rs ".$order_detail->amount.",
								Payment Mode - ".$payment_mode.".
								Enjoy Shopping on Drhelpdesk.
								Stay Home !!! Stay Safe !!!");
                        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900675706426&sendto=".$address->phone."&message=".$msg);
                        // dd($curl);
                        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                        $response=curl_exec($curl);
                        curl_close($curl);
                    }

                    $to_name = $name;
                    $to_email = $email;
                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Order Placed');
                        $message->from('dhdteam@drhelpdesk.in','Drhelpdesk');
                    });

               		/*$admin = User::where('user_type',1)->first();
                    $to_name1 = $admin->name;
                    $to_email1 = $admin->email;

                    Mail::send('emails.user-order', ['order_detail' =>$order_detail], function($message) use ($to_name1, $to_email1){
                        $message->to($to_name1, $to_email1)
                        ->subject('Order Placed');
                        $message->from('dhdteam@drhelpdesk.in','Drhelpdesk');
                    });*/
                	// $vendor_match1 = implode("", $vendor);
                	//  //dd($vendor_match1);
                	// if($vendor_match1  != null){
                	// $image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
                	// $title = "New Order";
                	// $message = 'New Order of this '.$order_id.' is assign to you';
                	// $user = User::where('id',$vendor_match1)->first();
                	// //dd($user);
                	// if($user->device_token != null){
                	// $notObj = new Notification();
                	// $regId = $user->device_token;
                	// $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                	// }
                	// }
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
                    return redirect('order-suceess/'.$reg->order_id);

                	exit;
                } else {
                    //TODO :: create order
                    /**
                     * $order  = $client->order->create([
                     *   'receipt'         => $reg->order_id,
                     *   'amount'          => $reg->amount, // amount in the smallest currency unit
                     *   'currency'        => 'INR',// <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies" target="_blank">See the list of supported currencies</a>.)
                     *   ]);
                     *  return redirect('');
                     */
                    return redirect('confirm-order/'.$reg->order_id);
                    //return redirect('get-payment/'.$reg->order_id); exit;
                }
        }

    }

    // public function checkoutSubmit1(Request $req){
    //     if ($req->address_id) {
    //         // Order table
    //         if ($req->payment_mode=='COD') {
    //             $data=Cart::where('user_id',Auth::user()->id)->get();
    //             $shipping = DB::table('shipping_charges')->where('min','<=', $req->amount)->where('max','>=',$req->amount)->first();
    //             if($req->amount <= 800 ){
    //                 $shipping_percent = ($req->amount * $shipping->percent)/100;
    //             }else{
    //                 $shipping_percent = 0;
    //             }
    //             $total_amount_with_shipping = $shipping_percent + $req->amount;
    //             $address = DB::table('user_addresses')->where('id',$req->address_id)->first();
    //             $order_id = "DHD".$req->user_id.time();
    //             $reg = new Order;
    //             $reg->user_id = Auth::user()->id;
    //             $reg->order_id = $order_id;
    //             $reg->address_id = $req->address_id;
    //             $reg->amount = $total_amount_with_shipping;
    //             $reg->de_wallet_coin = $req->de_wallet_coin;
    //             $reg->prescription_id = $req->prescription_id;
    //             $reg->payment_mode = $req->payment_mode;
    //             $reg->shipping_charge = $shipping_percent;
    //             $reg->user_name = $address->name;
    //             $reg->user_phone  = $address->phone;
    //             $reg->user_address = $address->address;
    //             $reg->user_apartment = $address->apartment;
    //             $reg->user_city = $address->city;
    //             $reg->user_state  = $address->state;
    //             $reg->pin_code  = $address->pin_code;
    //             $reg->user_country  = $address->country;
    //             $reg->save();
    //         //order item table
    //             $count=0;
    //             foreach ($data as $r) {
    //                 $sub_order_id = "DHD".$req->user_id.$count.time();
    //                 $reg1 = new OrderItem;
    //                 $reg1->order_id = $reg->order_id;
    //                 $reg1->sub_order_id = $sub_order_id;
    //                 $reg1->order_status = 1;
    //                 $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
    //                 $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
    //                 if($special_price != null){
    //                     $reg1->sub_total=$special_price;
    //                 }else{
    //                     $reg1->sub_total=$price;
    //                 }
    //                 $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();
    //                 $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();
    //                 $reg1->prod_id = $r->product_id;
    //                 $reg1->quantity =$r->quantity;
    //                 $count++;
    //                 $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
    //                 $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('assign_priority')->first();
    //                 //dd($match);
    //                 $reg1->assign_vendor_id = $match;
    //                 $reg1->save();
    //             // order assign history
    //                 $order_assign = new OrderAssignHistory;
    //                 $order_assign->order_id = $reg->order_id;
    //                 $order_assign->sub_order_id = $reg1->sub_order_id;
    //                 $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
    //                 $order_assign->save();
    //             // order status history
    //                 $order_status = new OrderStatusHistory;
    //                 $order_status->order_id = $reg->order_id;
    //                 $order_status->sub_order_id = $reg1->sub_order_id;
    //                 $order_status->order_status = 1;
    //                 $order_status->save();
    //             }
    //             // User Mail
    //                 // $user = User::where('id',Auth::user()->id)->first();
    //                 // $to = $user['email'];
    //                 // $subject = 'Order Details';
    //                 // $message = "Dear ".$user->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //                 // $user1 = User::where('user_type',1)->first();
    //                 // $to = $user1['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user1->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //                 // $user2 = User::where('id',$match)->first();
    //                 // $to = $user2['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user2->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //             // Cart Empty
    //             Cart::where('user_id',Auth::user()->id)->delete();

    //             // DE-wallet Table data update
    //             if ($req->de_wallet_coin != null) {
    //                 DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
    //                     'coin' => 0
    //                 ]);
    //             }

    //             return redirect('order-suceess/'.$reg->order_id);
    //         }
    //     }else{
    //         $data= new UserAddress;
    //         $data->user_id = Auth::id();
    //         $data->name = $req->name;
    //         $data->phone  = $req->phone;
    //         $data->address = $req->address;
    //         $data->apartment = $req->apartment;
    //         $data->city = $req->city;
    //         $data->state  = $req->state;
    //         $data->pin_code  = $req->pin_code;
    //         $data->country  = $req->country;
    //         $data->save();
    //         if ($req->payment_mode=='COD') {
    //             $data1=Cart::where('user_id',Auth::user()->id)->get();
    //             $order_id = "DHD".$req->user_id.time();
    //             $shipping = DB::table('shipping_charges')->where('min','<=', $req->amount)->where('max','>=',$req->amount)->first();
    //             if($req->amount <= 800 ){
    //                 $shipping_percent = ($req->amount * $shipping->percent)/100;
    //             }else{
    //                 $shipping_percent = 0;
    //             }
    //             $total_amount_with_shipping = $shipping_percent + $req->amount;
    //             //dd($shipping_percent);
    //             $reg = new Order;
    //             $reg->user_id = Auth::user()->id;
    //             $reg->order_id = $order_id;
    //             $reg->prescription_id = $req->prescription_id;
    //             $reg->address_id = $data->id;
    //             $reg->shipping_charge = $shipping_percent;
    //             $reg->amount = $total_amount_with_shipping;
    //             $reg->de_wallet_coin = $req->de_wallet_coin;
    //             $reg->payment_mode = $req->payment_mode;
    //             $reg->user_name = $req->name;
    //             $reg->user_phone  = $req->phone;
    //             $reg->user_address = $req->address;
    //             $reg->user_apartment = $req->apartment;
    //             $reg->user_city = $req->city;
    //             $reg->user_state  = $req->state;
    //             $reg->pin_code  = $req->pin_code;
    //             $reg->user_country  = $req->country;
    //             //dd($req);
    //             $reg->save();
    //             $count=0;
    //             foreach ($data1 as $r) {
    //                 $sub_order_id = "DHD".$req->user_id.$count.time();
    //                 $reg1 = new OrderItem;
    //                 $reg1->order_id = $reg->order_id;
    //                 $reg1->sub_order_id = $sub_order_id;
    //                 $reg1->order_status = 1;
    //                 $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
    //                 $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
    //                 if($special_price != null){
    //                     $reg1->sub_total=$special_price;
    //                 }else{
    //                     $reg1->sub_total=$price;
    //                 }
    //                 $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();
    //                 $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();
    //                 $reg1->prod_id = $r->product_id;
    //                 $reg1->quantity =$r->quantity;
    //                 $count++;
    //                 $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
    //                 $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('assign_priority')->first();
    //                 //dd($match);

    //                 $reg1->assign_vendor_id = $match;
    //                 $reg1->save();

    //                 $order_assign = new OrderAssignHistory;
    //                 $order_assign->order_id = $reg->order_id;
    //                 $order_assign->sub_order_id = $reg1->sub_order_id;
    //                 $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
    //                 $order_assign->save();

    //                 $order_status = new OrderStatusHistory;
    //                 $order_status->order_id = $reg->order_id;
    //                 $order_status->sub_order_id = $reg1->sub_order_id;
    //                 $order_status->order_status = 1;
    //                 $order_status->save();
    //             }
    //              // User Mail
    //                 // $user = User::where('id',Auth::user()->id)->first();
    //                 // $to = $user['email'];
    //                 // $subject = 'Order Details';
    //                 // $message = "Dear ".$user->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //                 // $user1 = User::where('user_type',1)->first();
    //                 // $to = $user1['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user1->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //                 // $user2 = User::where('id',$match)->first();
    //                 // $to = $user2['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user2->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // }
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }

    //             Cart::where('user_id',Auth::user()->id)->delete();
    //             if ($req->de_wallet_coin != null) {
    //                 DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
    //                     'coin' => 0
    //                 ]);
    //             }
    //             return redirect('order-suceess/'.$reg->order_id);
    //         }
    //     }
    // }

    public function orderSuccessPage($order_id){
        $data['flag']=4;
        $data['booking'] = Order::where('order_id',$order_id)->first();
    	//if($order_id == 'DHD2271600863432'){
    		$user = User::where('id', $data['booking']->user_id)->first();

            // $shippingAddress=array(
            // 	'name' => $data['booking']->user_name,
            // 	'email' => $data['booking']->user_email,
            // 	'phone' => $data['booking']->user_phone,
            // 	'user_address' => $data['booking']->user_address,
            // 	'user_country' => $data['booking']->user_country,
            // 	'user_state' => $data['booking']->user_state,
            // 	'user_city' => $data['booking']->user_city,
            // 	'pin_code' => $data['booking']->pin_code
            // );
        	$lmsData = array(
            	'company' => 'aensahealthsolution',
           		'lead_source' => 10,
                'division' => 1,
            	'name' => $user->name,
            	'email' => $user->email,
            	'phone' => $user->phone,
            	'order_id' => $order_id,
            	'amount' => $data['booking']->amount,
            	'total_discount' => $data['booking']->total_discount,
            	'order_status' => $data['booking']->order_status,
            	'copoun_code' => 0,
            	'payment_mode' => $data['booking']->payment_mode,
            	'shipping_charge' => $data['booking']->shipping_charge,
            	'payment_status' => $data['booking']->payment_status,
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
       // }

       $name =$user->name;
       $email = $user->email;
       $phone = $user->phone;
       $order_id = $order_id;
       $amount = $data['booking']->amount;

               $to = 'anujrathoure9889@yahoo.com';
                $subject = 'New Order Information  DHD';
                $message = "New order information \n name : ".$name." and \nmail : ".$email." \nmobile no : ".$phone." and \n Order Id is : ".$order_id." and \n Order Amount  is : ".$amount;
           Mail::send('emails.approve', ['msg' => $message], function($message) use ($to) {
               $message->to($to)
               ->subject('Registration In DHD');
               $message->from('support@drhelpdesk.in','Drhelpdesk');
           });

        return view('UI/webviews/user.manage_user',$data);
    }

    public function userDashboard(){
        $data['flag'] = 6;
    	$data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->where('order_status', '!=', 0)->orderBy('created_at','desc')->take(5)->get();
        // $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->orderBy('created_at','desc')->take(5)->get();
        //$data['order'] = DB::table('orders')->Join('order_items','orders.order_id','order_items.order_id')->where('user_id' , Auth::user()->id)->where('order_items.type', 1)->select('orders.*')->orderBy('orders.created_at','desc')->take(5)->get();
    	return view('UI/webviews/user.manage_user_dashboard',$data);
    }
    public function userProfile(){
        $data['flag'] = 1;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userOrderHistory(Request $req){
        if(Auth::user()){
        	$data['page'] = $req->all();
            $data['flag'] = 2;
            #$data['order'] = DB::table('orders')->where('user_id' , Auth::user#()->id)->orderBy('created_at','desc')->get();

            // $order = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type =1 group by order_id) and user_id='".Auth::id()."' ORDER BY id DESC LIMIT 5"));

            // $data['order'] = collect($order);
            // $data['order'] = DB::table('orders')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
             $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->where('order_status', '!=', 0)->orderBy('created_at','desc')->paginate(8)->onEachSide(1);
        	return view('UI/webviews/user.manage_user_dashboard',$data);
        }else{
           return redirect('/');
        }
    }

    public function userMyBooking(Request $req){
        $data['page'] = $req->all();
    	$data['flag'] = 3;

        $order = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type IN(2,3) group by order_id) and user_id='".Auth::id()."'"));
        $data['order'] = collect($order)->where('order_status', '!=', 0);
        //$data['order'] = DB::table('orders')->Join('order_items','orders.order_id','order_items.order_id')->where('user_id' , Auth::user()->id)->where('order_items.type' ,'!=' ,1)->where('orders.order_status', '!=', 0)->orderBy('orders.created_at','desc')->paginate(8);
    	return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userAddress(){
        $data['flag'] = 4;
        $data['is_checkout'] = 0;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userCheckoutAddress($is_checkout){
        $data['flag'] = 4;
        $data['is_checkout'] = $is_checkout;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userAddressEdit(Request $req){
        $data['flag'] = 7;
        $data['address'] = UserAddress::where('id' ,$req->id)->first();
        // dd($data);
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userPassword(){
        $data['flag'] = 5;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userOrderDetail($order_id){
        $data['flag'] = 8;

        $data['order'] = OrderItem::where('order_id',$order_id)->where('type',1)->orderBy('id','desc')->get();
        $data['order_status'] = DB::table('order_status')->get();
        // $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    //repeat Order functionality
    public function repeatOrder($order_id){

        $products = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get();
        $productCount = $products->count();
        // dd($products);
        // dd($productCount);
        if($productCount > 0){

        foreach($products as $product){
            $products_id =  $product->prod_id;

            $quantity =  $product->quantity;

            $type = $product->type;

                DB::table('carts')->insert([
                    'product_id'=>$products_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>$quantity
                ]);
            }
        }
        return redirect('checkout');
    }

    public function userProfileSubmit(Request $req){
        if($req->user_id) {
            if($req->hasFile('image')) {
                $file = $req->file('image');
                $filename = 'userdetails'.time().'.'.$req->image->extension();
                $destinationPath = storage_path('../public/upload/userdetails');
                $file->move($destinationPath, $filename);
                $userdetails = 'upload/userdetails/'.$filename;
            }
            else{
                $userdetails=$req->image;
            }
            UserDetail::where('user_id',$req->user_id)->update([
                'user_name' => $req->user_name,
                'image' => $userdetails,
                'dob' => $req->dob,
                'gender' => $req->gender,
                'address' => $req->address,
                'address2' => $req->address2,
                'city' => $req->city,
                'pin_code' => $req->pin_code,
                'state' => $req->state,
                'country' => $req->country
            ]);

            User::where('id',$req->user_id)->update([
                'name' => $req->user_name
            ]);
            toastr()->success('Profile Edit  Successfully');
            return back();
        }
    }


//     public function trackorder(Request $req){
//         $order_id   =  $req->order_id;
//         $order_data =  DB::table('order_items')->where('order_id',$req->order_id)->first();
//         $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
//         $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;
//         $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjU3MjAwNSwiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTM1OTcxODksImV4cCI6MTU5NDQ2MTE4OSwibmJmIjoxNTkzNTk3MTg5LCJqdGkiOiJwRVpPS256dGN1WnR1TmtaIn0.yDLq4NuwfPCPUY3sLYbGeUIJquTsU7t70Od22mio-k4";
//         $curl = curl_init();

//         curl_setopt_array($curl, array(
//         CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$Shiprocket_Shipment_Id",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "GET",
//         CURLOPT_HTTPHEADER => array(
//         "Content-Type: application/json",
//         "Authorization: Bearer $token"
//         ),
//         ));

//         $response = curl_exec($curl);

//         curl_close($curl);
//         echo $response; die;
//     }
	    public function trackorder(Request $req){
       	$order_id   =  $req->order_id;
        $order_data =  DB::table('orders')->where('order_id',$req->order_id)->first();
        $awb_number  =  $order_data->awb_number;

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
            CURLOPT_POSTFIELDS => "{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response1 = curl_exec($curl1);

        curl_close($curl1);
        $data = json_decode($response1);
        //  print_r( $data) ; die;

        $curl = curl_init();
        $token =   $data->token;
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/awb/$awb_number",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
            ),
        ));
       	$response = curl_exec($curl);
        curl_close($curl);
        $data2 = json_decode($response, true);
        $tracking_data    =  $data2['tracking_data'];
        $pickup_date = "";
        $current_status = "";
        if(!empty($tracking_data['shipment_track']) && count($tracking_data['shipment_track']) > 0) {
             $shipment_track = $tracking_data['shipment_track'];
             $data1['pickup_date'] = $shipment_track[0]['pickup_date'];
        	 $data1['current_status'] = $shipment_track[0]['current_status'];
        }
        if(!empty($tracking_data['shipment_track_activities']) && count($tracking_data['shipment_track_activities']) > 0) {
             $data1['shipment_track_activities'] = $tracking_data['shipment_track_activities'];
        }
        return view('UI/components/user.track_status',$data1);
    }

    public function orderCancelOrder(Request $req){
        //dd($order_data);
        DB::table('order_items')->where('order_id',$req->order_id)->update([
            'order_status'=> $req->status
        ]);
        return back()->with('msg','This ' .  $req->order_id  . ' Order Cancelled Successfully');
    }

    // public function shippingorderCancelOrder(Request $req){
    //     $order_data =  DB::table('order_items')->where('order_id',$req->order_id)->first();
    //     $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
    //     $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;
    //     $curl = curl_init();
    //     $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjU3MjAwNSwiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTM1OTcxODksImV4cCI6MTU5NDQ2MTE4OSwibmJmIjoxNTkzNTk3MTg5LCJqdGkiOiJwRVpPS256dGN1WnR1TmtaIn0.yDLq4NuwfPCPUY3sLYbGeUIJquTsU7t70Od22mio-k4";
    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS =>"{\n  \"ids\": [$Shiprocket_Order_Id]\n}",
    //     CURLOPT_HTTPHEADER => array(
    //             "Content-Type: application/json",
    //             "Authorization: Bearer $token"
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    //     //dd($order_data);
    //     DB::table('order_items')->where('order_id',$req->order_id)->update([
    //         'order_status'=> $req->status
    //     ]);
    //     return back()->with('msg','This ' .  $req->order_id  . ' Order Cancelled Successfully');
    // }
    public function shippingorderCancelOrder(Request $req){
        $order_data =  DB::table('orders')->where('order_id', $req->order_id)->first();
        //dd($order_data);
        // if ($order_data->quick_delivery == 1) {
         	DB::table('orders')->where('order_id', $req->order_id)->update([
                'order_status' => 3
            ]);
            DB::table('order_items')->where('order_id', $req->order_id)->update([
                'order_status' => 6
            ]);

            DB::table('order_status_histories')->where('order_id', $req->order_id)->update([
                'order_status' => 6
            ]);
//         } elseif ($order_data->quick_delivery == 2) {
//             $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
//             $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;

//             $curl1 = curl_init();

//             curl_setopt_array($curl1, array(
//                 CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => "",
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
//                 CURLOPT_POSTFIELDS => "{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
//                 CURLOPT_HTTPHEADER => array(
//                     "Content-Type: application/json"
//                 ),
//             ));

//             $response1 = curl_exec($curl1);

//             curl_close($curl1);
//             $data = json_decode($response1);
//             //  print_r( $data) ; die;

//             $curl = curl_init();
//             $token =   $data->token;
//             curl_setopt_array($curl, array(
//                 CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => "",
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
//                 CURLOPT_POSTFIELDS => "{\n  \"ids\": [$Shiprocket_Order_Id]\n}",
//                 CURLOPT_HTTPHEADER => array(
//                     "Content-Type: application/json",
//                     "Authorization: Bearer $token"
//                 ),
//             ));
//             $response = curl_exec($curl);
//             curl_close($curl);
//             echo $response;
//             //dd($order_data);
//             DB::table('order_items')->where('order_id', $req->order_id)->update([
//                 'order_status' => 6
//             ]);
//             DB::table('orders')->where('order_id', $req->order_id)->update([
//                 'order_status' => 3
//             ]);
//             DB::table('order_status_histories')->where('order_id', $req->order_id)->update([
//                 'order_status' => 6
//             ]);
//         }

        return back()->with('msg','This ' .  $req->order_id  . ' Order Cancelled Successfully');
    }


    public function addReviewComment(Request $req){
        if (Review::where(['user_id'=>Auth::id(),'product_id'=>$req->product_id])->count()>2) {
            toastr()->success('You already give a rating or review');
            return back()->with('msg2', 'You already give a rating or review');
        }
        else{
            $reg = new Review;
            $reg->user_id = Auth::id();
            $reg->user_name = $req->user_name;
            $reg->product_id = $req->product_id;
            $reg->email = $req->email;
            $reg->comment = $req->comment;
            $reg->rating = $req->rating;
            $reg->type = $req->type;
            $reg->save();

            if($req->type == 1){
            	//dd($reg);
				$data = Product::where('products_id',$req->product_id)->first();
                $rev = DB::table('reviews')->where('product_id' , $req->product_id)->get();
                $revCount = $rev->count();
                if($revCount > 0){
                    $ee = 0;
                    foreach($rev as $re){
                        $ee = $ee+$re->rating;
                    }
                    $avg = round($ee/$revCount,2);

                    Product::where('products_id',$req->product_id)->update([
                        'rating' => $avg
                    ]);
                }
                // $data = Product::where('products_id',$req->product_id)->first();
                // $data1 = $data->rating;
                // Product::where('products_id',$req->product_id)->update([
                //     'rating'=>($req->rating + $data1)/2
                // ]);
            }elseif($req->type == 2){
                $data = Package::where('id',$req->product_id)->first();
                $data1 = $data->rating;
                Package::where('products_id',$req->product_id)->update([
                    'rating'=>($req->rating + $data1)/2
                ]);
            }
            toastr()->success('You give a rating or review successfully!');
            return back();
        }
    }

    public function prescription(Request $req){
        try {
            $file = $req->file('prescription_image');
            if($req->hasFile('prescription_image')) {
                $file = $req->file('prescription_image');
                $filename = 'prescription'.time().'.'.$req->prescription_image->extension();
                $destinationPath = storage_path('../public/upload/prescription');
                $file->move($destinationPath, $filename);
                $data= new Prescription;
                $data->user_id = Auth::id();
                $data->prescription_type = $req->prescription_type;
                $data->comment = $req->comment;
                $data->prescription_image = 'upload/prescription/'.$filename;
                $data->save();
                echo '1';
            } else{
                echo '2';

            }

            exit;
        } catch(Exception $e){
            echo '2';
            exit;
        }
        toastr()->success('Prescription Upload Successfully');
        return back();
        //return redirect('/checkout1/'.$data->user_id.'/'.$data->id);
    }
    public function forgetPasswordView()
    {
        return view('UI.webviews.forget_password_view_website');
    }
    public function forgotPasswordSubmit(Request $req){
        // dd($req->email);
        if(User::where('email', $req->email)->count() > 0) {
            //$token =
            $reg = new PasswordReset;
            $reg->email = $req->email;
            $reg->save();
            Session::put('forgotemail', $req->email);

            $token = sha1(rand()).$reg->id;

            PasswordReset::where('email', $req->email)->update(['validator' => $token]);

            $user = User::where('email',$req->email)->first();
            $phone=User::where('email', $req->email)->pluck('phone')->first();
            //dd($user);
            if ($phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Please click on the given URL to complete the proccess. Your password reset link is https://drhelpdesk.in/passwordreset/".$token);
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900681990356&sendto=".$req->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }
            $to = $req->email;
            $subject = 'Password Reset';
            $message = "Your password reset link  is  : https://drhelpdesk.in/passwordreset/".$token." Thank You Team DrHelpDessk";
            $headers = 'From:support@drhelpdesk.in';
            // if(mail($to, $subject, $message, $headers)) {

            // } else {

            // }
            Mail::send('emails.password_reset', ['msg' => $message, 'user' => $user] , function($message) use ($to){
            $message->to($to, 'User')->subject('Reset Password');
            $message->from('support@drhelpdesk.in','Drhelpdesk');
         });
            Auth::logout();
            toastr()->success('Your password reset link has been sent to your registered email/Mobile successfully');
            return back();
        } elseif(User::where('phone', $req->email)->count() > 0) {
            //$token =


            $reg = new PasswordReset;
            $reg->phone = $req->email;
            $reg->save();
            Session::put('forgotphone', $req->email);
            // dd($reg->phone);

            $token = sha1(rand()).$reg->id;

            PasswordReset::where('phone', $req->email)->update(['validator' => $token]);

            $user = User::where('phone',$req->email)->first();
            $phone=User::where('phone', $req->email)->pluck('phone')->first();
            // dd($token);
            if ($phone!=null) {
                // dd($reg->phone);
                // $otp = rand (1000, 9999);
                $msg=urlencode("Please click on the given URL to complete the process. Your password reset link is https://drhelpdesk.in/passwordreset/".$token);
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&templateID=1207161900681990356&sendto=".$reg->phone."&message=".$msg);
                // dd($curl);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }

            Auth::logout();
            toastr()->success('Your password reset link has been sent to your registered email/Mobile no. successfully');
            return back();

    }
        else {
            toastr()->error('User Id Not Found');
            return back();
        }
    }
    public function forgetPassword($id)
    {
        $forms=PasswordReset::where('validator',$id)->first();

        //$forms = profiles::where('id',$id)->select('email')->first();
      return view('UI.webviews.forgetpassword' ,compact("forms"));
    }

    public function submit(Request $req)
    {
        // dd($req->email);
        // $jsonDatat = json_decode($req->email, true);
        // $jsonDatat = json_decode($req->phone, true);
        $Useremail=Session::get('forgotemail');
        $Userphone=Session::get('forgotphone');

        $password = $req->password;
        $confirm_password = $req->cnf_password;
        if($password == $confirm_password && $Useremail != null)
        {
           User::Where('email', $Useremail)->update([
            'password'=>bcrypt($req->password) ]);

           PasswordReset::where('email',  $Useremail)->delete();
           toastr()->success('Your Password Is SuccessFully Changed ! Please Login');
           return redirect('login-user');

        }
        elseif($password == $confirm_password && $Userphone != null)
        {
           User::Where('phone', $Userphone)->update([
            'password'=>bcrypt($req->password) ]);

           PasswordReset::where('phone',  $Userphone)->delete();
           session()->forget(['forgotemail', 'forgotphone']);
           toastr()->success('Your Password Is SuccessFully Changed ! Please Login');
           return redirect('login-user');
        }
        else
        {
            toastr()->error('password do not match, please try again');
            return back();
        }
    }


    public function thanku()
    {
        return view('UI.webviews.thanku');
    }

    public function packageAddtToCart(Request $req){
        $session = Session::getId();
        $type = 3;
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count();
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>1
                ]);
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count();
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>1
                ]);
            }
        }
        // Session::flash ( 'message', "Packages Added into Cart" );
        toastr()->success('Packages Added into Cart');
        return back();
    }

    // Allow user to set defaultaddress in checkout page
    public function userSetDefaultAddress(Request $req){

        if(empty($req->user_id)){
            $arr = array(
                "status" => false,
                "msg"=>"Invalid User"
            );
            echo json_encode($arr); exit;
        }

        if(empty($req->address_id)){
            $arr = array(
                "status"=>false,
                "msg"=>"Invalid Address Selected"
            );
            echo json_encode($arr); exit;
        }

        // remove pre selected address
        DB::table('user_addresses')->where('user_id', $req->user_id)->update([
            'selected' => "0"
        ]);
        // set new default address
        DB::table('user_addresses')->where('id', $req->address_id)->update([
            'selected' => "1"
        ]);

        $arr = array(
            "status"=>true,
            "msg"=>"Default Address Updated"
        );
        echo json_encode($arr); exit;
    }

    // for coupon on  ajax
     public function userMyCartOnAjax(Request $req){

      
        $value = $req->session()->get('location_name');
        $dt = Carbon::now()->toDateString();
        // return ($req->coupon_code);
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first();

        $coupon_count = DB::table('coupons')->where('copoun_code',$req->coupon_code)->value('no_of_uses');
        // return ($coupon_count);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get();
            $match_count = $match->count();
            // return $match_count;
        }

        if($coupon1 != Null){
            if($match_count < $coupon_count ){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied";
                $data['type'] = $coupon1->type;
                $type1 = $coupon1->type;
                $cc = $coupon1->amount;
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                // return $coupondata;
                //$req->session()->put('couponData', $coupondata);
            	Session::put('couponData', $coupondata);
                 Session::save();
                echo 1;
            }else{
                $data['result1']='Your coupon code limit exceed.';
            	echo 2;
            }
        }
        else{
            $data['result1']='';
        	echo 3;
        }
        exit;
     }


        public function userBookingDetails($order_id){
            $data['flag'] = 9;
            $data['order'] = OrderItem::where('order_id',$order_id)->whereIn('type', [2,3])->orderBy('id','desc')->get();

            $data['order_status'] = DB::table('order_status')->get();
            return view('UI/webviews/user.manage_user_dashboard',$data);
        }

        public function orderFailPage($order_id){
            $data['flag']=8;
            $data['booking'] = Order::where('order_id',$order_id)->first();
            return view('UI/webviews/user.manage_user',$data);
        }

		public function userWalletHistory(){
        if(Auth::user()){
            $data['flag'] = 11;
            $data['wallet'] = DB::table('wallet_transaction_histories')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
           // dd($data['wallet']);
            return view('UI/webviews/user.manage_user_dashboard',$data);
        }else{
           return redirect('/');
        }
    }

	public function removeCoupon(Request $req)
    {
    	Session::forget('couponData');
        Session::save();
    	echo '1'; exit;
    }

	public function removeMyCartCoupon(Request $req)
    {
    	Session::forget('couponData');
        Session::save();
    	return redirect('/my-cart?remove=1');
    }

  function isEmail($email) {
      return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
     }

	public function thankYouPage(){
        $data['flag'] = 15;
        return view('UI/webviews/user.manage_user',$data);
    }
     /**
     * Check if user is exits or not
     * @param $request
     */
    public function isExists(Request $request){
        $mode = $this->isEmail($request->phn_or_email);
        $user = null;
        $flashmail=$request->phn_or_email;
        if($mode){
            $user = User::where('email', $request->phn_or_email)->first();
        }else{
            $user = User::where('phone', $request->phn_or_email)->first();
        }
        if($user){
            $data['flag'] = 6;
            Session::flash ( 'email', $flashmail );
            return redirect('login-user')->with(['msg2' =>'You already have an account, Please login using ' . $request->phn_or_email,'phn_or_email' => $request->phn_or_email]);
        }else{
            return redirect('registration')->with('msg', 'You dont have an account, Please register.');
        }
    }

		//For fetching cities
public function getAllCity(Request $request)
    {
			return $request;
       //  $cities = DB::table("city")
       //              ->where("state_id",$request->state_id)
       //              ->lists("city_name","city_id");
       // return response()->json($cities);
    }

	public function getCityList(Request $request)
        {
            $cities = DB::table("city")
            ->where("state_id",$request->state_id)
            ->pluck("city_name","city_id");
            return response()->json($cities);
        }


		public function addaddress_new(Request $req){
        $data['flag'] = 1;
        $file = $req->file('prescription_image');
            if($req->hasFile('prescription_image')) {
                $file = $req->file('prescription_image');
                $filename = 'prescription'.time().'.'.$req->prescription_image->extension();
                $destinationPath = storage_path('../public/upload/prescription');
                $file->move($destinationPath, $filename);
                $data= new Prescription;
                $data->user_id = Auth::id();
                $data->prescription_type = 1;
                $data->comment = $req->comment;
                $data->prescription_image = 'upload/prescription/'.$filename;
                $data->save();
                $data['prescription_id']=$data->id;
            }
            else{
                $data= new Prescription;
                $data->user_id = Auth::id();
                $data->prescription_type = 1;
                $data->comment = $req->comment;
                $data->save();
                $data['prescription_id']=$data->id;
            }
            Session::flash ('prescription_submit', $data->id );
        toastr()->success('image uploded successfully');
        return redirect('user-address');
    }

    public function prescriptionsubmit(Request $req){
        // dd($req);
        // $data= new UserAddress;
        // $data->user_id = Auth::id();
        // $data->name = $req->name;
        // $data->phone  = $req->phone;
        // $data->email  = $req->email;
        // $data->selected = empty($existing_addr)?"1":"0";
        // $data->address = $req->address;
        // $data->apartment = $req->apartment;
        // $data->city = $req->city;
        // $data->state  = $req->state;
        // $data->pin_code  = $req->pin_code;
        // $data->country  = $req->country;
        // $data->save();
        // $user_addresses_id =$data->id;

        if($req->user_addresses_id != Null){
        $prescription_id= $req->prescription_id;
        $user_addresses_id= $req->user_addresses_id;

        $user_id= Auth::user()->id;
        DB::table('prescriptions')->where('id', $prescription_id)->update([
            'user_addresses_id' => $user_addresses_id
        ]);
        toastr()->success('Your Prescription Uploaded Successfully, Our Customer Executive Will Get In Touch With You Shortly with Your Order Details & Payment Link');
        return redirect('/');
    } else{
    }
    }


    // add To wishlist

    public function addtoWishlist(Request $req){
            // dd($req);
            $result1=DB::table('wishlists')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count();
            if($result1 == 0){
                DB::table('wishlists')->insert([
                    'product_id'=>$req->products_id,
                    'attribute_id'=>$req->attribute_id,
                    'user_id'=> Auth::user()->id,
                    'quantity'=>1
                ]);
                toastr()->success('Item Added into Wishlist');
            }else{
                toastr()->warning('Item Already into Wishlist');
            }


        // Session::flash ( 'message1', "Item Added into Cart" );

        return back();
    }

    //display wishllist

    public function userMyWishlist(Request $req){
        $value = $req->session()->get('location_name');
        $data['map_location']= $value;
       // dd($value);
        $data['flag'] = 20;
        $wishlists=DB::table('wishlists')->where('user_id',Auth::user()->id)->get();
        // $result1=DB::table('wishlists')->where('user_id',Auth::user()->id)->count();

        if(!empty($wishlists)){
            $data['result']=$wishlists;
        }else{
            $data['result']='Please Choose To Continue Shopping';
        }
       // dd($data);
        return view('UI/webviews/user.manage_user',$data);
    }

    public function RemoveWishlist(Request $req){
        DB::table('wishlists')->where('product_id', $req->product_id)->where('user_id',Auth::user()->id)->delete();
        toastr()->error('Product successfully deleted from Wishlist');
        return back();
    }

    public function userMyprescription(Request $req){
        $value = $req->session()->get('location_name');
        $data['map_location']= $value;
       // dd($value);
        $data['flag'] = 21;
        $prescriptions=DB::table('prescriptions')->where('user_id',Auth::user()->id)->where('status', '1')->orderBy('id','desc')->get();

        if(!empty($prescriptions)){
            $data['result']=$prescriptions;
        }else{
            $data['result']='Upload Prescription';
        }
    //    dd($data);
        return view('UI/webviews/user.manage_user',$data);
    }

//new code change
    public function usernotification(){
        $data['flag'] = 22; 
        $data['order'] = DB::table('orders')->where('user_id', Auth::user()->id)->where('order_status', '!=', 0)->orderBy('created_at', 'desc')->paginate(15)->onEachSide(1);
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    


    /**
     * createShareLink
     * EndPoint /api/share/product
     * @param $user_id
     * @param $product_id
     */
    public function createShareLink(Request $request){
        $user_id = null;
        if(Auth::check()){
            $user_id =Auth::user()->id;
        }else{
            $user_id = $request->user_id;
        }

        if($user_id){
            $this->removeInvalidReferCodes();

            $refer_code = \Str::random(10);
            $refer = new Refer_code();
            $refer->user_id = $user_id;
            $refer->refer_code = $refer_code;
            $refer->product_id = $request->product_id;
            $refer->save();
            $product = Product::find($request->product_id);
            // dd($product);die();
            $slug = $product->slug ? $product->slug : 'product-details/'.$request->product_id;
            // dd($slug);
            $url = \Request::root().'/'. $product->slug;
            $link = $url . '?refer_code=' . $refer_code;
            // return $url . '?refer_code=' . $refer_code;
           return response()->json($data = [
                  'link' => $link
              ]);
        }else{
            return 403;
        }

    }

    /**
     * Verify Refer Code
     * EndPoint /api/verify/refer-code
     * @param $user_id
     * @param $product_id
     * @param $refer_code
     */
    public function verifyReferCode(Request $request){
        $user_id = null;
        if(Auth::check()){
            $user_id =Auth::user()->id;
        }else{
            $user_id = $request->user_id;
        }
        if($user_id){
            $this->removeInvalidReferCodes();
            $refer_code = $request->refer_code;
            $product_id = $request->product_id;
            $transaction = DeTransaction::where(['to_user' => $user_id, 'code' => $refer_code, 'source' => 'refer'])->first();
            if($transaction){
                $refer = Refer_code::where(['refer_code' => $refer_code,'product_id' => $product_id])->first();
                if($refer){
                    return response()->json([
                        'status' => 'Refer code found',
                        'refer_data' => $refer,
                        'transaction' => $transaction
                    ],201);
                }else{
                    return response()->json([
                        'status' => 'Refer code expired.',
                        'refer_data' => null
                    ],200);
                }
            }else{
                return response()->json([
                    'status' => 'Refer code not found',
                    'refer_data' => null
                ],200);
            }
        }

    }

    /**
     * Remove All Invalid codes (96 hours)
     */
    public function removeInvalidReferCodes(){
        $date = new \DateTime();
        $date->modify('-96 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $invalidCodes = Refer_code::where('created_at', '<',$formatted_date)->delete();
    }

    /**
     * Get List of product shared with users
     * 1: DeTransaction => where user_id = current_id and source = 'refer'
     * 2: groupby product => user => groupby status
     * 3: Using to_user and code you can find current status of shared product ['View', cart, purchsed]
     */

    /**
     * Create De Wallet trasaction
     * @param Number $from_user Coins generated by
     * @param Number $to_user Coins generated to
     * @param String $source Actual coin generation sourse ['refer','company']
     * @param Number $coins Actual earned coins
     * @param String $code
     * @param String $status
     */
    public function deWalletTransaction($from_user,$to_user,$source,$coins,$code,$status){
        $transaction = DeTransaction::where([
            'from_user' => $from_user,
            'to_user' => $to_user,
            'code' => $code,
            'source' => $source,
            'coins' =>$coins,
            'status' => $status
        ])->first();
        // dd($transaction);die;   
        try{
            $transaction = $transaction ? $transaction : new DeTransaction();
            $transaction->from_user = $from_user;
            $transaction->to_user   = $to_user;
            $transaction->source    = $source;
            $transaction->coins     = $coins;
            $transaction->code      = $code;
            $transaction->status    = $status;
            $result = $transaction->save();
            if($source == 'refer'){
                dd($result,$status);
                // dd($transaction);
                // DeTransaction::where('id', $transaction->id)->update(['status' => $status]); 
            }
            // dd($result,$status);
            return true;
        }catch(\Exception $e){
            // dd($e);
        }

    }
    /**
     * Get product by Status
     *
     */
    public function referByStatus(Request $request){
        $headers = apache_request_headers(); //get header
        $request->headers->set('Authorization', $headers['Authorization']);// set header in request
        $user = JWTAuth::parseToken()->authenticate();
        $products = $user->referCodes()->distinct('product_id')->pluck('product_id');
        $data = [];
        foreach($products as $product){
            $refer_codes    = $user->referCodes()->where('product_id', $product)->pluck('refer_code')->toArray();
            $users_data     = DeTransaction::with('toUser')->whereIn('code',$refer_codes)->where(['from_user' => $user->id])->get();
            $refer_codes_data = [
                'product' => Product::find($product),
                'refer_codes' => $refer_codes,
                'users' => $users_data->toArray()
            ];
            array_push($data,$refer_codes_data);
        }
        return response()->json([
            'status' => 'done',
            'products' => $data
        ]);
    }
    /**
     * Check User registared or not
     */
    public function checkUserData(Request $request){
        //dd($request->phone_list);
        $registeredUser = User::whereIn('phone',$request->phone_list)->get();
        return response()->json([
            'status' => 'done',
            'users' => $registeredUser
        ]);
    }
    // login with social

    public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }

 public function callback($provider)
 {
     $getInfo = Socialite::driver($provider)->user();
   $user = $this->createUser($getInfo,$provider);
   auth()->login($user);
   return redirect()->to('/');
 }

 function createUser($getInfo,$provider){
    $user = User::where('provider_id', $getInfo->id)->orWhere('email', $getInfo->email)->first();
    if ($user == null) {
         $user = User::create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'user_type'=> '2',
            'provider' => $provider,
            'provider_id' => $getInfo->id
        ]);
        $user_id = $user->id;
        $userDetail = UserDetail::create([
            'user_id'  => $user_id,
            'user_name' => $getInfo->name,
            'email'    => $getInfo->email
        ]);
      }
      return $user;
    }

    public function changePassword(){ 
        $data['flag'] = 10;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function changePasswordSubmit(Request $req){
        // dd($req);
        $id = Auth::User()->id;
        $user   = User::find($id);
        if(isset($req->old_password) && isset($req->new_password)){
            if(Hash::check($req->old_password, $user->password) && $req->old_password != $req->new_password ){
                $user->password = Hash::make($req->new_password);
                $user->save();        
                toastr()->success('Password Updated Successfully');
            }
            else{
                toastr()->error('Password Not Match');
            }
        }       
        return redirect()->back();
    }


    public function order_tracking()
    {
        $data['flag'] = 23; 
        return view('UI/webviews.user.manage_user_dashboard',$data); 
    }
    public function giftcardlist()
    {
        $data['flag'] = 24; 
        return view('UI/webviews.user.manage_user_dashboard',$data); 
    }

    public function giftcardsend()
    {
        $data['flag'] = 25; 
        return view('UI/webviews.user.manage_user_dashboard',$data); 
    }

}
