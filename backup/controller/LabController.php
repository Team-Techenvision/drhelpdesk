<?php

namespace App\Http\Controllers\admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;  
use App\Lab;

class VendorController extends Controller
{

    public function addLabs(){
        $data['flag'] = 1; 
        $data['page_title'] = 'Add Labs';   
        return view('admin/webviews/admin_manage_lab',$data);
    }

    public function viewLabs(){
        $data['flag'] = 2; 
        $data['page_title'] = 'View Labs';  
        return view('admin/webviews/admin_manage_lab',$data);
    }

    public function  deleteLabs($id){ 
        $data['result']=Lab::where('id',$id)->delete();
        return back()->with('msg','Lab Delete Successfully');  
    }

    public function editLabs($id){
        $data['flag'] = 3; 
        $data['page_title'] = 'Edit Labs';   
        $data['result'] = Lab::where('id',$id)->first(); 
        return view('admin/webviews/admin_manage_lab',$data);
    }
}