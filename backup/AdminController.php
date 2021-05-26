<?php

namespace App\Http\Controllers\admin; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use Mail;  
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\Notification;
use App\Product;
use App\shop_stock;
use App\expiry_stock;
use DB;
use Auth;
use Hash;
use App\Exports\UsersExport;
use App\shop_info;
class AdminController extends Controller
{
    // Categories start  
        public function addCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Categories'; 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function viewCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',0)->orderBy('categories_id','desc')->get(); 
            $data['save_more_category'] = Category::where('parent_id',null)->where('type',2)->orderBy('categories_id','desc')->get(); 
            $data['covid_category'] = Category::where('parent_id',null)->where('type',3)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function  deleteCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function editSaveMoreCategories($categories_id){
            $data['flag'] = 4; 
            $data['page_title'] = 'Edit Save More Care More Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function editCovidCategories($categories_id){
            $data['flag'] = 5; 
            $data['page_title'] = 'Edit Covid 19 Essential Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function toggleCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function categoriesSubmit(Request $req){  
            if($req->categories_id) {  
                //dd($req->back_color);
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'category'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/category');
                    $file->move($destinationPath, $filename);
                    $category = 'upload/category/'.$filename;
                }
                else{
                    $category = $req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'category_name' => $req->category_name,
                    'title' => $req->title,
                    'image' => $category,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Category Edit  Successfully');
            }else{ 
                $filename = "";
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'category'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/category');
                    $file->move($destinationPath, $filename);
                } 
                $data = new Category();
                $data->category_name = $req->category_name; 
                $data->image = 'upload/category/'.$filename;
                $data->title = $req->title;  
                $data->type = $req->type;  
                $data->back_color = $req->back_color;  
                $data->save(); 
                return back()->with('msg','Category Add  Successfully');
            }
        }    
    // Categories End 

    // Sub Categories start
        public function addSubCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('categories_id','asc')->get(); 

            $data['sub_category'] = Category::where('category_name',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  

            $data['sub_sub_category'] = Category::where('category_name',null)->where('sub_parent_id','!=' ,null)->where('parent_id','!=' ,null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get(); 
            
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function viewSubCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Sub Categories'; 
            $data['category'] = Category::where('category_name',null)->where('type',0)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function  deleteSubCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editSubCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('categories_id','asc')->get(); 

            $data['sub_category'] = Category::where('category_name',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  

            $data['sub_sub_category'] = Category::where('category_name',null)->where('sub_parent_id','!=' ,null)->where('parent_id','!=' ,null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get(); 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function toggleSubCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function subCategoriesSubmit(Request $req){ 
            
            if($req->categories_id) { 
                //dd($req->back_color);
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'subcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/subcategory');
                    $file->move($destinationPath, $filename);
                    $subcategory = 'upload/subcategory/'.$filename;
                }
                else{
                    $subcategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([ 
                    'title' => $req->title,
                    'image' => $subcategory,
                    'sub_category_name' => $req->sub_category_name, 
                    'parent_id' => $req->parent_id,
                    'sub_parent_id' => $req->sub_parent_id,
                    'sub_sub_parent_id' => $req->sub_sub_parent_id,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Sub Category Edit  Successfully');
            }else{ 
            	$req->validate([
                'parent_id'=> 'required',  
                'image'=>'mimes:jpeg,jpg,png,gif,svg|required'
            	]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'subcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/subcategory');
                    $file->move($destinationPath, $filename);
                	$image = 'upload/subcategory/'.$filename;
                } 
                $data = new Category();
                $data->parent_id = $req->parent_id; 
                $data->sub_parent_id = $req->sub_parent_id; 
                $data->sub_sub_parent_id = $req->sub_sub_parent_id; 
                $data->sub_category_name = $req->sub_category_name; 
                $data->image = 'upload/subcategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                //dd($req);
                $data->save(); 
            	
//             	$title=$req->title; 
//                 $message = $req->sub_category_name;
//                 $user = User::get(); 
//                 $notObj = new Notification();
//                 foreach ($user as $key => $value) {
//                     $regId = $value->device_token;
//                     $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json',$image);
//                 } 
                
//                 $resdata = json_decode($response, true);
                return back()->with('msg','Sub Category Add  Successfully');
            }
        }  
    // Subcategory End 

    // user Categories start 
        public function addUserCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Categories'; 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function viewUserCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',1)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function  deleteUserCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editUserCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function toggleUserCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function userCategoriesSubmit(Request $req){ 
            //dd($req->back_color);
            $req->validate([
                'category_name'=> 'required'
            ]); 
            if($req->categories_id) { 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usercategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usercategory');
                    $file->move($destinationPath, $filename);
                    $usercategory = 'upload/usercategory/'.$filename;
                }
                else{
                    $usercategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'category_name' => $req->category_name, 
                    'title' => $req->title,
                    'image' => $usercategory,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Category Edit  Successfully');
            }else{ 
                $req->validate([
                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usercategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usercategory');
                    $file->move($destinationPath, $filename);
                }

                $data = new Category();
                $data->category_name = $req->category_name; 
                $data->type = $req->type;  
                $data->image = 'upload/usercategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                $data->save(); 
                return back()->with('msg','Category Add  Successfully');
            }
        }
    // User Categories End  

    // user sub Categories start 
        public function addUserSubCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',1)->where('status',0)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function viewUserSubCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Sub Categories'; 
            $data['category'] = Category::where('category_name',null)->where('type',1)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function  deleteUserSubCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editUserSubCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Sub Categories'; 
            $data['sub_category'] = Category::where('parent_id',null)->where('type',1)->where('status',0)->orderBy('categories_id','desc')->get(); 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function toggleUserSubCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

         public function userSubCategoriesSubmit(Request $req){ 
            $req->validate([
                'parent_id'=> 'required',
                'sub_category_name'=> 'required'
            ]); 
            if($req->categories_id) { 
                 if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usersubcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usersubcategory');
                    $file->move($destinationPath, $filename);
                    $usersubcategory = 'upload/usersubcategory/'.$filename;
                }
                else{
                    $usersubcategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'parent_id' => $req->parent_id,
                    'sub_category_name' => $req->sub_category_name,
                    'title' => $req->title,
                    'image' => $usersubcategory,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Sub Category Edit  Successfully');
            }else{ 
                $req->validate([
                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usersubcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usersubcategory');
                    $file->move($destinationPath, $filename);
                	$image = 'upload/usersubcategory/'.$filename;
                }
                $data = new Category();
                $data->parent_id = $req->parent_id; 
                $data->sub_category_name = $req->sub_category_name; 
                $data->type = $req->type; 
                $data->image = 'upload/usersubcategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                $data->save(); 
            
//             	$title=$req->title; 
//                 $message = $req->sub_category_name;
//                 $user = User::get(); 
//                 $notObj = new Notification();
//                 foreach ($user as $key => $value) {
//                     $regId = $value->device_token;
//                     $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json',$image);
//                 } 
                
//                 $resdata = json_decode($response, true);
                return back()->with('msg','Sub Category Add  Successfully');
            }
        } 
    // User Subcategory End

    // Banner start  

        public function addBanner(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Banner'; 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function viewBanner(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Banner'; 
            $data['banner'] = Banner::orderBy('banners_id','desc')->get(); 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function  deleteBanner($banners_id){ 
            $data['result']=Banner::where('banners_id',$banners_id)->delete();
            return back()->with('msg','Banner Delete Successfully');  
        }

        public function editBanner($banners_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Banner'; 
            $data['result'] = Banner::where('banners_id',$banners_id)->first(); 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function toggleBannerActiveStatus($status, $banners_id) { 
            Banner::where('banners_id', $banners_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function bannerSubmit(Request $req){  
            if($req->banners_id) { 
            	$req->validate([
                'banner_name'=> 'required',  
                'type'=> 'required',
                'location'=> 'required',
                //'image'=>'dimensions:width=606,height=236|mimes:jpeg,jpg,png,gif,svg|required'
                
            	]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'banner'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/banner');
                    $file->move($destinationPath, $filename);
                    $banner = 'upload/banner/'.$filename;
                }
                else{
                    $banner=$req->image;
                }

                Banner::where('banners_id',$req->banners_id)->update([
                    'banner_name' => $req->banner_name,  
                    'image' => $banner,
                    'type' => $req->type, 
                    'location' => $req->location, 
                    'page_name' => $req->page_name, 
                    'show_on' => $req->show_on, 
                    'from' => $req->from, 
                    'to' => $req->to, 
                    'banner_link' => $req->banner_link 
                ]);
                return back()->with('msg','Banner Edit  Successfully');
            }else{ 
                $req->validate([
                'banner_name'=> 'required',  
                'type'=> 'required',
                'location'=> 'required',
                //'image'=>'dimensions:width=606,height=236|mimes:jpeg,jpg,png,gif,svg|required'
                'image'=>'mimes:jpeg,jpg,png,gif,svg|required'
            	]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'banner'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/banner');
                    $file->move($destinationPath, $filename);
                }
                //dd($req->all());
                $data = new Banner();
                $data->banner_name = $req->banner_name; 
                $data->image = 'upload/banner/'.$filename;
                $data->type = $req->type; 
                $data->location = $req->location; 
                $data->page_name = $req->page_name; 
                $data->from = $req->from; 
                $data->to = $req->to; 
                $data->show_on = $req->show_on;
                $data->banner_link = $req->banner_link ;
                //dd($req);  
                $data->save(); 
                return back()->with('msg','Banner Add  Successfully');
            }
        }
    // banner End
	 
	 
    // coupon start  
        public function addCoupon(){  
        	if(Auth::User()->id == 1){
            	$data['flag'] = 1; 
            	$data['page_title'] = 'Add Coupon';  
            	$data['rand'] = rand(111111, 999999); 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }else{
            	$data['flag'] = 4; 
            	$data['page_title'] = ' '; 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }
        }

        public function viewCoupon(){  
            if(Auth::User()->id == 1){
            	$data['flag'] = 2; 
            	$data['page_title'] = 'View Coupon'; 
            	$data['coupon'] = Coupon::orderBy('coupons_id','desc')->get(); 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }else{
            	$data['flag'] = 4; 
            	$data['page_title'] = ' '; 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }
        }

        public function  deleteCoupon($coupons_id){ 
        	if(Auth::User()->id == 1){
           	 	$data['result']=Coupon::where('coupons_id',$coupons_id)->delete();
            	return back()->with('msg','Coupon Delete Successfully');  
            }else{
            	$data['flag'] = 4; 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }
        }

        public function editCoupon($coupons_id){  
            if(Auth::User()->id == 1){
            	$data['flag'] = 3; 
            	$data['page_title'] = 'Edit Coupon'; 
            	$data['result'] = Coupon::where('coupons_id',$coupons_id)->first(); 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }else{
            	$data['flag'] = 4; 
            	$data['page_title'] = ' '; 
            	return view('admin/webviews/admin_manage_coupon',$data);
            }
        }

        public function toggleCouponActiveStatus($status, $coupons_id) { 
            Coupon::where('coupons_id', $coupons_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

         public function couponSubmit(Request $req){  
            $req->validate([
                'copoun_name'=> 'required',  
                'amount'=> 'required',  
                'type'=> 'required',  
                'copoun_code'=> 'required','unique:coupons','max:6',
                'no_of_uses'=> 'required'  
            ]); 
            if($req->coupons_id) {  
                Coupon::where('coupons_id',$req->coupons_id)->update([
                    'copoun_name' => $req->copoun_name, 
                    'copoun_code' => $req->copoun_code, 
                    'amount' => $req->amount, 
                    'type' => $req->type, 
                    'from' => $req->from, 
                    'to' => $req->to, 
                    'no_of_uses' => $req->no_of_uses 
                ]);
                return back()->with('msg','Coupon Edit Successfully');
            }else{  
            	if($req->copoun_code != null){
                    $check =  Coupon::where('copoun_code',$req->copoun_code)->first();
                    if($check != null){
                        return back()->with('msg','Coupon Code already Exist');
                    } 
                }
                $data = new Coupon();
                $data->copoun_name = $req->copoun_name;  
                $data->copoun_code = $req->copoun_code; 
                $data->amount = $req->amount; 
                $data->type = $req->type; 
                $data->from = $req->from; 
                $data->to = $req->to; 
                $data->no_of_uses = $req->no_of_uses;  
                $data->save(); 
                return back()->with('msg','Coupon Add Successfully');
            }
        } 
    // Coupon End
    
    // role start  
        public function addRole(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Role'; 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function viewRole(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Role'; 
            $data['category'] = Role::orderBy('roles_id','desc')->get(); 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function  deleteRole($roles_id){ 
            $data['result']=Role::where('roles_id',$roles_id)->delete();
            return back()->with('msg','Role Delete Successfully');  
        }

        public function editRole($roles_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Role'; 
            $data['result'] = Role::where('roles_id',$roles_id)->first(); 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function toggleRoleActiveStatus($status, $roles_id) { 
            Role::where('roles_id', $roles_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function RoleSubmit(Request $req){ 
            $req->validate([
                'role_name'=> 'required'  
            ]); 
            if($req->roles_id) { 
                Role::where('roles_id',$req->roles_id)->update([
                    'role_name' => $req->role_name 
                ]);
                return back()->with('msg','Role Edit  Successfully');
            }else{ 
                $data = new Role();
                $data->role_name = $req->role_name; 
                $data->save(); 
                return back()->with('msg','Role Add  Successfully');
            }
        } 
    // Role End  

    // language start 

        public function addLanguage(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Language'; 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function viewLanguage(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Language'; 
            $data['category'] = Language::orderBy('languages_id','desc')->get(); 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function  deleteLanguage($languages_id){ 
            $data['result']=Language::where('languages_id',$languages_id)->delete();
            return back()->with('msg','Language Delete Successfully');  
        }

        public function editLanguage($languages_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Language'; 
            $data['result'] = Language::where('languages_id',$languages_id)->first(); 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function toggleLanguageActiveStatus($status, $languages_id) { 
            Language::where('languages_id', $languages_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function LanguageSubmit(Request $req){ 
            $req->validate([
                'language_name'=> 'required'  
            ]); 
            if($req->languages_id) { 
                Language::where('languages_id',$req->languages_id)->update([
                    'language_name' => $req->language_name 
                ]);
                return back()->with('msg','Language Edit  Successfully');
            }else{ 
                $data = new Language();
                $data->language_name = $req->language_name; 
                $data->save(); 
                return back()->with('msg','Language Added  Successfully');
            }
        } 
    // Language End 

    // user details start 

        public function addUserDetails(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Details'; 
            $data['role'] = Role::where('status',0)->orderBy('roles_id','desc')->get();
            $data['sub_category'] = Category::where('status',0)->where('type',1)->where('category_name',null)->orderBy('categories_id','desc')->get();
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function viewUserDetails($user_details_id){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Details'; 
            $data['user_detail'] = UserDetail::where('user_details_id',$user_details_id)->first();
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function  deleteUserDetails($user_details_id){ 
            $data['result']=UserDetail::where('user_details_id',$user_details_id)->delete();
            return back()->with('msg','User Details Delete Successfully');  
        }

        public function editUserDetails($user_details_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Details';
            $data['role'] = Role::where('status',0)->orderBy('roles_id','desc')->get(); 
            $data['sub_category'] = Category::where('status',0)->where('type',1)->where('category_name',null)->orderBy('categories_id','desc')->get();
            $data['result'] = UserDetail::where('user_details_id',$user_details_id)->first(); 
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function toggleUserDetailsActiveStatus($status, $user_details_id) { 
            UserDetail::where('user_details_id', $user_details_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }
        
//         public function userDetailsSubmit(Request $req){ 
            
//             if($req->user_details_id) { 
//                 $req->validate([
//                     'user_name'=> 'required',  
//                     'address'=> 'required',
//                     'city'=> 'required',  
//                     'pin_code'=> 'required',  
//                     'state'=> 'required',  
//                     'country'=> 'required',  
//                     'email'=> 'required', 'string', 'email', 'max:255', 'unique:users',
//                     'mobile'=> 'required'   
//                 ]); 

//                 if($req->hasFile('image')) {
//                     $file = $req->file('image');
//                     $filename = 'userdetails'.time().'.'.$req->image->extension();
//                     $destinationPath = storage_path('../public/upload/userdetails');
//                     $file->move($destinationPath, $filename);
//                     $userdetails = 'upload/userdetails/'.$filename;
//                 }
//                 else{
//                     $userdetails=$req->image;
//                 } 

//                 if($req->role_id == 1){
//                     UserDetail::where('user_details_id',$req->user_details_id)->update([
//                         'user_name' => $req->user_name,  
//                         'dob' => $req->dob,  
//                         'gender' => $req->gender,  
//                         'image' => $userdetails,
//                         'address' => $req->address, 
//                         'address2' => $req->address2,  
//                         'city' => $req->city, 
//                         'pin_code' => $req->pin_code, 
//                         'state' => $req->state, 
//                         'country' => $req->country, 
//                         'email' => $req->email, 
//                         'mobile' => $req->phone,  
//                         'role_id' => $req->role_id, 
//                         'doctor_category' => $req->doctor_category,
//                         'speciality' => $req->speciality,
//                         'service' => $req->service,
//                         'specialization' => $req->specialization,
//                         'experience_from' => $req->experience_from,
//                         'experience_to' => $req->experience_to,
//                         'description' => $req->description,
//                         'rating_option' => $req->rating_option,
//                         'consultation_fees' => $req->consultation_fees,
//                         //dd($req)
//                     ]);
//                 }elseif($req->role_id == null){
//                     $role = null;
//                     UserDetail::where('user_details_id',$req->user_details_id)->update([
//                         'user_name' => $req->user_name,  
//                         'dob' => $req->dob,  
//                         'gender' => $req->gender,  
//                         'image' => $userdetails,
//                         'address' => $req->address, 
//                         'address2' => $req->address2,
//                         'city' => $req->city, 
//                         'pin_code' => $req->pin_code, 
//                         'state' => $req->state, 
//                         'country' => $req->country, 
//                         'email' => $req->email, 
//                         'mobile' => $req->phone,
//                         'role_id' => $role,
//                         'doctor_category' => $req->doctor_category, 
//                         'speciality' => $role,
//                         'service' => $role,
//                         'specialization' => $role,
//                         'experience_from' => $role,
//                         'experience_to' => $role,
//                         'description' => $role,
//                         'rating_option' => $role,
//                         'consultation_fees' => $role
//                         //dd($req)
//                     ]);
//                 }
                
//                 return back()->with('msg','User Detail Edit  Successfully');
//             }else{ 
//                 $req->validate([
//                     'user_name'=> 'required', 
//                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required', 
//                     'address'=> 'required',
//                     'city'=> 'required',  
//                     'pin_code'=> 'required',  
//                     'state'=> 'required',  
//                     'country'=> 'required',  
//                     'email'=> 'required|string|email|max:255|unique:users',
//                     'mobile'=> 'required'   
//                 ]); 

//                 if($req->hasFile('image')) {
//                     $file = $req->file('image');
//                     $filename = 'userdetails'.time().'.'.$req->image->extension();
//                     $destinationPath = storage_path('../public/upload/userdetails');
//                     $file->move($destinationPath, $filename);
//                     $userdetails = 'upload/userdetails/'.$filename;
//                 }
//                  $departmenticon = null;
//                 if($req->hasFile('department_icon')) {
//                     $file = $req->file('department_icon');
//                     $filename = 'departmenticon'.time().'.'.$req->department_icon->extension();
//                     $destinationPath = storage_path('../public/upload/departmenticon');
//                     $file->move($destinationPath, $filename);
//                     $departmenticon = 'upload/departmenticon/'.$filename;
//                 }
//                  $clinicimage1 = null;
//                 if($req->hasFile('clinic_image_one')) {
//                     $file = $req->file('clinic_image_one');
//                     $filename = 'clinicimage'.time().'.'.$req->clinic_image_one->extension();
//                     $destinationPath = storage_path('../public/upload/clinicimage');
//                     $file->move($destinationPath, $filename);
//                     $clinicimage1 = 'upload/clinicimage/'.$filename;
//                 } 
//                  $clinicimage2 = null;
//                 if($req->hasFile('clinic_image_two')) {
//                     $file = $req->file('clinic_image_two');
//                     $filename = 'clinicimage'.time().'.'.$req->clinic_image_two->extension();
//                     $destinationPath = storage_path('../public/upload/clinicimage');
//                     $file->move($destinationPath, $filename);
//                     $clinicimage2 = 'upload/clinicimage/'.$filename;
//                 } 
//                  $clinicimage3 = null;
//                 if($req->hasFile('clinic_image_three')) {
//                     $file = $req->file('clinic_image_three');
//                     $filename = 'clinicimage'.time().'.'.$req->clinic_image_three->extension();
//                     $destinationPath = storage_path('../public/upload/clinicimage');
//                     $file->move($destinationPath, $filename);
//                     $clinicimage3 = 'upload/clinicimage/'.$filename;
//                 }
//                  $clinicimage4 = null;
//                 if($req->hasFile('clinic_image_four')) {
//                     $file = $req->file('clinic_image_four');
//                     $filename = 'clinicimage'.time().'.'.$req->clinic_image_four->extension();
//                     $destinationPath = storage_path('../public/upload/clinicimage');
//                     $file->move($destinationPath, $filename);
//                     $clinicimage4 = 'upload/clinicimage/'.$filename;
//                 }

//                 $reg2 = new User;
//                 $reg2->name = $req->user_name;
//                 $reg2->email = $req->email;
//                 $reg2->phone = $req->mobile;
//                 if($req->role_id == 1){
//                     $reg2->user_type = 3;
//                 }else{
//                     $reg2->user_type = 2;
//                 }  
//                 $password = rand(111111, 999999);
//                 $reg2->password = bcrypt($password);  
//                 $reg2->save(); 

//                 $data = new UserDetail();
//                 $data->user_id=$reg2->id;
//                 $data->user_name = $req->user_name;  
//                 $data->image = $userdetails;
//                 $data->address = $req->address; 
//                 $data->city = $req->city; 
//                 $data->pin_code = $req->pin_code; 
//                 $data->state = $req->state; 
//                 $data->country = $req->country; 
//                 $data->email = $req->email; 
//                 $data->mobile = $req->mobile;
//                 if($req->role_id == 1){
//                     $data->role_id = $req->role_id; 
//                     $data->department_icon = $departmenticon;
//                     $data->clinic_image_one = $clinicimage1;
//                     $data->clinic_image_two = $clinicimage2;
//                     $data->clinic_image_three = $clinicimage3;
//                     $data->clinic_image_four = $clinicimage4;
//                     $data->service = $req->service; 
//                     $data->doctor_category = $req->doctor_category; 
//                     $data->specialization = $req->specialization; 
//                     $data->degree = $req->degree; 
//                     $data->department_name = $req->department_name; 
//                     $data->speciality = $req->speciality; 
//                     $data->experience_from = $req->experience_from; 
//                     $data->experience_to = $req->experience_to; 
//                     $data->description = $req->description;
//                     $data->consultation_fees = $req->consultation_fees;
//                 }
//                 //dd($req); 
//                 $data->save(); 
//                 if ($req->mobile!=null) {
//                     $otp = rand (1000, 9999);
//                     $msg=urlencode("Dear ".$req->user_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
//                     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$req->mobile."&message=".$msg);
//                     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
//                     $response=curl_exec($curl);
//                     curl_close($curl);
//                 } 
//                 //$user1 = User::where('user_type',1)->first();
               
//                 if($reg2->user_type == 2){
//                     $to_name = $reg2->name;
//                     $to_email = $reg2->email; 
//                      $user = User::where('email',$reg2->email)->first();
//                     Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email) {
//                         $message->to($to_email, $to_name)
//                         ->subject('Registration In DHD');
//                         $message->from('support@drhelpdesk.in','Drhelpdesk');
//                     });
//                 }elseif($reg2->user_type == 3){
//                     $to_name = $reg2->name;
//                     $to_email = $reg2->email; 
//                       $user = User::where('email',$reg2->email)->first();
//                     Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
//                         $message->to($to_email, $to_name)
//                         ->subject('Registration In DHD');
//                         $message->from('support@drhelpdesk.in','Drhelpdesk');
//                     });
//                 } 
//                 // $user = User::where('email',$req->email)->first();
//                 // $to = $reg2['email'];
//                 // $subject = 'WelCome In DHD';
//                 // $message = "Dear ".$req->user_name.", \nYour Email-       ".$req->email."\n And Password is-     ".$password." \n\nThank You.";
//                 // $headers = 'From:From:info@dhd.in';        
//                 // if(mail($to, $subject, $message, $headers)) {
//                 //     echo 'Your Login Credentials Is Send To your registered email Address';
//                 // } 
//                 // else {
//                 //     echo 'Sorry! something went wrong, please try again.';
//                 // }
//                 return back()->with('msg','User Detail Add  Successfully');
//             }
//         }   
		
         public function sendOfferView(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Send Offers'; 
            return view('admin/webviews/admin_mange_offer',$data);
         }
		 

		 public function sendOffers(Request $req){
                $notObj = new Notification();
                $req->validate([
                    'offer_title'=> 'required',  
                	'offer_description'=> 'required'
                ]); 
				
//                 if($req->hasFile('offer_image')) {
//                     $file = $req->file('offer_image');
//                     $filename = 'offers'.time().'.'.$req->offer_image->extension();
//                     $destinationPath = storage_path('../public/upload/offers');
//                     $file->move($destinationPath, $filename);
//                     $blog = 'upload/offers/'.$filename;
                	
//                 	$image =  asset('/' . $blog);
//                 } else {
//                 	$image = "";
//                 }
         		$image = "https://drhelpdesk.in/UI/images/DHD-Logo.png";
         		$title=$req->offer_title; 
         		$message = $req->offer_description;
         		$user = User::get();
                
         		// $regId = "c48Qv52ih7Y:APA91bEm0O0IExN_P4kqjbAcnIwOJXvDQMbTqGc1XcWUsSE7tDhbxGYpD-W8quzVb1d6wXCyQYcN4SxkRoabQ_CSGD2buhGV0OhY3MlbS3W9EyO6gXyNDmGxy2cvxe-_BotHjGu9kGlf";
                foreach ($user as $key => $value) {
                    $regId = $value->device_token;
                	$response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
                }
         		//$regId = "c48Qv52ih7Y:APA91bEm0O0IExN_P4kqjbAcnIwOJXvDQMbTqGc1XcWUsSE7tDhbxGYpD-W8quzVb1d6wXCyQYcN4SxkRoabQ_CSGD2buhGV0OhY3MlbS3W9EyO6gXyNDmGxy2cvxe-_BotHjGu9kGlf";
         		//$response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json', $image);
              	
         		$resdata = json_decode($response, true);
         		//dd($response); die;
         		if(!empty($resdata['success']) && $resdata['success']=='1') {
                   return back()->with('msg','Offer Send Successfully');
                } else {
                  return back()->with('msg','Offer Send Successfully');
                }
            
         }

		 public function userDetailsSubmit(Request $req){
            if($req->user_details_id) { 
           
                $req->validate([
                    'user_name'=> 'required',  
                    'address'=> 'required',
                    'city'=> 'required',  
                    'pin_code'=> 'required',  
                    'state'=> 'required',  
                    'country'=> 'required'  
                    
                ]);  
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

                if($req->role_id == 1){
                    UserDetail::where('user_details_id',$req->user_details_id)->update([
                        'user_name' => $req->user_name,  
                        'dob' => $req->dob,  
                        'gender' => $req->gender,  
                        'image' => $userdetails,
                        'address' => $req->address, 
                        'address2' => $req->address2,  
                        'city' => $req->city, 
                        'pin_code' => $req->pin_code, 
                        'state' => $req->state, 
                        'country' => $req->country, 
                        'email' => $req->email, 
                        'mobile' => $req->phone,  
                        'role_id' => $req->role_id, 
                        'doctor_category' => $req->doctor_category,
                        'speciality' => $req->speciality,
                        'service' => $req->service,
                        'specialization' => $req->specialization,
                        'experience_from' => $req->experience_from,
                        'experience_to' => $req->experience_to,
                        'description' => $req->description,
                        'rating_option' => $req->rating_option,
                        'consultation_fees' => $req->consultation_fees,
                        //dd($req)
                    ]);
                	User::where('email',$req->email)->update([
                        'name' => $req->user_name 
                    ]);
                }elseif(!empty($req->role_id)){
                	  
                    $role = null;
                    UserDetail::where('user_details_id',$req->user_details_id)->update([
                        'user_name' => $req->user_name,  
                        'dob' => $req->dob,  
                        'gender' => $req->gender,  
                        'image' => $userdetails,
                        'address' => $req->address, 
                        'address2' => $req->address2,
                        'city' => $req->city, 
                        'pin_code' => $req->pin_code, 
                        'state' => $req->state, 
                        'country' => $req->country, 
                        'email' => $req->email, 
                        'mobile' => $req->phone,
                        'role_id' => $role,
                        'doctor_category' => $req->doctor_category, 
                        'speciality' => $role,
                        'service' => $role,
                        'specialization' => $role,
                        'experience_from' => $role,
                        'experience_to' => $role,
                        'description' => $role,
                        'rating_option' => $role,
                        'consultation_fees' => $role
                        //dd($req)
                    ]);
                	User::where('email',$req->email)->update([
                        'name' => $req->user_name 
                    ]);
                } 
                return back()->with('msg','User Detail Edit  Successfully');
            }else{ 
                $req->validate([
                    'user_name'=> 'required', 
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required', 
                    'address'=> 'required',
                    'city'=> 'required',  
                    'pin_code'=> 'required',  
                    'state'=> 'required',  
                    'country'=> 'required',  
                    'email'=>'required|email|unique:users',
                    'phone'=>'required|numeric|unique:users',   
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'userdetails'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/userdetails');
                    $file->move($destinationPath, $filename);
                    $userdetails = 'upload/userdetails/'.$filename;
                }
                 $departmenticon = null;
                if($req->hasFile('department_icon')) {
                    $file = $req->file('department_icon');
                    $filename = 'departmenticon'.time().'.'.$req->department_icon->extension();
                    $destinationPath = storage_path('../public/upload/departmenticon');
                    $file->move($destinationPath, $filename);
                    $departmenticon = 'upload/departmenticon/'.$filename;
                }
                 $clinicimage1 = null;
                if($req->hasFile('clinic_image_one')) {
                    $file = $req->file('clinic_image_one');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_one->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage1 = 'upload/clinicimage/'.$filename;
                } 
                 $clinicimage2 = null;
                if($req->hasFile('clinic_image_two')) {
                    $file = $req->file('clinic_image_two');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_two->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage2 = 'upload/clinicimage/'.$filename;
                } 
                 $clinicimage3 = null;
                if($req->hasFile('clinic_image_three')) {
                    $file = $req->file('clinic_image_three');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_three->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage3 = 'upload/clinicimage/'.$filename;
                }
                 $clinicimage4 = null;
                if($req->hasFile('clinic_image_four')) {
                    $file = $req->file('clinic_image_four');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_four->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage4 = 'upload/clinicimage/'.$filename;
                }

                $reg2 = new User;
                $reg2->name = $req->user_name;
                $reg2->email = $req->email;
                $reg2->phone = $req->phone;
                if($req->role_id == 1){
                    $reg2->user_type = 3;
                }else{
                    $reg2->user_type = 2;
                }  
                $password = rand(111111, 999999);
                $reg2->password = bcrypt($password);  
                $reg2->save(); 

                $data = new UserDetail();
                $data->user_id=$reg2->id;
                $data->user_name = $req->user_name;  
                $data->image = $userdetails;
                $data->address = $req->address; 
                $data->city = $req->city; 
                $data->pin_code = $req->pin_code; 
                $data->state = $req->state; 
                $data->country = $req->country; 
                $data->email = $req->email; 
                $data->mobile = $req->phone;
                if($req->role_id == 1){
                    $data->role_id = $req->role_id; 
                    $data->department_icon = $departmenticon;
                    $data->clinic_image_one = $clinicimage1;
                    $data->clinic_image_two = $clinicimage2;
                    $data->clinic_image_three = $clinicimage3;
                    $data->clinic_image_four = $clinicimage4;
                    $data->service = $req->service; 
                    $data->doctor_category = $req->doctor_category; 
                    $data->specialization = $req->specialization; 
                    $data->degree = $req->degree; 
                    $data->department_name = $req->department_name; 
                    $data->speciality = $req->speciality; 
                    $data->experience_from = $req->experience_from; 
                    $data->experience_to = $req->experience_to; 
                    $data->description = $req->description;
                    $data->consultation_fees = $req->consultation_fees;
                }  
                $data->save(); 

                if ($req->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Dear ".$req->user_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$req->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }  
               
                if($reg2->user_type == 2){
                    $to_name = $reg2->name;
                    $to_email = $reg2->email; 
                     $user = User::where('email',$reg2->email)->first();
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
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
                }elseif($reg2->user_type == 3){
                    $to_name = $reg2->name;
                    $to_email = $reg2->email; 
                      $user = User::where('email',$reg2->email)->first();
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
                return back()->with('msg','User Detail Add  Successfully');
            }}  
    // user details end 
    	public function editHeaderMarquee($id){ 
            $data['page_title'] = 'Add Header Marquee Content'; 
            $data['result'] = DB::table('header_contents')->where('id',$id)->first();
            return view('admin/components/admin_edit_header_marquee',$data);
        }
        public function editHeaderMarqueeSubmit(Request $req){  
            if($req->hasFile('same_day_image')) {
                $file = $req->file('same_day_image');
                $filename = 'header'.time().'.'.$req->same_day_image->extension();
                $destinationPath = storage_path('../public/upload/header');
                $file->move($destinationPath, $filename);
                $same_day_header = 'upload/header/'.$filename;
            }
            else{
                $same_day_header=$req->same_day_image;
            } 

            if($req->hasFile('guranteed_image')) {
                $file = $req->file('guranteed_image');
                $filename = 'header'.time().'.'.$req->guranteed_image->extension();
                $destinationPath = storage_path('../public/upload/header');
                $file->move($destinationPath, $filename);
                $guranteed_day_header = 'upload/header/'.$filename;
            }
            else{
                $guranteed_day_header=$req->guranteed_image;
            } 
            DB::table('header_contents')->where('id',$req->id)->update([
                'content' => $req->content,
                'same_day_image' => $same_day_header,
                'guranteed_image' => $guranteed_day_header,
            ]);
            return back()->with('msg','Content Edit Successfully');
             
        }

		public function viewReview(){
            $data['page_title'] = 'View Review';
            $data['review'] = DB::table('reviews')->orderBy('id','desc')->get(); 
            return view('admin/components/admin_view_review',$data);
        }



		 public function viewReplyReview(Request $req){
            $data['page_title'] = 'Reply Review';
         	$review_id = $req->review_id;            
         	
            $data['review'] = DB::table('reviews')->where('id',$review_id)->first(); 
            return view('admin/components/admin_view_reply_review',$data);
            
        }

		public function saveReplyReview(Request $req){
        		$review_id = $req->review_id;
        		$reply = $req->reply;
        		
        	 DB::table('reviews')->where('id', $review_id)->update(['reply' => $reply]); 
             return redirect('view-review')->with('msg','Review Added Successfully'); 
        }

        public function editReplyReview(Request $req){
            $data['page_title'] = 'Reply Review';
         	$review_id = $req->review_id;           
         	
            $data['review'] = DB::table('reviews')->where('id',$review_id)->first(); 
            return view('admin/components/admin_view_edit_review',$data);            
        }

        public function saveEditReview(Request $req){
            $review_id = $req->review_id;
            $reply = $req->reply;
            $user_review = $req->user_review;            
         DB::table('reviews')->where('id', $review_id)->update(['reply' => $reply, 'comment' => $user_review]); 
         return redirect('view-review')->with('msg','Review Added Successfully'); 
    }

    public function  deleteReview($review_id){ 
        $data['result']=DB::table('reviews')->where('id', $review_id)->delete();
        return redirect('view-review')->with('msg','Review Deleted Successfully');   
    }

        /**
         * Generate slug if slug column is empty
         */
        public function generateSlug($id){ 
            $product = Product::find($id);
            $rules = array(
                'slug' => 'unique:products,slug'
            );
            $slug       = str_slug($product->product_name,'-');
            $input      = array('slug' => $slug);
            $validate   = \Validator::make($input,$rules); 
            if($validate->passes()){
                $slug = $slug;
            }else{
                $slug = str_slug($product->product_name .' '.$product->products_id,'-');
            }
            $product->slug = $slug;
            $product->save();
            return $slug;
        }

        // View prescription 

        public function viewPrescription(){
            $data['page_title'] = 'View Prescription';
            $data['prescription'] = DB::table('prescriptions')->orderBy('id','desc')->get(); 
            return view('admin/components/admin_view_prescription',$data);
        }

        public function toggleprescriptionActiveStatus(Request $req, $status, $id, $user_id) { 
            
            DB::table('prescriptions')->where('id', $id)->update(['status' => $status]);
            $to = User::where('id',$user_id)->value('email');
            // $to ='dhananjay.sawant91@gmail.com';
            // dd($email);            
            $message = $req->message;
            // Mail::send('emails.approve', ['msg' => $message] , function($message) use ($email){ 
            //     $message->to($email)->subject('Prescription upload'); 
            //     $message->from('support@drhelpdesk.in','Drhelpdesk');
            // });
            if($status == 0){
            Mail::send('emails.approve', ['msg' => $message], function($message) use ($to) {
                $message->to($to)
                ->subject('Prescription Upload In DHD');
                $message->from('support@drhelpdesk.in','Drhelpdesk');
            }); 
        }
            // $data = array('name'=>"Virat Gandhi");
            // Mail::send(['text'=>'mail'], $data, function($message) use ($email){ 
            //     $message->to($email)->subject('Prescription upload');
            //        $message->from('dhananjay.sawant91@gmail.com','Drhelpdesk');
            //  });
        
            return back()->with('msg','Status Change Successfully');
        }
        
        /**
         * Get admin profile
         */
        public function adminProfile(){
            $data['page_title'] = 'Update Profile';
            $data['user'] = Auth::user();  
            return view('admin/components/profile/view',$data);
        }

        public function editProfile(Request $req){
            $user           = User::find($req->id);
            $user->name     = $req->name;
            $user->email    = $req->email;
            $user->phone    = $req->phone;
            if(isset($req->old_password) && isset($req->new_password)){
                if(Hash::check($req->old_password, $user->password) && $req->old_password != $req->new_password ){
                    $user->password = Hash::make($req->new_password);
                }
            }
            $user->save();
            return redirect()->back()->with('msg','Profile Updated');
        }

        public function export(Request $request) 
    {
        $orderData = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
            ->select('orders.*', 'users.*', 'order_status.*')
            ->get();
        // dd($orderData->count());       
        return Excel::download(new UsersExport($orderData), 'orders.xlsx');
        // return (new UsersExport)->download('orders.xlsx');
    }

    //new code rahul
    public function addshopmanager()
    {
        $data['page_title'] = 'Add Store Manager';  
        //new code 6/2/2021
            $data['shop_detail'] = DB::table('shop_infos')->get();
        //new  
        $data['shop_manager_list'] = DB::table('users')
        ->join('shop_infos', 'shop_infos.id', '=', 'users.shop_id') 
        ->select('users.name','users.id','shop_infos.shop_name','shop_infos.city')
        ->where('users.role','=',1)
        ->get();  
    // dd($data['shop_manager_list']);  
            return view('admin/components/add_shopmanager', $data);
    }

    public function add_shop_manager(Request $request)
    {
        $data['page_title'] = 'Add Store Manager';  
        return view('admin/components/add_shopmanager', $data);
    }
    public function add_shop()
    {
        $data['page_title'] = 'Add Store'; 
        $data['shop_list']=DB::table('shop_infos')->get(); 
        // dd($data['shop_list']);              
        return view('admin/components/add_shop', $data);
    } 
    public function submit_shop(Request $request)
    {
        // dd($request);
        $request->validate([
            'shop_name' => 'required',
            'contact_no' => 'required|numeric',
            'email' => 'email',
            'city' => 'required|alpha',
            'state' => 'required',
            'address' => 'required|max:255',
            'shop_logo' => 'image'            
            ]);

            $table = new shop_info;
            $table->shop_name =  $request->shop_name;
            $table->phone = $request->contact_no;
            $table->email = $request->email;
            $table->address = $request->address;
            $table->city = $request->city;
            $table->state = $request->state;
            $table->country = "India";
            $table->logo = $request->shop_logo;
            $table->save();      

                     
        return redirect('add_shop')->with('message','Store Added Successfully');
        
    } 
     //new code 
     
 //new code 6/2/2021
    public function submit_shop_manager(Request $req)
    {
    //    echo $value = $req->password;
    //      $pass = Hash::make($value);         
          $unique_phone =  User::where('phone', $req->phone_no)->orWhere('email', $req->email)->first();
        //   dd($unique_phone);
        if(!$unique_phone){
        $req->validate([
            'user_name'=>'required',
            'email'=>'required|email',
            'phone_no'=>'required|numeric',
            'city'=>'required|alpha'            
         ]);
         
            $data = new User;
            $data->name=$req->user_name;
            $data->email=$req->email;
            $data->phone=$req->phone_no;
            $data->password= Hash::make($req->password);
            $data->user_type= 7;           
            $data->shop_id=$req->shop_id;
            $data->role= 1;
        $result = $data->save();

        
        if($result)
        {
            $req->session()->flash('alert-success', 'Store Manager was Successfully Added!');
        }
        else
        {
            $req->session()->flash('alert-danger', 'Store Manager Not Added!');
        }           


        return back(); 
        }
        else{
            $req->session()->flash('alert-danger', 'Mobile Number Or Email Already Exists!');
            return back();
        }
    }

    // ===========================

    public function delete_shop($shop_id)
    {
        echo $shop_id;

    }

    public function get_shop_detail($shop_id)
    {        
        $data['shop_detail']=DB::table('shop_infos')->where('id',$shop_id)->first();
        $data['page_title'] = 'Edit Store Detail'; 
        // dd($data['shop_detail']);
        return view('admin/components/edit_shop_detail', $data);

    }
    public function update_shop_info(Request $req)
    {
        // dd($req);
        $req->validate([
            'shop_name' => 'required',
            'contact_no' => 'required|numeric',
            'email' => 'email',
            'city' => 'required|alpha',
            'state' => 'required',
            'address' => 'required|max:255'                  
            ]);

        $affected = DB::table('shop_infos')
            ->where('id',$req->shop_id)
            ->update(['shop_name' => $req->shop_name,'phone'=>$req->contact_no,'email'=>$req->email,'address' => $req->address,'city' => $req->city,'state' => $req->state]);    
        if($affected)
        {             
            $req->session()->flash('alert-success', 'Store Information Updated Successfully!!');             
        }
        else
        {
            $req->session()->flash('alert-danger', 'Store Information Not Updated!!');            
        }        
        
        return redirect(url('add_shop'));
    }


    public function add_stock()
    {
        $data['page_title'] = 'Add Stock'; 
        $data['shop_list']=DB::table('shop_infos')->get(); 
        $data['product'] = DB::table('products')->where('status',0)->get();
        $data['product_attributes'] = DB::table('product_attributes') ->select('product_attributes.*','sizes.size_name')->leftjoin('sizes','sizes.id', '=','product_attributes.product_size')->where('product_attributes.status',1)->get();
    //    dd($data['product_attributes']);
        $data['gst'] = DB::table('gst_tax')->get(); 
        $data['stock_list'] = DB::table('shop_stocks')
                                    ->select('shop_stocks.*','products.*','shop_infos.*','shop_stocks.id as stock_id')
                                    ->leftjoin('products','shop_stocks.products_id', '=','products.products_id')
                                    ->leftjoin('shop_infos','shop_stocks.shop_id', '=','shop_infos.id')
                                    // ->leftjoin('product_attributes','products.products_id', '=','product_attributes.products_id')
                                    ->orderBy('stock_id','desc')
                                    ->get();
        // dd($data['stock_list']);              
        return view('admin/components/add_stock', $data);
    } 

    public function Add_multiple_stock()
    {
        $data['page_title'] = 'Add Multiple Stock'; 
        $data['shop_list']=DB::table('shop_infos')->get(); 
        $data['product'] = DB::table('products')->where('status',0)->get();
        $data['product_attributes'] = DB::table('product_attributes') ->select('product_attributes.*','sizes.size_name')->leftjoin('sizes','sizes.id', '=','product_attributes.product_size')->where('product_attributes.status',1)->get();
    //    dd($data['product_attributes']);
        $data['gst'] = DB::table('gst_tax')->get(); 
        $data['stock_list'] = DB::table('shop_stocks')
                                    ->select('shop_stocks.*','products.*','shop_infos.*','shop_stocks.id as stock_id')
                                    ->leftjoin('products','shop_stocks.products_id', '=','products.products_id')
                                    ->leftjoin('shop_infos','shop_stocks.shop_id', '=','shop_infos.id')
                                    // ->leftjoin('product_attributes','products.products_id', '=','product_attributes.products_id')
                                    ->orderBy('stock_id','desc')
                                    ->get();
        // dd($data['stock_list']);              
        return view('admin/components/Add_multiple_stock', $data);
    }

    public function br_product_detail(Request $request)
    {
        $barcode  = $request->barcode;
        // dd($barcode);

        $product = DB::table('product_attributes')       
        ->join('products', 'product_attributes.products_id', '=', 'products.products_id')            
        ->select('product_attributes.*','products.*')
        ->where('product_attributes.barcode','=',$barcode)
        ->get(); 
        // dd($product);
       $producttest['data'] =  $product; 
   echo json_encode($producttest);
   exit; 

    }
    /*
        old foreach loop add stock code
    */
    // public function submit_stock(Request $request)
    // {
    //     // dd($request);
        
    //     $request->validate([
    //         'shop_id' => 'required',
    //         'product_name' => 'required'          
    //         ]);
    //         $shop_id = $request->shop_id;
    //         $i = 0;
    //          foreach($request->product_name as $row)
    //          {         
    //         //   $unique_barcode = Product::where('products_id', $request->product_name[$i])->first(); 
    //         //   dd($unique_barcode);                   
    //           $data = new shop_stock; 
    //           $data->products_id= $request->product_name[$i];
    //           $data->shop_id= $request->shop_id;
    //         //   $data->barcode= $unique_barcode->barcode;
    //           $data->input_quantity=$request->p_qty[$i];             
    //           $data->avl_quantity=$request->p_qty[$i];
    //           $data->expiry_date=$request->exp_date[$i]; 
    //         //   $data->tax=$request->tax[$i];

    //           /***** Barcode generate while add stock
    //            * 
    //            * 
    //           if($request->barcode[$i]){
    //             $data->barcode=$request->barcode[$i];
    //           }else{
    //             $seven_random_number = mt_rand(1000000, 9999999); 
    //             $barcode =  $shop_id.$seven_random_number; 
    //             $data->barcode=  $barcode;
    //           }   
    //             Barcode generate while add stock  
                
    //             *********/        
    //           $data->save(); 
    //           $i++;       
    //          }     
               
    //     return redirect('add_stock')->with('message','Stock Added Successfully');
        
    // } 

    public function submit_stock(Request $request)
    {
        // dd($request);
        
        $request->validate([
            'shop_id' => 'required',
            'product_name' => 'required'          
            ]);
            $shop_id = $request->shop_id;
                   
            //   $unique_barcode = Product::where('products_id', $request->product_name[$i])->first(); 
            //   dd($unique_barcode); 
            $check_duplicate_product = DB::table('shop_stocks')->where('attribute_id', $request->attribute_id)->first();                  
            // dd($check_duplicate_product);  
            if($check_duplicate_product){
                //   dd($check_duplicate_product);
                $availabel_qty = DB::table('shop_stocks')->where('attribute_id', $request->attribute_id)->pluck('avl_quantity')->first();
                $availabel_qty_new= $availabel_qty + $request->p_qty;
                // dd($availabel_qty_new);

                $update_stock = DB::table('shop_stocks')
            ->where('attribute_id',$request->attribute_id)
            ->update(['input_quantity' => $availabel_qty_new,'avl_quantity'=>$availabel_qty_new]);

            $data = new expiry_stock;
            $data->shop_stock_id=$check_duplicate_product->id;
            $data->p_id=$check_duplicate_product->products_id;
            $data->p_atrr_id=$check_duplicate_product->attribute_id;
            $data->input_Qty=$request->p_qty;
            $data->Expiry=$request->exp_date;
            $data->avl_Qty=$request->p_qty;
            $data->save(); 



            return redirect('add_stock')->with('message','Stock updated Successfully');


              }else{

                // dd($request);
                $data = new shop_stock; 
                $data->products_id= $request->product_name;
                $data->shop_id= $request->shop_id;
              //   $data->barcode= $unique_barcode->barcode;
                $data->input_quantity=$request->p_qty;  
                $data->attribute_id=$request->attribute_id;            
                $data->avl_quantity=$request->p_qty;
                $data->expiry_date=$request->exp_date; 
                $data->status=$request->status; 
  
              //   $data->tax=$request->tax[$i];
  
                /***** Barcode generate while add stock
                 * 
                 * 
                if($request->barcode[$i]){
                  $data->barcode=$request->barcode[$i];
                }else{
                  $seven_random_number = mt_rand(1000000, 9999999); 
                  $barcode =  $shop_id.$seven_random_number; 
                  $data->barcode=  $barcode;
                }   
                  Barcode generate while add stock  
                  
                  *********/        
                $data->save();  
                $data->id;
                // dd($data->id);
                $new_stock_id = $data->id;
                $new_expiry_stock_entry = DB::table('shop_stocks')->where('id', $new_stock_id)->first();
                // dd($new_expiry_stock_entry);
                $data = new expiry_stock;
            $data->shop_stock_id=$new_expiry_stock_entry->id;
            $data->p_id=$new_expiry_stock_entry->products_id;
            $data->p_atrr_id=$new_expiry_stock_entry->attribute_id;
            $data->input_Qty=$new_expiry_stock_entry->input_quantity;
            $data->Expiry=$new_expiry_stock_entry->expiry_date;
            $data->avl_Qty=$new_expiry_stock_entry->input_quantity;
            $data->save(); 
                  
                 
          return redirect('add_stock')->with('message','Stock Added Successfully');

              }
           
        
    } 

    public function submit_multiple_stock(Request $request){
        // dd($request);

        $request->validate([
            'shop_id' => 'required'        
            ]);

            $shop_id = $request->shop_id;
            $i = 0;
            foreach($request->product_name as $row){

               $check_duplicate_product = DB::table('shop_stocks')->where('attribute_id', $request->attribute_id[$i])->first();                  
            // dd($check_duplicate_product);  
            if($check_duplicate_product){
                //   dd($check_duplicate_product);
                $availabel_qty = DB::table('shop_stocks')->where('attribute_id', $request->attribute_id[$i])->pluck('avl_quantity')->first();
                $availabel_qty_new= $availabel_qty + $request->p_qty[$i];
                // dd($availabel_qty_new);

                $update_stock = DB::table('shop_stocks')
            ->where('attribute_id',$request->attribute_id[$i])
            ->update(['input_quantity' => $availabel_qty_new,'avl_quantity'=>$availabel_qty_new]);

            $data = new expiry_stock;
            $data->shop_stock_id=$check_duplicate_product->id;
            $data->p_id=$check_duplicate_product->products_id;
            $data->p_atrr_id=$check_duplicate_product->attribute_id;
            $data->input_Qty=$request->p_qty[$i];
            $data->Expiry=$request->exp_date[$i];
            $data->avl_Qty=$request->p_qty[$i];
            $data->save(); 



            // return redirect('add_stock')->with('message','Stock updated Successfully');


              }else{

                // dd($request);
                $data = new shop_stock; 
                $data->products_id= $request->products_id[$i];
                $data->shop_id= $request->shop_id;
              //   $data->barcode= $unique_barcode->barcode;
                $data->input_quantity=$request->p_qty[$i];  
                $data->attribute_id=$request->attribute_id[$i];            
                $data->avl_quantity=$request->p_qty[$i];
                $data->expiry_date=$request->exp_date[$i]; 
                $data->status=1; 
  
              //   $data->tax=$request->tax[$i];
  
                /***** Barcode generate while add stock
                 * 
                 * 
                if($request->barcode[$i]){
                  $data->barcode=$request->barcode[$i];
                }else{
                  $seven_random_number = mt_rand(1000000, 9999999); 
                  $barcode =  $shop_id.$seven_random_number; 
                  $data->barcode=  $barcode;
                }   
                  Barcode generate while add stock  
                  
                  *********/        
                $data->save();  
                $data->id;
                // dd($data->id);
                $new_stock_id = $data->id;
                $new_expiry_stock_entry = DB::table('shop_stocks')->where('id', $new_stock_id)->first();
                // dd($new_expiry_stock_entry);
                $data = new expiry_stock;
            $data->shop_stock_id=$new_expiry_stock_entry->id;
            $data->p_id=$new_expiry_stock_entry->products_id;
            $data->p_atrr_id=$new_expiry_stock_entry->attribute_id;
            $data->input_Qty=$new_expiry_stock_entry->input_quantity;
            $data->Expiry=$new_expiry_stock_entry->expiry_date;
            $data->avl_Qty=$new_expiry_stock_entry->input_quantity;
            $data->save(); 
                  
                 
        //   return redirect('add_stock')->with('message','Stock Added Successfully');

              }

                $i++;       
            }
            return redirect('add_multiple_stock')->with('message','Stock Added Successfully');
    }

    public function Increment_Tax()
    {
        $data['page_title'] = 'Increment Tax';  
       
        $data['increment_tax'] = DB::select("SELECT products.products_id,products.product_name,sizes.size_name,gst_tax.gst_value_percentage AS GST ,order_items.sub_total  AS Sell_Price,p_attr.manufacturer_price AS M_price,shop_stocks.input_quantity AS Quantity,SUM(order_items.quantity) AS Sell_QTY FROM order_items LEFT JOIN orders ON(orders.order_id=order_items.order_id)LEFT JOIN product_attributes p_attr ON (p_attr.id=order_items.prod_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)LEFT JOIN products ON(products.products_id=p_attr.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)LEFT JOIN shop_stocks ON(shop_stocks.shop_id=orders.shop_id) WHERE (orders.shop_id=101) GROUP BY(order_items.prod_id)"); 

    //  dd($data['increment_tax']);  
            return view('admin/components/increment_tax', $data);

    }
    public function Month_Increment_Tax(Request $req)
    {
        // dd($req->datepicker);
        // $month = date('m',$req->datepicker);
        if($req->datepicker)
        {
            $date = explode('-', $req->datepicker);
            $get_month = $date[0];
            $get_year = $date[1];
            $data['page_title'] = 'Increment Tax';  

            $data['increment_tax'] = DB::select("SELECT products.products_id,products.product_name,sizes.size_name,gst_tax.gst_value_percentage AS GST ,order_items.sub_total  AS Sell_Price,p_attr.manufacturer_price AS M_price,shop_stocks.input_quantity AS Quantity,SUM(order_items.quantity) AS Sell_QTY FROM order_items LEFT JOIN orders ON(orders.order_id=order_items.order_id)LEFT JOIN product_attributes p_attr ON (p_attr.id=order_items.prod_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)LEFT JOIN products ON(products.products_id=p_attr.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)LEFT JOIN shop_stocks ON(shop_stocks.shop_id=orders.shop_id) WHERE (orders.shop_id=101 AND YEAR(order_items.created_at) = $get_year AND MONTH(order_items.created_at) = $get_month) GROUP BY(order_items.prod_id)"); 

            return view('admin/components/increment_tax', $data);
        }
        else{
            return redirect(url('increment_tax'));
        }    



    }

    public function add_stock_manager(Request $request)
    {
       
        $data['page_title'] = 'Add Stock Manager';  
        
        $data['stock_manager_list'] = User::where('role','=',3)->get();  
    // dd($data['stock_manager_list']);  
            return view('admin/components/add_stock_manager', $data);
    }


    public function submit_stock_manager(Request $req)
    {
    //    echo $value = $req->password;
    //      $pass = Hash::make($value);         
          $unique_phone =  User::where('phone', $req->phone_no)->orWhere('email', $req->email)->first();
        //   dd($unique_phone);
        if(!$unique_phone){
        $req->validate([
            'user_name'=>'required',
            'email'=>'required|email',
            'phone_no'=>'required|numeric',
            'city'=>'required|alpha'            
         ]);
         
            $data = new User;
            $data->name=$req->user_name;
            $data->email=$req->email;
            $data->phone=$req->phone_no;
            $data->password= Hash::make($req->password);
            $data->user_type= 1;           
            // $data->shop_id=$req->shop_id;
            $data->role= 3;
        $result = $data->save();

        
        if($result)
        {
            $req->session()->flash('alert-success', 'Stock Manager was Successfully Added!');
        }
        else
        {
            $req->session()->flash('alert-danger', 'Stock Manager Not Added!');
        }           
        return back(); 
        }
        else{
            $req->session()->flash('alert-danger', 'Mobile Number Or Email Already Exists!');
            return back();
        }
    }


    public function delete_stock_manager($user_id)
    {
        // dd($user_id);
        $data['result']=User::where('id',$user_id)->delete();
        return back()->with('msg','Stock Manager Deleted Successfully');  

    }

    public function get_stock_manager_detail($user_id)
    {        
        $data['stock_manager']=User::where('id',$user_id)->first();
        $data['page_title'] = 'Edit Stock Manager'; 
        // dd($data['shop_detail']);
        return view('admin/components/edit_stock_manager', $data);

    }
    
    public function update_stock_manager(Request $req)
    {
        
        $req->validate([
            'user_name' => 'required',
            'phone_no' => 'required',
            'email' => 'email'                  
            ]);
            // dd($req);
        $affected = DB::table('users')
            ->where('id',$req->user_id)
            ->update(['name' => $req->user_name,'phone'=>$req->phone_no,'email'=>$req->email]);    
        if($affected)
        {             
            $req->session()->flash('alert-success', 'Store Manager Updated Successfully!!');             
        }
        else
        {
            $req->session()->flash('alert-danger', 'Store Manager Not Updated!!');            
        }        
        
        return redirect(url('add_stock_manager'));
    }

    public function  delete_shop_stock($stock_id){ 
        $data['result']=DB::table('shop_stocks')->where('id',$stock_id)->delete();
        return back()->with('msg','Delete Successfully');  
    }

    // new code

}