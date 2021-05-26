<?php

namespace App\Http\Controllers\admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;  
use App\User;
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\Blog;
use App\Product;
use App\ProductImage;
use App\Vendor; 
use App\Location; 
use App\Package; 
use App\Testimonial;  
use App\Brand;
use App\SocialIcon;  
use App\ShippingSetting;  
use App\VendorBrand;
use DB;
use App\Notification;
use App\LabLocation;
use App\Review;
use App\ProductAttribute;
use App\size;

class VendorController extends Controller
{
    // vendors function start  
        public function addVendors(){
        	$data['flag'] = 1; 
        	$data['page_title'] = 'Add Vendors'; 
        	$data['test'] = Brand::get(); 
        	 $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
        	return view('admin/webviews/admin_manage_vendor',$data);
        }

        public function viewVendors(){
        	$data['flag'] = 2; 
        	$data['page_title'] = 'View Vendors'; 
            $data['vendor'] = Vendor::orderBy('vendors_id','desc')->get(); 
        	return view('admin/webviews/admin_manage_vendor',$data);
        } 
        public function  deleteVendors($vendors_id){  
            $result = Vendor::where('vendors_id',$vendors_id)->first(); 
            User::where('id',$result->user_id)->delete(); 
            Vendor::where('vendors_id',$vendors_id)->delete(); 
            VendorBrand::where('vendor_id',$vendors_id)->delete(); 
            return back()->with('msg','Vendor Delete Successfully');  
        }

        public function editVendors($vendors_id){
        	$data['flag'] = 3; 
        	$data['page_title'] = 'Edit Vendors'; 
        	$data['test'] = Brand::get(); 
        	$data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
            $data['result'] = Vendor::where('vendors_id',$vendors_id)->first(); 
        	return view('admin/webviews/admin_manage_vendor',$data);
        }

