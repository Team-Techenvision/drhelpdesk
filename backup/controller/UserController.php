<?php

namespace App\Http\Controllers\admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Mail;  
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\DeWallet;
use App\ApplyReferCode;
use App\ContactUs;
use App\Newslatters;
class UserController extends Controller
{ 

    public function viewUserData(){
        $data['flag'] = 1; 
        $data['page_title'] = 'View User Record'; 
        $data['user'] = User::Join('user_details','users.id','user_details.user_id')->where('users.user_type',2)->orwhere('users.user_type',3)->orWhereNull('users.user_type')->orderBy('id','desc')->select('user_details.*','users.*')->get(); 
        //dd($data['user']);
        return view('admin/webviews/admin_manage_user_data',$data);
    }

    public function  deleteUserData($id){ 
        User::where('id',$id)->delete();
        DeWallet::where('user_id',$id)->delete();
        UserDetail::where('user_id',$id)->delete();
        ApplyReferCode::where('user_id',$id)->delete();
        return back()->with('msg','User Data Delete Successfully');  
    }

    public function blockAccount($id) { 
        User::where('id', $id)->update(['is_block' => 1]); 
        $user = User::where('id',$id)->first();
        if($user->count() > 0){ 
            
            if ($user->phone != null) {
                $msg = urlencode("Dear ".$user->name.", \nYour account has been blocked by dhd please contact to dhd know other details.");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" . $user->phone . "&message=" . $msg);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
            }
            
            if ($user->email!=null) {
                $to = $user['email'];
                $subject = 'Block Account By DHD';
                $message = "Dear ".$user->name.", \nYour account has been blocked by dhd please contact to dhd know other details";
                $headers = 'From:support@drhelpdesk.in';        
                if(mail($to, $subject, $message, $headers)) { 
                    //
                } 
                else { 
                    //
                }
            }   
        }
        return back()->with('msg','User Block Successfully');  
    } 

    public function unBlockAccount($id) {  
        User::where('id', $id)->update(['is_block' => 0]); 
        $user = User::where('id',$id)->first();
        if($user->count() > 0){
            if ($user->phone != null) {
                $msg = urlencode("Dear ".$user->name.", \nYour account has been Un blocked by dhd   \n\nThank You.");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" . $user->phone . "&message=" . $msg);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
            }
            
            if ($user->email!=null) {
                $to = $user['email'];
                $subject = 'UnBlock Account By DHD';
                $message = "Dear ".$user->name.", \nYour account has been Un blocked by dhd   \n\nThank You.";
                $headers = 'From:support@drhelpdesk.in';        
                if(mail($to, $subject, $message, $headers)) { 
                    //
                } 
                else { 
                    //
                }
            }  
        }
        return back()->with('msg','User Un Block Successfully');  
    } 

    public function approvenow($id)
    {   
        User::where('id', $id)->update([
          'is_active' =>1
      ]); 

        $user = User::where('id',$id)->first();
        if($user->count() > 0){
            if ($user->phone != null) {
                $msg = urlencode("Congratulations!!! Your profile has been successfully approved.                                                                           Millions of patients are ready to connect to you");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=" . $user->phone . "&message=" . $msg);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
            }
            
            if ($user->email!=null) {
                $to = $user['email'];
                $subject = 'Approve Now By DHD';
                $message = "Congratulations!!! Your profile has been successfully approved. 
                Millions of patients are ready to connect to you.";
                $headers = 'From:support@drhelpdesk.in';        
                if(mail($to, $subject, $message, $headers)) { 
                    //
                } 
                else { 
                    //
                }
            }   
        }  
        return back()->with('msg', 'Doctor approved successfully'); 
    } 

    public function viewContactUsFormDetail(){
        $data['flag'] = 2; 
        $data['page_title'] = 'View Contact US Form Details'; 
        $data['contact'] = ContactUs::orderBy('id','desc')->get(); 
        return view('admin/webviews/admin_manage_user_data',$data);
    }
    public function viewNewsLatterDetail(){
        $data['flag'] = 3; 
        $data['page_title'] = 'View News Letter Detail'; 
        $data['news_letter'] = Newslatters::orderBy('id','desc')->get();  
        return view('admin/webviews/admin_manage_user_data',$data);
    }
}