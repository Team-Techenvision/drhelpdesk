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
use App\ConsultationHistory;
use App\ConsultationTransaction;

class ChatController extends Controller
{
    public function startChat(Request $req){ 
        $data['flag'] = 1;
        $consultDetail = explode("#", $req->consult_call);
        
        $culthst = new ConsultationHistory();
        $culthst->user_id = $consultDetail[0];
        $culthst->doc_id = $consultDetail[1]; 
        $culthst->status = '1';
        $culthst->type = '1'; 
        $culthst->save();

        $credit = (int) $consultDetail[2];
        $cultTxn = new ConsultationTransaction();
        $cultTxn->user_id = $consultDetail[0];
        $cultTxn->doc_id =  $consultDetail[1];
        $cultTxn->consultation_credit = $credit-1;
        $cultTxn->type = '1';  
        $cultTxn->save();
        return view('UI/webviews/user.manage_chat',$data);
    }

    public function getList(){ 
        $user_list = [];
        $temp_doc_list = [];
        if(Auth::user()->user_type=='3') {
            $temp_doc_list = DB::table('consultation_transactions')->where('doc_id', Auth::user()->id)->where('type', '1')->groupBy('user_id')->select('user_id')->get();
                if($temp_doc_list) {
                foreach($temp_doc_list as $key=>$val) {
                    $user_list[$key] = $val->user_id;
                }
            }
        }  else {
            $temp_doc_list = DB::table('consultation_transactions')->where('user_id', Auth::user()->id)->where('type', '1')->groupBy('doc_id')->select('doc_id')->get();
            if($temp_doc_list) {
            foreach($temp_doc_list as $key=>$val) {
                $user_list[$key] = $val->doc_id;
            }
            }
        }
       
        
        $contacts = DB::table('users')->whereIn('id', $user_list)->get();
        return response()->json($contacts);
    }

    public function startDocChat(Request $req){ 
        $data['flag'] = 1;
        return view('UI/webviews/user.manage_chat',$data);
    }
     
     
} 