        public function toggleVendorsActiveStatus($status, $vendors_id) { 
            Vendor::where('vendors_id', $vendors_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
		public function vendorsSubmit(Request $req){  
            if($req->vendors_id) { 
                $req->validate([
                    'vendor_name'=> 'required',    
                    'address'=> 'required',    
                    'city'=> 'required',    
                    'pin_code'=> 'required',    
                    'state'=> 'required',    
                    'email'=> 'required',    
                    'phone'=> 'required',    
                    'description'=> 'required'
                ]);  
                if($req->hasFile('logo')) {
                    $file = $req->file('logo');
                    $filename = 'vendor'.time().'.'.$req->logo->extension();
                    $destinationPath = storage_path('../public/upload/vendor');
                    $file->move($destinationPath, $filename);
                    $vendor = 'upload/vendor/'.$filename;
                }
                else{
                    $vendor=$req->logo;
                } 
                $address1 = $req->address.','.$req->city.','.$req->state; // Address
                // $apiKey = 'AIzaSyCkiuqHl7PnQjySEFTKBasVgT6oxQpsIeY'; // Google maps now requires an API key.
                // Get JSON results from this request
                $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM"; 
                $geo = file_get_contents($geo1);
                $geo = json_decode($geo, true); // Convert the JSON to an array 
                if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                    $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                    $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                }
            	$password = rand(111111, 999999); 
            	User::where('email',$req->email)->update([
                        'name' => $req->vendor_name,
                		'password' => bcrypt($password)
                ]);
                Vendor::where('vendors_id',$req->vendors_id)->update([
                    'vendor_name' => $req->vendor_name,  
                    'main_category' => implode(',', $req->main_category),  
                    'logo' => $vendor,
	                'address' => $req->address, 
	                'city' => $req->city, 
	                'pin_code' => $req->pin_code, 
	                'state' => $req->state,  
	                'email' => $req->email,
                	'vendor_password' => $password,
	                'mobile' => $req->phone, 
	                'landline' => $req->landline, 
	                'website_url' => $req->website_url, 
	                'description' => $req->description,
                    'latitude'=>$latitude,
                    'longitude'=>$longitude 
                    //   dd($req)
                ]);
            	
             	DB::table('vendor_brands')->where('vendor_id',$req->vendors_id)->delete(); 
            	$assign_priority = $req->assign_priority;
                $main_category = $req->main_category;
                $getcreditCount = count($main_category);
                for ($i = 0; $i < $getcreditCount; $i++) {
                    DB::table('vendor_brands')->insert(['vendor_id' => $req->vendors_id, 'brand' => $main_category[$i], 'assign_priority' => $assign_priority[$i] ]);
                }
            	$user = User::where('email',$req->email)->first();
                if ($req->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Dear ".$req->vendor_name.", \nYour Email-  ".$req->email."\n And Password is-  ".$password." \n\nThank You.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$req->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }  
                return back()->with('msg','Vendor Edit Successfully');
            }else{  
                $req->validate([
                    'vendor_name'=> 'required',    
                    'address'=> 'required',    
                    'city'=> 'required',    
                    'pin_code'=> 'required',    
                    'state'=> 'required',    
                    'email'=> 'required|unique:users',    
                    'phone'=> 'required|unique:users',   
                    'description'=> 'required',     
                    'logo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'      
                ]); 

                if($req->hasFile('logo')) {
                    $file = $req->file('logo');
                    $filename = 'vendor'.time().'.'.$req->logo->extension();
                    $destinationPath = storage_path('../public/upload/vendor');
                    $file->move($destinationPath, $filename);
                    $vendor = 'upload/vendor/'.$filename;
                } 

                $address1 = $req->address.','.$req->city.','.$req->state; // Address
                // $apiKey = 'AIzaSyCkiuqHl7PnQjySEFTKBasVgT6oxQpsIeY'; // Google maps now requires an API key.
                // Get JSON results from this request
                $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM"; 
                $geo = file_get_contents($geo1);
                $geo = json_decode($geo, true); // Convert the JSON to an array 
                if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                    $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                    $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                    //dd($latitude , $longitude);
                
                $reg = new User;
                $reg->name = $req->vendor_name;
                $reg->email = $req->email;
                $reg->phone = $req->phone; 
                $reg->user_type = 4; 
                $password = rand(111111, 999999);
                $reg->password = bcrypt($password);  
                $reg->save(); 

                $data = new Vendor();
                $data->user_id=$reg->id;
                $data->vendor_name = $req->vendor_name;  
                //$data->assign_priority = $req->assign_priority;  
                $data->main_category = implode(',', $req->main_category);     
                $data->logo  = $vendor;
                $data->address = $req->address; 
                $data->city = $req->city; 
                $data->pin_code = $req->pin_code; 
                $data->state = $req->state;  
                $data->email = $req->email; 
                $data->mobile = $req->phone; 
                $data->landline = $req->landline; 
                $data->website_url = $req->website_url; 
                $data->description = $req->description; 
                $data->vendor_password = $password; 
                $data->latitude = $latitude; 
                $data->longitude = $longitude;  
                $data->save(); 
                
                $main_category = $req->main_category;
                $assign_priority = $req->assign_priority;
                $getcreditCount = count($main_category);
                for ($i = 0; $i < $getcreditCount; $i++) {
                    DB::table('vendor_brands')->insert(['vendor_id' => $data->id, 'brand' => $main_category[$i], 'assign_priority' => $assign_priority[$i]]);
                }
                //dd($data);
                $user = User::where('email',$req->email)->first();
                if ($req->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Dear ".$req->vendor_name.", \nYour Email-  ".$req->email."\n And Password is-  ".$password." \n\nThank You.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$req->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }  
               
                $to_name = $data->vendor_name;
                $to_email = $data->email; 
                Mail::send('emails.vendor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });

                $admin = User::where('user_type',1)->first();
                $to_name1 = $admin->name;
                $to_email1 = $admin->email; 
                Mail::send('emails.vendor-reg', ['user' => $user], function($message) use ($to_name1, $to_email1) {
                    $message->to($to_email1, $to_name1)
                    ->subject('Registration In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });
                 
                }
                return back()->with('msg','Vendor Add Successfully');
            }
        } 
    // vendors function End 

    // Blogs function start
        public function addBlogs(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Blogs'; 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function viewBlogs(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Blogs'; 
            $data['blog'] = Blog::orderBy('blogs_id','desc')->get(); 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function  deleteBlogs($blogs_id){ 
            $data['result']=Blog::where('blogs_id',$blogs_id)->delete();
            return back()->with('msg','Blog Delete Successfully');  
        }

        public function editBlogs($blogs_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Blogs'; 
            $data['result'] = Blog::where('blogs_id',$blogs_id)->first(); 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function toggleBlogsActiveStatus($status, $blogs_id) { 
            Blog::where('blogs_id', $blogs_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        public function blogsSubmit(Request $req){ 
           
            if($req->blogs_id) { 
                $req->validate([
                    'blog_title'=> 'required',
                    //'blog_image' => 'image|mimes:jpeg,jpg,png,gif,svg' 
                ]);    
                if($req->hasFile('blog_image')) {
                    $file = $req->file('blog_image');
                    $filename = 'blog'.time().'.'.$req->blog_image->extension();
                    $destinationPath = storage_path('../public/upload/blog');
                    $file->move($destinationPath, $filename);
                    $blog = 'upload/blog/'.$filename;
                }
                else{
                    $blog=$req->blog_image;
                } 
               
                Blog::where('blogs_id',$req->blogs_id)->update([
                    'blog_title' => $req->blog_title,  
                    'blog_image' => $blog,
                	'offer_description' => $req->offer_description,
                    'blog_description' => $req->blog_description 
                ]);
                return back()->with('msg','Blog Edit Successfully');
            }else{  
                $req->validate([
                    'blog_title'=> 'required',   
                    'blog_image' => 'image|mimes:jpeg,jpg,png,gif,svg|required' ,
                	'offer_description'=> 'required' 
                ]); 

                if($req->hasFile('blog_image')) {
                    $file = $req->file('blog_image');
                    $filename = 'blog'.time().'.'.$req->blog_image->extension();
                    $destinationPath = storage_path('../public/upload/blog');
                    $file->move($destinationPath, $filename);
                    $blog = 'upload/blog/'.$filename;
                } 
                $data = new Blog();
                $data->blog_title = $req->blog_title;  
            	$data->offer_description = $req->offer_description;
                $data->blog_image  = $blog;
                $data->blog_description = $req->blog_description;  
                $data->save(); 
            	$title=$req->blog_title; 
                $message = $req->offer_description;
                $user = User::get(); 
                $notObj = new Notification();
                foreach ($user as $key => $value) {
                    $regId = $value->device_token;
                    $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json',$blog);
                } 
                
                $resdata = json_decode($response, true);
                return back()->with('msg','Blog Add Successfully');
            }
        } 
    // Blogs function end

    // product start   
        public function addProduct(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Product'; 
            $data['test'] = Brand::get();  
            $data['category'] = Category::where('category_name', '!=' , null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('category_name','asc')->get();   

            $data['sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get();    

            $data['sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['sub_sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',  '!=' , null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['vendor'] = Vendor::where('status',0)->orderBy('vendors_id','desc')->get();  

            $data['gst'] = DB::table('gst_tax')->orderBy('gst_value_percentage','asc')->get();

            return view('admin/webviews/admin_manage_product',$data);
        }

        public function viewProduct(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Product'; 
            // $data['product'] = Product::withoutGlobalScope('inStock')->orderBy('products_id','desc')->paginate(10);
            $data['product'] = Product::withoutGlobalScope('inStock')->orderBy('products_id','desc')->get();
            //dd($data['product']);
            return view('admin/webviews/admin_manage_product',$data);
        }

        // View product attributes
        public function viewProductattribute($products_id){
            // dd($products_id);
            $data['flag'] = 5; 
            $data['products_id'] = $products_id;
            $data['page_title'] = 'View Product Attributes';             
            $data['product'] = DB::table('product_attributes')
            ->join('products', 'product_attributes.products_id', '=', 'products.products_id')                      
           ->select('products.*', 'product_attributes.*')
           ->where('product_attributes.products_id','=',$products_id)
           ->get(); 
            // dd($data['product']);
            return view('admin/webviews/admin_manage_product',$data);
        }

        //Add product attributes   
        public function addProductattribute($products_id){
            $data['flag'] = 6; 
            $data['page_title'] = 'Add Product Attributes'; 
            $data['product'] = Product::where('products_id','=',$products_id)->orderBy('products_id','desc')->first(); 
            $data['size'] = DB::table('sizes')->orderBy('id','desc')->get();
            return view('admin/webviews/admin_manage_product',$data);
        }

        // Save product attributes
        public function productattributeSubmit(Request $req){        	
            // dd($req);
            $reg = new ProductAttribute;
            //$reg->user_id = Auth::id();
            $reg->products_id = $req->products_id;       
            $reg->product_size = $req->product_size;
            $reg->per_stript_qty = $req->per_stript_qty;

            if($req->special_price){
            $price_per_pic = round(($req->special_price /$req->per_stript_qty), 3);
            }else{
                $price_per_pic = round(($req->price /$req->per_stript_qty), 3);
            }
        
            
            
            if($req->color == 0){
                $reg->product_color = null;
            }else{
                $reg->product_color = $req->product_color;
            }

            // dd($req->barcode);
            if(!$req->barcode){
                $barcode = mt_rand(1000000000, 9999999999);
                $req->barcode=  $barcode;
            }
            // dd($req->barcode);

             $unique_barcode = ProductAttribute::where('barcode',$req->barcode)->first();
                // dd($unique_barcode);
                // if(!$unique_barcode){
                //     $barcode = mt_rand(1000000000, 9999999999);
                //     $reg->barcode=  $barcode;
                // }else{
                //     $reg->barcode = $req->barcode;
                // }
                // if($unique_barcode== null){
                //     $reg->barcode = $req->barcode;
                //   }else{
                   
                //   } 
            
                if(!$unique_barcode){
                    $reg->barcode = $req->barcode;
                    $reg->manufacturer_price = $req->manufacturer_price;
                    $reg->incremental_gst = $req->incremental_gst;
                    $reg->price_per_pic = $price_per_pic;
                    $reg->price = $req->price;
                    $reg->multiple_attribute = $req->multiple_attribute;
                    $reg->special_price = $req->special_price;
                    $reg->extra_discount = $req->extra_discount;
                    $reg->quantity = $req->quantity;
                    $reg->status = $req->status;
                    $reg->in_stock = $req->in_stock;
                    $reg->save();   
                    $message= "Attribute Added successfully";
                }
                else{
                    $message= "Barcode Allready Exists Try Again";
                }  	
        	return back()->with('msg',$message); 
        }


        public function editProductattribute($id, $products_id){
            $data['flag'] = 7; 
            $data['page_title'] = 'Edit Product Attributes'; 
            $data['product'] = Product::where('products_id','=',$products_id)->orderBy('products_id','desc')->first(); 
            $data['size'] = DB::table('sizes')->orderBy('id','desc')->get();
            $data['result'] = ProductAttribute::where('id',$id)->first();

            return view('admin/webviews/admin_manage_product',$data);
        }

        public function productattributeupdate(Request $req){    
            //dd($req->all());
            if($req->special_price){
                $price_per_pic = round(($req->special_price /$req->per_stript_qty), 3);
                }else{
                    $price_per_pic = round(($req->price /$req->per_stript_qty), 3);
                }
           
                $req->validate([
                    'price'=> 'required'   
                ]);
            	
                ProductAttribute::where('id',$req->id)->update([
                    'product_size' =>  $req->product_size,  
                    'per_stript_qty' =>  $req->per_stript_qty,
                    'price_per_pic' =>  $price_per_pic,   
                    'product_color' =>  $req->product_color,                     
                    'barcode' =>  $req->barcode,
                    'manufacturer_price' =>  $req->manufacturer_price,  
                    'price' =>  $req->price,
                    'multiple_attribute' =>  $req->multiple_attribute,                  
                    'special_price' =>  $req->special_price, 
                    'extra_discount' =>  $req->extra_discount,
                    'quantity' =>  $req->quantity, 
                    'manufacturer_price' =>  $req->manufacturer_price,
                    'status' =>  $req->status, 
                    'in_stock' =>  $req->in_stock                    
                ]); 
                return back()->with('msg','Attribute Edit Successfully');
            }
           
        

        public function toggleProduct_attr_ActiveStatus($status, $id) { 
            dd($status);
            ProductAttribute::where('id', $id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }  
		public function  deleteProductattribute($id){ 
            $data['result']=ProductAttribute::where('id',$id)->delete();
            return back()->with('msg','Attribute Deleted Successfully');  
        }



    /**
     * size add 
     * 
     */
     public function size_list(){
        $data['flag'] = 2; 
        $data['page_title'] = 'Size List';
        $data['size'] = DB::table('sizes')->orderBy('id','desc')->get();  
        return view('admin/webviews/admin_manage_settings',$data); 
     } 

     public function add_size(){
        $data['flag'] = 3; 
        $data['page_title'] = 'Add Size';          
        return view('admin/webviews/admin_manage_settings',$data); 
     } 
          
     public function save_size(Request $req){
        //  dd($req);
        $reg = new size;
        //$reg->user_id = Auth::id();
        $reg->size_name = $req->size_name;       
        $reg->status = $req->status;        
        $reg->save();        	
        return back()->with('msg','Size Added successfully');
     }
     
     public function edit_size($id){
        $data['flag'] = 4; 
        $data['page_title'] = 'Edit Size';         
        $data['size'] = DB::table('sizes')->where('id','=',$id)->first();       
        return view('admin/webviews/admin_manage_settings',$data);
        }

     public function update_size(Request $req){
        //dd($req->all());       
            $req->validate([
                'size_name'=> 'required' 
            ]);
            
            size::where('id',$req->id)->update([
                'size_name' =>  $req->size_name,   
                'status' =>  $req->status                                  
            ]); 
            return back()->with('msg','Size Edit Successfully');
        }

        public function  delete_size($id){ 
            $data['result']=size::where('id',$id)->delete();
            return back()->with('msg','Size Deleted Successfully');  
        }
        

		public function viewProductReview(){
            $data['flag'] = 4; 
            $data['page_title'] = 'Add Product Review'; 
            $data['product'] = Product::orderBy('products_id','desc')->get();
        	$data['package'] = Package::orderBy('id','desc')->get();
           // dd($data['package'][0]);
            return view('admin/webviews/admin_manage_product',$data);
        }

		public function saveProductReview(Request $req){
        	
            $reg = new Review;
            //$reg->user_id = Auth::id();
            $reg->user_name = $req->user_name;
        	if($req->type=='1'){
            	$reg->product_id = $req->product_id;
            } else if($req->type=='2'){
            	$reg->product_id = $req->package_id;
            }
        	
            $reg->email = $req->email;
            $reg->comment = $req->comment;
            $reg->rating = $req->rating;
            $reg->type = $req->type;
            $reg->save();
        	
        	return back()->with('msg','Review Added successfully');  
        }

        public function  deleteProduct($products_id){ 
            $data['result']=Product::where('products_id',$products_id)->delete();
            return back()->with('msg','Product Delete Successfully');  
        }
        public function inStock($id){
            $product = Product::withoutGlobalScope('inStock')->find($id);
            $inStock = $product->in_stock;
            if($inStock){
                $product->in_stock = 0;
                $product->save();
                return [
                    'status' => 200,
                    'flag' => 0,
                    'meg' => 'Product updated, product is out of stock now.'
                ];
            }else{
                $product->in_stock = 1;
                $product->save();
                return [
                    'status' => 200,
                    'flag' => 1,
                    'meg' => 'Product updated, product is in-stock now.'
                ];
            }
        }

        public function editProduct($products_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Product'; 
             $data['test'] = Brand::get();
            $data['category'] = Category::where('category_name', '!=' , null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('category_name','asc')->get();   

            $data['sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get();    

            $data['sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['sub_sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',  '!=' , null)->where('status',0)->orderBy('sub_category_name','asc')->get();
            $data['gst'] = DB::table('gst_tax')->get();
            $data['vendor'] = Vendor::where('status',0)->orderBy('vendors_id','desc')->get();
            $data['result'] = Product::withoutGlobalScope('inStock')->where('products_id',$products_id)->first(); 
            return view('admin/webviews/admin_manage_product',$data);
        }

        public function toggleProductActiveStatus($status, $products_id) { 
            Product::where('products_id', $products_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }  
		public function  deleteProductImages($products_id){ 
            $data['result']=ProductImage::where('product_images_id',$products_id)->delete();
            return back()->with('msg','Image Delete Successfully');  
        }
        public function productSubmit(Request $req){    
            // dd($req->all());
            $count = 1; 
            if($req->products_id){ 
                $req->validate([
                    'product_name'=> 'required',
                    'product_code'=> 'required',         
                    'categories'=> 'required' 
                ]);
            	 if($req->prescription == 1){
                    $prescription = 1; 
                }else{
                   $prescription = 0; 

                }
                Product::where('products_id',$req->products_id)->update([
                    'product_name' =>  $req->product_name,   
                    'slug' =>  $req->slug,
                    // 'price' =>  $req->price, 
                    // 'quantity' =>  $req->quantity, 
                    // 'special_price' =>  $req->special_price, 
                    // 'extra_discount' =>  $req->extra_discount, 
                    'gst_id' =>  $req->gst_id,
                    'manufacturer' =>  $req->manufacturer,
                    'key_features' =>  $req->key_features, 
                    'short_description' =>  $req->short_description, 
                    'long_description' =>  $req->long_description,  
                	'app_long_description' =>  $req->app_long_description,  
                    'app_key_features' =>  $req->app_key_features,  
                    'brand' =>   $req->brand,
                	'prescription' => $prescription,  
                    'tags' =>   $req->tags,  
                    'categories' =>  $req->categories, 
                    'sub_categories' =>  $req->sub_categories, 
                    'sub_sub_categories' =>  $req->sub_sub_categories, 
                    'sub_sub_sub_categories'=> $req->sub_sub_sub_categories, 
                    'product_code'=> $req->product_code,  
                     'featured_product' => $req->featured_product,
                    'top_selling_product' => $req->top_selling_product,
                    'vendor_id' =>  $req->vendor_id,
                    'gst_id' =>  $req->gst_id 
                ]); 

                if($req->hasFile('product_image_one')) {
                    $file = $req->file('product_image_one');
                    $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product = 'upload/product/'.$filename;

                    ProductImage::where('product_images_id',$req->product_images_id)->update([
                        'product_image' => $product 
                    ]); 
                }  
            
            	if($req->product_images_id1 != null){
                    if($req->hasFile('product_image_two')) {
                        $file = $req->file('product_image_two');
                        $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product1 = 'upload/product/'.$filename;

                        ProductImage::where('product_images_id',$req->product_images_id1)->update([
                            'product_image' => $product1
                        ]); 
                    }  
                }else{
                    if($req->hasFile('product_image_two')) {
                        $file = $req->file('product_image_two');
                        $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product1 = 'upload/product/'.$filename;

                        $data2 = new ProductImage();
                        $data2->products_id = $req->products_id;  
                        $data2->product_image  = $product1; 
                        $data2->type  = 1; 
                        $data2->save();
                    } 
                }

                if($req->product_images_id2 != null){
                    if($req->hasFile('product_image_three')) {
                        $file = $req->file('product_image_three');
                        $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product2 = 'upload/product/'.$filename;

                        ProductImage::where('product_images_id',$req->product_images_id2)->update([
                            'product_image' => $product2 
                        ]); 
                    }  
                }else{
                    if($req->hasFile('product_image_three')) {
                        $file = $req->file('product_image_three');
                        $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product2 = 'upload/product/'.$filename;

                        $data2 = new ProductImage();
                        $data2->products_id = $req->products_id;  
                        $data2->product_image  = $product2; 
                        $data2->type  = 1; 
                        $data2->save();
                    } 
                }

                if($req->product_images_id3 != null){
                    if($req->hasFile('product_image_four')) {
                        $file = $req->file('product_image_four');
                        $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product3 = 'upload/product/'.$filename;

                        ProductImage::where('product_images_id',$req->product_images_id3)->update([
                            'product_image' => $product3 
                        ]); 
                    }  
                }else{
                    if($req->hasFile('product_image_four')) {
                        $file = $req->file('product_image_four');
                        $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
                        $destinationPath = storage_path('../public/upload/product');
                        $file->move($destinationPath, $filename);
                        $product3 = 'upload/product/'.$filename;

                        $data2 = new ProductImage();
                        $data2->products_id = $req->products_id;  
                        $data2->product_image  = $product3; 
                        $data2->type  = 1; 
                        $data2->save();
                    } 
                }
                
                //dd($req->all());

//                 if($req->hasfile('product_image_two')) {         
//                     $file = $req->product_image_two;
//                     $file_count= count($file);                
//                     for ($i=0; $i < $file_count; $i++) {  
//                         if(is_object($file[$i])){ 
//                             $imagesize  = $file[$i]->getClientSize(); 
//                             $imageexten = $file[$i]->getClientOriginalExtension();
//                             $name = $file[$i]->getClientOriginalName(); 
//                             $new_name = 'product_two'.time().$count++.'.'.$name; 
//                             $destinationPath = storage_path('../public/upload/product');
//                             $file[$i]->move($destinationPath, $new_name);
//                             $product_image_path ='upload/product/'.$new_name;
//                             ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
//                                 'product_image' => $product_image_path 
//                             ]); 
//                         }else{
//                             $product_image_path = $file[$i];      
//                             ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
//                                 'product_image' => $product_image_path
                               
//                             ]);  
//                         } 
//                     }  
//                 } 
                return back()->with('msg','Product Edit Successfully');
            }else{  
                $req->validate([
                    'product_name'=> 'required',
                    'product_code'=> 'required',         
                    'categories'=> 'required'     
                    // 'product_image_one' => 'mimes:jpeg,jpg,png,gif,svg|max:2048|required'  
                ]); 
            	if($req->prescription == 1){
                    $prescription = 1; 
                }else{
                   $prescription = 0; 

                }
                $role = null;
                $data = new Product();
                $data->product_name = $req->product_name;
                // $data->price = $req->price; 
                // $data->special_price = $req->special_price;

                // $unique_barcode = Product::where('barcode',$req->barcode)->first();
                // dd($unique_barcode);
                // if($unique_barcode== null){
                //     $data->barcode=$req->barcode;
                //   }else{
                //     $barcode = mt_rand(1000000000, 9999999999);
                //     $data->barcode=  $barcode;
                //   } 
                $data->manufacturer = $req->manufacturer; 
                // $data->extra_discount = $req->extra_discount; 
                $data->key_features = $req->key_features; 
                $data->short_description = $req->short_description; 
                $data->prescription = $prescription; 
                $data->long_description = $req->long_description;  
            	$data->app_long_description = $req->app_long_description;  
                $data->app_key_features = $req->app_key_features;  
                $data->brand =  $req->brand;  
                $data->tags =  $req->tags;  
                $data->categories = $req->categories; 
                $data->sub_categories = $req->sub_categories; 
                $data->sub_sub_categories = $req->sub_sub_categories; 
                $data->sub_sub_sub_categories = $req->sub_sub_sub_categories; 
                $data->product_code = $req->product_code; 
                // $data->quantity = $req->quantity; 
                if($req->featured_product != null){
                    $data->featured_product = $req->featured_product; 
                }else{
                    $data->featured_product = $role;
                }
                if($req->top_selling_product != null){
                    $data->top_selling_product = $req->top_selling_product; 
                }else{
                    $data->top_selling_product = $role;
                } 
                $data->vendor_id = $req->vendor_id;
                $data->gst_id =  $req->gst_id;
                 
                $data->save();
                $products_id = $data->products_id; 
                // dd($products_id);
                $this->generateSlug($data->products_id);
                // dd($data->products_id);  
                $new_product_id = $data->products_id;
                
            	if($req->hasFile('product_image_one')) {
                    $file = $req->file('product_image_one');
                    $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product = 'upload/product/'.$filename;

                    $data1 = new ProductImage();
                    $data1->products_id = $new_product_id; 
                    $data1->product_image  = $product; 
                    $data1->type  = 2; 
                    $data1->save(); 
                } 
                if($req->hasFile('product_image_two')) {
                    $file = $req->file('product_image_two');
                    $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product1 = 'upload/product/'.$filename;

                    $data2 = new ProductImage();
                    $data2->products_id = $new_product_id;  
                    $data2->product_image  = $product1; 
                    $data1->type  = 1; 
                    $data2->save();
                } 
                if($req->hasFile('product_image_three')) {
                    $file = $req->file('product_image_three');
                    $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product2 = 'upload/product/'.$filename;

                    $data3 = new ProductImage();
                    $data3->products_id = $new_product_id; 
                    $data3->product_image  = $product2; 
                    $data1->type  = 1; 
                    $data3->save(); 
                } 

                if($req->hasFile('product_image_four')) {
                    $file = $req->file('product_image_four');
                    $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product3 = 'upload/product/'.$filename;

                    $data4 = new ProductImage();
                    $data4->products_id = $new_product_id;  
                    $data4->product_image  = $product3; 
                    $data1->type  = 1;  
                    $data4->save(); 
                } 
//                 if($req->hasFile('product_image_one')) {
//                     $file = $req->file('product_image_one');
//                     $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
//                     $destinationPath = storage_path('../public/upload/product');
//                     $file->move($destinationPath, $filename);
//                     $product = 'upload/product/'.$filename;
//                 } 
//                 if($req->hasFile('product_image_two')) {
//                     $file = $req->file('product_image_two');
//                     $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
//                     $destinationPath = storage_path('../public/upload/product');
//                     $file->move($destinationPath, $filename);
//                     $product1 = 'upload/product/'.$filename;
//                 } 
//                 if($req->hasFile('product_image_three')) {
//                     $file = $req->file('product_image_three');
//                     $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
//                     $destinationPath = storage_path('../public/upload/product');
//                     $file->move($destinationPath, $filename);
//                     $product2 = 'upload/product/'.$filename;
//                 } 

//                 if($req->hasFile('product_image_four')) {
//                     $file = $req->file('product_image_four');
//                     $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
//                     $destinationPath = storage_path('../public/upload/product');
//                     $file->move($destinationPath, $filename);
//                     $product3 = 'upload/product/'.$filename;
//                 } 

//                 $data1 = new ProductImage();
//                 $data1->products_id = $data->id; 
//                 $data1->product_image  = $product; 
//                 $data1->type  = 2; 
//                 $data1->save(); 

//                 $data2 = new ProductImage();
//                 $data2->products_id = $data->id;  
//                 $data2->product_image  = $product1; 
//                 $data1->type  = 1; 
//                 $data2->save();

//                 $data3 = new ProductImage();
//                 $data3->products_id = $data->id;  
//                 $data3->product_image  = $product2; 
//                 $data1->type  = 1; 
//                 $data3->save(); 

//                 $data4 = new ProductImage();
//                 $data4->products_id = $data->id;  
//                 $data4->product_image  = $product3; 
//                 $data1->type  = 1;  
//                 $data4->save(); 
            	
//             	if($req->featured_product != null){
//                     $title = 'Hot Product'; 
//                     $message = $req->product_name;
//                     $user = User::get(); 
//                     $notObj = new Notification();
//                     foreach ($user as $key => $value) {
//                         $regId = $value->device_token;
//                         $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json',$product);
//                     } 
                    
//                     $resdata = json_decode($response, true);
//                 }
//                 if($req->top_selling_product != null){
//                     $title = 'New Product'; 
//                     $message = $req->product_name;
//                     $user = User::get(); 
//                     $notObj = new Notification();
//                     foreach ($user as $key => $value) {
//                         $regId = $value->device_token;
//                         $response = $notObj->sendNotification($title, $message, $regId, $device_type='1', $contentType='application/json',$product);
//                     } 
                    
//                     $resdata = json_decode($response, true);
//                 }
                // return back()->with('msg','Product Add Successfully'); 
                
                return redirect('add-product-attributes/'.$products_id)->with('msg','Product Add Successfully');
            }
        } 
    // product end

    // location start  
        public function addLocation(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Location'; 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function viewLocation(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Location'; 
            $data['category'] = Location::orderBy('locations_id','desc')->get(); 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function  deleteLocation($locations_id){ 
            $data['result']=Location::where('locations_id',$locations_id)->delete();
            return back()->with('msg','Location Delete Successfully');  
        }

        public function editLocation($locations_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Location'; 
            $data['result'] = Location::where('locations_id',$locations_id)->first(); 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function toggleLocationActiveStatus($status, $locations_id) { 
            Location::where('locations_id', $locations_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function locationSubmit(Request $req){ 
            $req->validate([
                'location_name'=> 'required',  
                'location_code'=> 'required'  
            ]); 
            if($req->locations_id) { 
                Location::where('locations_id',$req->locations_id)->update([
                    'location_name' => $req->location_name, 
                    'location_code' => $req->location_code, 
                ]);
                return back()->with('msg','Location Edit  Successfully');
            }else{ 
                $data = new Location();
                $data->location_name = $req->location_name; 
                $data->location_code = $req->location_code; 
                $data->save(); 
                return back()->with('msg','Location Add  Successfully');
            }
        } 
    // Location End

    // Testimonial function start
        public function addTestimonial(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Testimonial'; 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function viewTestimonial(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Testimonial'; 
            $data['testimonial'] = Testimonial::orderBy('testimonials_id','desc')->get(); 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function  deleteTestimonial($testimonials_id){ 
            $data['result']=Testimonial::where('testimonials_id',$testimonials_id)->delete();
            return back()->with('msg','Testimonial Delete Successfully');  
        }

        public function editTestimonial($testimonials_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Testimonial'; 
            $data['result'] = Testimonial::where('testimonials_id',$testimonials_id)->first(); 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function toggleTestimonialActiveStatus($status, $testimonials_id) { 
            Testimonial::where('testimonials_id', $testimonials_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        public function testimonialSubmit(Request $req){ 
          
            if($req->testimonials_id) { 
                $req->validate([
                    'name'=> 'required',
                    'position'=> 'required',
                    'description'=> 'required',
                    'rating'=> 'required',
                   // 'image' => 'mimes:jpeg,jpg,png' 
                ]);
                
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'testimonial'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/testimonial');
                    $file->move($destinationPath, $filename);
                    $testimonial = 'upload/testimonial/'.$filename;
                }
                else{
                    $testimonial=$req->image;
                } 
                Testimonial::where('testimonials_id',$req->testimonials_id)->update([
                    'name' => $req->name,  
                    'position' => $req->position,  
                    'description' => $req->description,  
                    'rating' => $req->rating,  
                    'image' => $testimonial 
                ]);
                return back()->with('msg','Testimonial Edit Successfully');
            }else{  
                $req->validate([
                    'name'=> 'required',
                    'position'=> 'required',
                    'description'=> 'required',
                    'rating'=> 'required',
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'testimonial'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/testimonial');
                    $file->move($destinationPath, $filename);
                    $testimonial = 'upload/testimonial/'.$filename;
                } 
                $data = new Testimonial();
                $data->name = $req->name; 
                $data->position = $req->position; 
                $data->description = $req->description; 
                $data->rating = $req->rating; 
                $data->image =  $testimonial;   
                $data->save(); 
                return back()->with('msg','Testimonial Add Successfully');
            }
        } 
    // Testimonial function end

    //package function start
        public function addPackages(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Packages'; 
            $data['test'] = Category::where('categories_id',15)->first();  
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function viewPackages(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Packages'; 
            $data['vendor'] = Package::orderBy('id','desc')->get(); 
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function  deletePackages($id){ 
            $data['result']=Package::where('id',$id)->delete();
            return back()->with('msg','Package Delete Successfully');  
        }

        public function editPackages($id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Packages'; 
            $data['test'] = Category::where('categories_id',15)->first();   
            $data['result'] = Package::where('id',$id)->first(); 
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function togglePackagesActiveStatus($status, $id) { 
            Package::where('id', $id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
        public function popularPackageCreate($status, $id) { 
            Package::where('id', $id)->update(['package_type' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }
		//public function packagesSubmit(Request $req){  
//             if($req->id) { 
//                 $req->validate([
//                     'package_name'=> 'required',    
//                     'package_cost'=> 'required',    
//                     'offer_discount'=> 'required', 
//                     'type'=> 'required', 
//                     'short_disc'=> 'required', 
//                     'long_disc'=> 'required' 
//                 ]);  
//                 if($req->hasFile('image')) {
//                     $file = $req->file('image');
//                     $filename = 'package'.time().'.'.$req->image->extension();
//                     $destinationPath = storage_path('../public/upload/package');
//                     $file->move($destinationPath, $filename);
//                     $package = 'upload/package/'.$filename;
//                 }
//                 else{
//                     $package=$req->image;
//                 } 
//                 Package::where('id',$req->id)->update([
//                     'package_name' => $req->package_name,  
//                     'image' => $package,
//                     'package' => implode(',', $req->package), 
//                     'package_cost' => $req->package_cost, 
//                     'offer_discount' => $req->offer_discount,
//                      'type' => $req->type,
//                      'short_disc' => $req->short_disc,
//                      'long_disc' => $req->long_disc
//                     //   dd($req)
//                 ]);
//                 return back()->with('msg','Package Edit Successfully');
//             }else{  
//                 $req->validate([
//                     'package_name'=> 'required',    
//                     'package_cost'=> 'required',    
//                     'offer_discount'=> 'required',
//                      'short_disc'=> 'required', 
//                     'long_disc'=> 'required', 
//                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'    
//                 ]); 

//                 if($req->hasFile('image')) {
//                     $file = $req->file('image');
//                     $filename = 'package'.time().'.'.$req->image->extension();
//                     $destinationPath = storage_path('../public/upload/package');
//                     $file->move($destinationPath, $filename);
//                     $package = 'upload/package/'.$filename;
//                 } 
//                 $data = new Package();
//                 $data->package_name = $req->package_name;
//                 $data->image = $package;
//                 $data->package = implode(',', $req->package); 
//                 $data->package_cost = $req->package_cost; 
//                 $data->offer_discount = $req->offer_discount; 
//                 $data->type = $req->type; 
//                 $data->long_disc = $req->long_disc; 
//                 $data->short_disc = $req->short_disc; 
               
//                 $data->save();
//                 return back()->with('msg','Package Add Successfully');
//             }
//         } 
		 public function packagesSubmit(Request $req){  
            if($req->id) { 
                $req->validate([
                    'package_name'=> 'required',    
                    'package_cost'=> 'required',  
                    'type'=> 'required', 
                    'short_disc'=> 'required', 
                    'long_disc'=> 'required' 
                ]);  
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'package'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/package');
                    $file->move($destinationPath, $filename);
                    $package = 'upload/package/'.$filename;
                }
                else{
                    $package=$req->image;
                } 
                Package::where('id',$req->id)->update([
                    'package_name' => $req->package_name,  
                    'image' => $package,
                    'package' => implode(',', $req->package), 
                    'package_cost' => $req->package_cost,
                    'special_price' =>  $req->special_price,  
                    'offer_discount' => $req->offer_discount,
                    'type' => $req->type,
                    'short_disc' => $req->short_disc,
                    'long_disc' => $req->long_disc,
                    'key_features' =>  $req->key_features, 
                    //   dd($req)
                ]);
                return back()->with('msg','Package Edit Successfully');
            }else{  
                $req->validate([
                    'package_name'=> 'required',    
                    'package_cost'=> 'required',    
                    'short_disc'=> 'required', 
                    'long_disc'=> 'required', 
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'    
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'package'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/package');
                    $file->move($destinationPath, $filename);
                    $package = 'upload/package/'.$filename;
                } 
                $data = new Package();
                $data->package_name = $req->package_name;
                $data->image = $package;
                $data->package = implode(',', $req->package); 
                $data->package_cost = $req->package_cost; 
                $data->special_price = $req->special_price; 
                $data->offer_discount = $req->offer_discount; 
                $data->type = $req->type; 
                $data->long_disc = $req->long_disc; 
                $data->short_disc = $req->short_disc; 
                $data->key_features = $req->key_features; 
                $data->save();
                return back()->with('msg','Package Add Successfully');
            }
        } 
    //package function end
    
   // brand start  
        public function addBrand(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Brand';
            $data['category'] = Category::where('parent_id', null)->where('sub_parent_id', null)->where('sub_sub_parent_id', null)->where('type', 0)->orwhere('type', 2)->orwhere('type', 3)->where('status', 0)->orderBy('categories_id', 'asc')->get(); 
            return view('admin/webviews/admin_manage_brand',$data);
        }

        public function viewBrand(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Brand'; 
            $data['brand'] = Brand::orderBy('id','desc')->get(); 
            return view('admin/webviews/admin_manage_brand',$data);
        }

         public function  deleteBrand($id){ 
            Brand::where('id',$id)->delete();  
            DB::table('brand_categories')->where('brand_id',$id)->delete();  
            return back()->with('msg','Brand Delete Successfully');  
        }

        public function editBrand($id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Brand';
            $data['category'] = Category::where('parent_id', null)->where('sub_parent_id', null)->where('sub_sub_parent_id', null)->where('type', 0)->orwhere('type', 2)->orwhere('type', 3)->where('status', 0)->orderBy('categories_id', 'asc')->get(); 
            $data['result'] = Brand::where('id',$id)->first(); 
            return view('admin/webviews/admin_manage_brand',$data);
        }

        public function toggleBrandActiveStatus($status, $id) { 
            Brand::where('id', $id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function BrandSubmit(Request $req){ 
            $req->validate([
                'brand_name'=> 'required'  
            ]); 
            if($req->id) { 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'brand'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/brand');
                    $file->move($destinationPath, $filename);
                    $brand = 'upload/brand/'.$filename;
                }
                else{
                    $brand=$req->image;
                } 
                Brand::where('id',$req->id)->update([
                    'brand_name' => $req->brand_name,
                    'image' => $brand,
                	'back_color'=>$req->back_color,
                	'title' => $req->title,
                    //'parent_id' => implode(',', $req->parent_id)
                ]);
                DB::table('brand_categories')->where('brand_id',$req->id)->delete();  
                $main_category = $req->parent_id;
                $getcreditCount = count($main_category);
                for ($i = 0; $i < $getcreditCount; $i++) {
                    DB::table('brand_categories')->insert(['brand_id' => $req->id, 'category_id' => $main_category[$i]]);
                } 
                return back()->with('msg','Brand Edit  Successfully');
            }else{ 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'brand'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/brand');
                    $file->move($destinationPath, $filename);
                    $brand = 'upload/brand/'.$filename;
                }
                $data = new Brand();
                $data->brand_name = $req->brand_name;
            	$data->back_color = $req->back_color;  
            	$data->title = $req->title;  
                //$data->parent_id = implode(',', $req->parent_id);   
                $data->image  = $brand;
                $data->save(); 
				//dd($data);
                $main_category = $req->parent_id; 
                $getcreditCount = count($main_category);
                for ($i = 0; $i < $getcreditCount; $i++) {
                    DB::table('brand_categories')->insert(['brand_id' => $data->id, 'category_id' => $main_category[$i]]);
                }
                return back()->with('msg','Brand Add Successfully');
            }
        } 

        public function homePageBrandShow($status, $id) { 
            Brand::where('id', $id)->update(['show_brand' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }
    // brand End 
    //social icon start
        public function editSocialIcon(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Social Icon';
            $data['result'] = SocialIcon::where('id',1)->first();   
            return view('admin/webviews/admin_manage_social',$data); 
        } 
         
        public function updateSocialIcon(Request $req){
            SocialIcon::where('id',$req->id)->update([ 
                'facebook' => $req->facebook, 
                'twitter' => $req->twitter,
                'youtube' => $req->youtube,
                'instagram' => $req->instagram,
                'skype'=> $req->skype 
            ]);  
            return back()->with('msg','Social Icon Add Successfully'); 
        }

    //social icon end
    
	// Start Lab Location
     public function viewLabLocation(){
        $data['flag'] = 4; 
        $data['page_title'] = 'View Lab Location'; 
        $data['category'] = LabLocation::orderBy('locations_id','desc')->get(); 
        return view('admin/webviews/admin_manage_location',$data);
    }

    public function addLabLocation(){
            $data['flag'] = 5; 
            $data['page_title'] = 'Add Lab Location'; 
            return view('admin/webviews/admin_manage_location',$data);
   }

    public function LabLocationSubmit(Request $req){ 
        $req->validate([
            'location_name'=> 'required',  
            'location_code'=> 'required'  
        ]); 
        if($req->locations_id) { 
            LabLocation::where('locations_id',$req->locations_id)->update([
                'location_name' => $req->location_name, 
                'location_code' => $req->location_code, 
            ]);
            return back()->with('msg','Location Edit  Successfully');
        }else{ 
            $data = new LabLocation();
            $data->location_name = $req->location_name; 
            $data->location_code = $req->location_code; 
            $data->save(); 
            return back()->with('msg','Location Add  Successfully');
        }
    } 

    public function editLabLocation($locations_id){
      $data['flag'] = 6; 
      $data['page_title'] = 'Edit Lab Location'; 
      $data['result'] = LabLocation::where('locations_id',$locations_id)->first(); 
      return view('admin/webviews/admin_manage_location',$data);
    }
    
    public function deleteLabLocation($locations_id){ 
      $data['result']=LabLocation::where('locations_id',$locations_id)->delete();
      return back()->with('msg','Location Delete Successfully');  
    }
    
    public function toggleLabLocationActiveStatus($status, $locations_id) { 
       LabLocation::where('locations_id', $locations_id)->update(['status' => $status]); 
       return back()->with('msg','Status Change Successfully'); 
    }

    //social icon start
    public function getShippingSettings(){
       $data['flag'] = 1; 
       $data['page_title'] = 'Social Icon';
       $data['result'] = ShippingSetting::where('id',1)->first();   
       return view('admin/webviews/admin_manage_settings',$data); 
    } 
         
    public function updateShippingSettings(Request $req){
        ShippingSetting::where('id',$req->id)->update([ 
            'min_order_price'         => $req->min_order_price, 
            'charge_inside_location'  => $req->charge_inside_location,
            'charge_outside_location' => $req->charge_outside_location
        ]);  
        return back()->with('msg','Settings Updated Successfully'); 
    }


    
    //social icon end  
    
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

    public function fetch_attributes($id)
    {
        $attributesize_count = ProductAttribute::where("products_id",$id)->pluck('product_size')->count();
        if($attributesize_count !== null ){
            echo json_encode($attributes = DB::table("product_attributes")
            ->leftjoin('sizes', 'product_attributes.product_size', '=', 'sizes.id')
            ->select('product_attributes.id as id','sizes.size_name as size_name', 'product_attributes.product_color','product_attributes.quantity' )
            ->where("products_id",$id)
            ->get());
        }
    }


    public function assign_barcode(){

        $attribute_barcode = ProductAttribute::orderBy('id','desc')->where('barcode',null)->first();
        $unique_barcode = ProductAttribute::where('barcode',null)->get();
        
        $barcode_count= $unique_barcode->count();
        $id=3218;
        // dd($barcode_count);
        for($i=0; $i < $barcode_count; $i++){
            
            $barcode = mt_rand(1000000000, 9999999999);
            $unique_barcode1 = ProductAttribute::where('barcode',$barcode)->first();
            // dd($unique_barcode1);P
            if(!$unique_barcode1){
                ProductAttribute::where('barcode', null)->where('id', $id)->update(['barcode' => $barcode]);
            }
            $id++;
        }

       
    }
}
