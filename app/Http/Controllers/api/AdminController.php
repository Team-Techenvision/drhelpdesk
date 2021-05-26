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
use App\Wishlist;
use App\ShippingSetting;
use App\ConsultationHistory;
use App\ConsultationTransaction;
use App\Wallet;
use App\WalletTransactionHistory;
use App\DoctorFeedback;
use App\UserAddress;

class AdminController extends Controller
{
    public function category(){
        $category = Category::with('child')->where('parent_id',null)->orderBy('categories_id','desc')->select('categories_id','category_name','image','title','type')->get();
        if($category != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'category' => $category
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function subCategory(Request $req){

        if ($req->sub_sub_category_id) { //level 4 subcategory
          $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>$req->sub_category_id,'sub_sub_parent_id'=>$req->sub_sub_category_id])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
          $banner_image = Category::where(['sub_sub_parent_id'=>$req->sub_sub_category_id])->orderBy('sub_category_name','asc')->select('banner_image')->first();
        }

        elseif ($req->sub_category_id) { //level 3 subcategory
            $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>$req->sub_category_id,'sub_sub_parent_id'=>null])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
            //return response()->json([$category]);
            $banner_image = Category::where(['sub_parent_id'=>$req->sub_category_id])->orderBy('sub_category_name','asc')->select('banner_image')->first();
            foreach($category as $r){
                $category1= Category::where('sub_sub_parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1;
                }else{
                    $r->is_category = 0;
                }
            }

        }
        else { //level 2 subcategory and level 1 is category
            //dd('hj');
            $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>null,'sub_sub_parent_id'=>null])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
            $banner_image = Category::where(['parent_id'=>$req->category_id])->orderBy('sub_category_name','asc')->select('banner_image')->first();
            foreach($category as $r){
                $category1= Category::where('sub_parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1;
                }else{
                    $r->is_category = 0;
                }
            }
        }

        if($category->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => $category->count().' record found',
                'category' => $category,
                'banner_image' => $banner_image
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function productBySubCategory(Request $req){
        $maxValue = Product::max('price');
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  '';
    	//$brand = [];
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
    	$brand =  DB::table('brands')
    	->join('brand_categories','brands.id','brand_categories.brand_id')
    	->where('brand_categories.category_id' , $req->category_id)
    	->where('brands.status',0)->orderBy('brands.brand_name')->select('brands.*')->get();
        //$brand = DB::table('brands')->where('parent_id',$req->category_id)->where('status',0)->get();
        if ($req->category_id && empty($req->sub_category_id) && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat or level 1
           $category = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories' , $req->category_id)->select('products.*','product_images.product_image')->offset($req->start_point)->limit(10)->get();
        }
        elseif ($req->category_id && $req->sub_category_id && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory or level 2
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id])->select('products.*','product_images.product_image')->offset($req->start_point)->limit(10)->get();
        }
        elseif ($req->category_id && $req->sub_category_id && $req->sub_sub_category_id && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory and sub_sub_category or level 3
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id])->select('products.*','product_images.product_image')->offset($req->start_point)->limit(10)->get();
        }
        else { //product on the basis of cat and subcat and sub_sub_category and sub_sub_sub_category or level 4
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id,'sub_sub_sub_categories'=>$req->sub_sub_sub_category_id])->select('products.*','product_images.product_image')->offset($req->start_point)->limit(10)->get();

        }

        foreach($category as $r){
        	// $brand[] =  DB::table('brands')
        	// ->where('id' , $r->brand)
        	// ->where('status',0)->orderBy('brand_name','desc')->first();
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
    	//$brand = array_unique($brand);
    	//echo"<pre>";
    	//print_r($brand);
        if($category->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'product' => $category,
                'max_price' => $maxValue,
                'tags' => $mainTags,
                'brand' => $brand
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}

    public function productBySubCategoryCount(Request $req){

        if ($req->category_id && empty($req->sub_category_id) && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat or level 1
           $category = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories' , $req->category_id)->select('products.*','product_images.product_image')->get();
        }
        elseif ($req->category_id && $req->sub_category_id && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory or level 2
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id])->select('products.*','product_images.product_image')->get();
        }
        elseif ($req->category_id && $req->sub_category_id && $req->sub_sub_category_id && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory and sub_sub_category or level 3
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id])->select('products.*','product_images.product_image')->get();
        }
        else { //product on the basis of cat and subcat and sub_sub_category and sub_sub_sub_category or level 4
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id,'sub_sub_sub_categories'=>$req->sub_sub_sub_category_id])->select('products.*','product_images.product_image')->get();

        }

        if($category->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'product' => $category->count()
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function productDetails(Request $req){
        $result1=Product::join('vendors','products.vendor_id','vendors.vendors_id')->where('products_id',$req->product_id)->select('products.*','vendors.vendor_name')->first();
        $result=Product::where('products_id',$req->product_id)->first();
    	$result->short_description = empty($result->short_description) ? "": $result->short_description;
        $result->long_description = empty($result->long_description) ? "": $result->long_description;
        $result->key_features = empty($result->key_features) ? "": $result->key_features;
    	if($result->sub_categories != null){
        	$product=Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->select('products.*','product_images.product_image')->where('sub_categories' , $result->sub_categories)->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
    	}else{
        	$product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->select('products.*','product_images.product_image')->where('categories' , $result->categories)->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
        }
    	//$product=Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->select('products.*','product_images.product_image')->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
        foreach($product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
    	$review=Review::where('product_id',$req->product_id)->get();
        $image=ProductImage::where('products_id',$req->product_id)->pluck('product_image');
        if ($result!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'product details',
                'no_of_review'=>$review->count(),
                'rating'=>$review->avg('rating'),
                'image' => $image,
                'product'=>$result,
                'similar_product'=>$product
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Product Not Found'
             ]);
        }}
    public function doctorListing(Request $req){
        $category = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('speciality' , $req->sub_category_id)->select('user_details.*','categories.sub_category_name')->get();
        foreach ($category as $categories) {
             if($categories->experience_from  != null && $categories->experience_to != null){
            $experience = 0;
            $date1 = strtotime($categories->experience_from);
            $date2 = strtotime($categories->experience_to);
            $diff = abs($date2 - $date1);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24)
            / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 -
            $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24)
            / (60*60));
            $minutes = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24
            - $hours*60*60)/ 60);
            $seconds = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24
            - $hours*60*60 - $minutes*60));
            $categories->experience+= $years;
            }else{
                $categories->experience+= 0;
            }

            $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$categories->doctor_id)->orderBy('created_at','desc')->first();
            if($no_of_uses_left != null){
                $categories->is_credit = $no_of_uses_left->consultation_credit;
            }else{
                $categories->is_credit = 0;
            }

            $fper = 0;
            $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->get();
            $categories->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->count();
            $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->where('recommendation','yes')->get();
            if($posFeddback->count()>0 && $cfeedback->count()>0){
                $fper = ($posFeddback->count()*100)/$cfeedback->count();
                $categories->recommendation= floor($fper);
            }else{
                $categories->recommendation = null;
            }
        }
        if($category->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'doctor' => $category
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function locationListing(Request $req){
        $location = Location::where('status',0)->orderBy('locations_id','desc')->select('locations_id','location_name','location_code')->get();
        if($location != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'location' => $location
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
    }}
    public function banner(Request $req){
        $banner=Banner::where(['status'=>0,'show_on'=>'mob','type'=>'slider'])->orderBy('banners_id','desc')->select('*')->get();
        foreach ($banner as $key => $value) {
            if(!empty($value->banner_link)){
                $temp_brand = str_replace("https://drhelpdesk.in/home-search-data?homesearch=", "", $value->banner_link);
                $temp_brand = str_replace("https://mypetcare.in/dhd/public/home-search-data?homesearch=", "", $temp_brand);
            	$temp_brand = str_replace("+"," ",$temp_brand);
            	// $temp_brand = preg_replace('/[^A-Za-z0-9\-]/', '', $temp_brand);
                $banner_product = DB::table('products')->where("product_name", 'like', '%'.$temp_brand.'%')->first();
                $banner_brand = DB::table('brands')->where("id", $banner_product->brand)->first();
                $banner[$key]->brand_id = $banner_brand->id;
                $banner[$key]->brand_name = $banner_brand->brand_name;
            }else{
                // $banner[$key]->temp_brand = $temp_brand;
                $banner[$key]->brand_id = "";
                $banner[$key]->brand_name = "";
            }
        }
        return response()->json($banner);
    }

    public function healthPackage(Request $req){
        $health_package = DB::table('packages')->join('products', 'products.products_id', '=', 'packages.package')->where('packages.status',0)->where('packages.package_type',1)->select('packages.*', 'products.product_name')->get();
        foreach($health_package as $r){
            $package_id = explode(",",$r->package);
            $r->total_include_test = count($package_id);
            $package1 = Wishlist::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($package1 != null){
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

            if($r->offer_discount != null){
                $discount = ($r->offer_discount * $r->package_cost) / 100;
                $r->offer_price = round($r->package_cost - $discount);
            }
        }
        return response()->json($health_package);
    }

    public function getCategories(Request $req){
        $category = Category::where('category_name','!=' , null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
         foreach($category as $r){
            $category1= Category::where('parent_id',$r->categories_id)
            ->first();
            //dd($catalogue2);
            if($category1 != null){
                $r->is_category = 1;
            }else{
                $r->is_category = 0;
            }
        }
        return response()->json($category);
    }

    public function referBanner(Request $req){
        return response()->json(Banner::where(['status'=>0,'show_on'=>'mob','location'=>'refer-banner'])->orderBy('banners_id','desc')->select('*')->first());
    }

    public function promotionalBanner(Request $req){
        return response()->json(Banner::where(['status'=>0,'show_on'=>'mob','location'=>'promotional-banner'])->orderBy('banners_id','desc')->select('*')->first());
    }

    public function homePage(Request $req){
    	$header1 = DB::table('header_contents')->where('id',1)->first();
    	$brand = DB::table('brands')->where('status',0)->where('show_brand',1)->get();
        $banner=Banner::where(['status'=>0,'show_on'=>'mob','type'=>'slider'])->orderBy('banners_id','desc')->select('*')->get();
        foreach ($banner as $key => $value) {
            if(!empty($value->banner_link)){
                $temp_brand = str_replace("https://drhelpdesk.in/home-search-data?homesearch=", "", $value->banner_link);
                $temp_brand = str_replace("https://mypetcare.in/dhd/public/home-search-data?homesearch=", "", $temp_brand);
            	$temp_brand = str_replace("+"," ",$temp_brand);
            	// $temp_brand = preg_replace('/[^A-Za-z0-9\-]/', '', $temp_brand);
                $banner_product = DB::table('products')->where("product_name", 'like', '%'.$temp_brand.'%')->first();
                $banner_brand = DB::table('brands')->where("id", $banner_product->brand)->first();
                $banner[$key]->brand_id = $banner_brand->id;
                $banner[$key]->brand_name = $banner_brand->brand_name;
            }else{
                // $banner[$key]->temp_brand = $temp_brand;
                $banner[$key]->brand_id = "";
                $banner[$key]->brand_name = "";
            }
        }
        $refer_banner=Banner::where(['status'=>0,'show_on'=>'mob','location'=>'refer-banner'])->orderBy('banners_id','desc')->select('*')->first();
        $promotional_banner=Banner::where(['status'=>0,'show_on'=>'mob','location'=>'promotional-banner'])->orderBy('banners_id','desc')->select('*')->first();
        $health_package = DB::table('packages')->join('products', 'products.products_id', '=', 'packages.package')->where('packages.status',0)->where('packages.package_type',1)->select('packages.*', 'products.product_name')->get();
        foreach($health_package as $r){
            $package_id = explode(",",$r->package);
            $r->total_include_test = count($package_id);
            $package1 = Wishlist::where('product_id',$r->id)->where('user_id',$req->user_id)->where('type' ,3)->first();
            //dd($catalogue2);
            if($package1 != null){
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

            if($r->offer_discount != null){
                $discount = ($r->offer_discount * $r->package_cost) / 100;
                $r->offer_price = round($r->package_cost - $discount);
            }
        }
        $stay_healthy = Blog::where('status',0)->get();
        $category = Category::where('category_name','!=' , null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
         foreach($category as $r){
                $category1= Category::where('parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1;
                }else{
                    $r->is_category = 0;
                }
            }
        $save_more_category = Category::where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','desc')->get();
        foreach($save_more_category as $r){
                $category1= Category::where('parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1;
                }else{
                    $r->is_category = 0;
                }
            }
        $doctor = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('role_id' ,1)->select('user_details.user_details_id','user_details.user_name','user_details.user_id',
        'user_details.image','user_details.address','user_details.experience_from','user_details.experience_to','categories.sub_category_name')->get(); //why data not fetch from user table
        foreach ($doctor as $categories) {
             if($categories->experience_from  != null && $categories->experience_to != null){
            $experience = 0;
            $date1 = strtotime($categories->experience_from);
            $date2 = strtotime($categories->experience_to);
            $diff = abs($date2 - $date1);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24)
            / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 -
            $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24)
            / (60*60));
            $minutes = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24
            - $hours*60*60)/ 60);
            $seconds = floor(($diff - $years * 365*60*60*24
            - $months*30*60*60*24 - $days*60*60*24
            - $hours*60*60 - $minutes*60));
            $categories->experience+= $years;
            }else{
                $categories->experience+= 0;
            }
        }
        $top_selling_product = Product::Join('product_images','products.products_id','product_images.products_id')->where('categories', '!=', 15)->where('type',2)->where('top_selling_product' ,'top_selling_product')->select('products.products_id','products.product_name','products.price','products.special_price','products.extra_discount','products.short_description','product_images.product_image','products.rating')->inRandomOrder()->limit(10)->get();
        foreach($top_selling_product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        $mom_baby_care = Product::Join('product_images','products.products_id','product_images.products_id')->where('categories', 24)->where('type',2)->select('products.products_id','products.product_name','products.price','products.special_price','products.extra_discount','products.short_description','product_images.product_image','products.rating')->inRandomOrder()->limit(20)->get();
        foreach($mom_baby_care as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        $sexual_welness = Product::Join('product_images','products.products_id','product_images.products_id')->where('categories', 285)->where('type',2)->select('products.products_id','products.product_name','products.price','products.special_price','products.extra_discount','products.short_description','product_images.product_image','products.rating')->inRandomOrder()->limit(20)->get();
        foreach($sexual_welness as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
    	$covid = Category::where('category_name' ,'!=', null)->where('type',3)->where('status',0)->orderBy('categories_id','desc')->get(); // category only if subcategory find then remove the category_name condition
        $testimonial=Testimonial::orderBy('created_at','desc')->get();

        if($banner!=null){
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
            	'header'=>$header1,
            	'brand'=>$brand,
                'banner'=>$banner,
                'refer_banner'=>$refer_banner,
                'promotional_banner'=>$promotional_banner,
                'category'=>$category,
                'save_more_category'=>$save_more_category,
                'doctor'=>$doctor,
                'stay_healthy'=>$stay_healthy,
                'health_package'=>$health_package,
                'top_selling_product'=>$top_selling_product,
            	'mom_baby_care'=>$mom_baby_care,
            	'sexual_welness'=>$sexual_welness,
                'covid'=>$covid,
                'testimonial'=>$testimonial
             ]);
        }else {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Data Not Found'
                ]);
        }
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

    public function addToCart(Request $req){
        if (Cart::where(['product_id'=>$req->product_id,'user_id'=>$req->user_id])->count()>0) {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Item Already Present In Cart',
                'count'=>Cart::where('user_id',$req->user_id)->count()
             ]);
        }
        else{
            $reg = new Cart;
            $reg->quantity = $req->quantity;
            $reg->product_id = $req->product_id;
            $reg->user_id = $req->user_id;
            $reg->type = $req->type;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Item Added To Cart',
                    'count'=>Cart::where('user_id',$req->user_id)->count(),
                    'Item'=>Cart::where('id',$reg->id)->select('id','user_id','product_id','quantity','type')->first()
                 ]);
            }
            else {
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Something Went Wrong'
                 ]);
            }
        }}
    public function myCart(Request $req){
        $cart = Cart::where('user_id',$req->user_id)->select('type','product_id')->get();
        //dd($cart);
        if ($cart->count()>0) {
           foreach ($cart as $key => $r2) {
                if($r2->type==1){
                    $data1[]=DB::table('products')
                    ->join('carts', 'products.products_id', '=', 'carts.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                    ->join('vendors','products.vendor_id','=','vendors.vendors_id')
                    //->select(DB::raw('products.products_id, products.product_name, products.price, COALESCE(products.special_price, "") as special_price, products.prescription,  products.extra_discount, product_images.product_image, carts.quantity, carts.id, carts.type'))->where('products.products_id',$r2->product_id)->first();
                    ->select('products.products_id','products.product_name' ,'products.price', DB::raw('COALESCE(products.special_price, "") as special_price'), 'products.prescription', DB::raw('COALESCE(products.extra_discount, "") as extra_discount') ,'product_images.product_image', 'vendors.vendors_id', 'vendors.vendor_name' ,'carts.quantity' ,'carts.id' ,'carts.type')->where('products.products_id',$r2->product_id)->first();
                }
                elseif($r2->type==2){
                    $data1[]=DB::table('products')
                    ->join('carts', 'products.products_id', '=', 'carts.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                    ->join('vendors','products.vendor_id','=','vendors.vendors_id')
                    //->select(DB::raw('products.products_id, products.product_name, products.price, COALESCE(products.special_price, "") as special_price, products.prescription,  products.extra_discount, product_images.product_image, carts.quantity, carts.id, carts.type'))->where('products.products_id',$r2->product_id)->first();
                    ->select('products.products_id','products.product_name' ,'products.price', DB::raw('COALESCE(products.special_price, "") as special_price'),'products.prescription', DB::raw('COALESCE(products.extra_discount, "") as extra_discount') ,'product_images.product_image', 'vendors.vendors_id', 'vendors.vendor_name' ,'carts.quantity' ,'carts.id' ,'carts.type')->where('products.products_id',$r2->product_id)->first();
                }

                elseif($r2->type==3){
                    $data1[]=DB::table('packages')
                    ->join('carts', 'packages.id', '=', 'carts.product_id')
                    ->join('products', 'products.products_id', '=', 'packages.package')
                    ->join('vendors','products.vendor_id','=','vendors.vendors_id')
                    ->select('packages.id as products_id','packages.package_name as product_name','packages.package_cost as price' ,DB::raw('COALESCE(packages.special_price, "") as special_price') ,'products.prescription',DB::raw('COALESCE(packages.offer_discount, "") as extra_discount'),'packages.image as product_image','vendors.vendors_id', 'vendors.vendor_name','carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)->first();
                }
            }
           if ($data1!=null) {
                  //$data1 = array_filter($data1);
                  $final_array = [];
                  foreach($data1 as $line){
                  	if(!empty($line)){
                       $final_array[] = $line;
                    }
                   }
                $address = UserAddress::where(['user_id'=> $req->user_id,'selected' => '1'])->first();
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Items of Cart',
                      'count'=>count($final_array),//Cart::where('user_id',$req->user_id)->count(),
                      'Item'=>$final_array,
                      'default_address' => $address,
                   ]);
              } else {
                  return response()->json($data = [
                      'status' => 404,
                      'msg' => 'Data not found'
                   ]);
              }
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Your Cart is empty'
             ]);
        }}
    public function fetchBrand(Request $req){
        $brand=Brand::where('status',0)->get();
        if ($brand->count()>0) {
             return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Brands Of The Products',
                      'brand'=>$brand
                   ]);
        }else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function doctorDetails(Request $req){
        $sum = 0;
        $rating = 0;
        $category = UserDetail::where('user_details_id',$req->doctor_id)->first();
        $doctor_experience = DB::table('experiance')->where('user_id', $category->user_id)->get();
        $doctor_feedback = DoctorFeedback::where('doctor_id',$req->doctor_id)->get();
        if ($doctor_experience !=  null) {
            foreach ($doctor_experience as $r) {
                $date1 = strtotime($r->fromstart);
                $date2 = strtotime($r->toend);
                $diff = abs($date2 - $date1);
                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                    / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                    $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $hours = floor(($diff - $years * 365 * 60 * 60 * 24
                    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
                    / (60 * 60));
                $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
                    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                    - $hours * 60 * 60) / 60);
                $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
                    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                    - $hours * 60 * 60 - $minutes * 60));
                $sum += $years;
            }
        }
        foreach($doctor_feedback as $r){
            $category1= UserDetail::where('user_id',$r->user_id)
            ->first();

            if($category1 != null){
                $r->user_name = $category1->user_name;
                $r->image = $category1->image;
            }else{
                $r->user_name = null;
                $r->image = null;
            }
        }
        $fper = 0;
        $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id', $req->doctor_id)->get();

        foreach ($cfeedback as $r) {
            $category1 = UserDetail::where('user_id', $r->user_id)
                ->first();
            if ($category1 != null) {
                $r->user_name = $category1->user_name;
                $r->image = $category1->image;
            } else {
                $r->user_name = null;
                $r->image = null;
            }
            $rating += $r->rating;
        }
        // $doctor_detail->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$doctor_detail->user_details_id)->count();
        $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id', $req->user_details_id)->where('recommendation', 'yes')->get();
        if ($posFeddback->count() > 0 && $cfeedback->count() > 0) {
            $fper = ($posFeddback->count() * 100) / $cfeedback->count();
            $recommendation = floor($fper);
        } else {
            $recommendation = null;
        }
        if($cfeedback->count() == 0){
             $rr = 0;
        }else{
            $rr = $rating / $cfeedback->count();
        }
        if($category!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'ratings' => $rr,
                'feedback' =>  $cfeedback->count(),
                'experience' =>  $sum,
                'specialist'=>Category::where('categories_id',$category->speciality)->pluck('sub_category_name')->first(),
                'result' => $category,
                'doctor_feedback' => $doctor_feedback,
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }}
    public function allLabTest(Request $req){
        //$test=Product::where('categories',$req->category_id)->get();//here category id is lab test id
        //$test=Product::Join('product_images','products.products_id','product_images.products_id')->where('categories',$req->category_id)->select('products.*','product_images.*')->get();
    	$test=Product::Join('product_images','products.products_id','product_images.products_id')->where('product_images.type',2)->where('categories',$req->category_id)->select('products.*','product_images.product_image')->offset($req->start_point)->limit(10)->get();
    	foreach($test as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
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
        if ($test->count()>0) {
            return response()->json($data = [
                     'status' => 200,
                     'msg' => 'test name',
                     'test'=>$test
                  ]);
       }else {
           return response()->json($data = [
               'status' => 404,
               'msg' => 'Data Not Found'
            ]);
       }
    }
	public function allLabTestCount(Request $req){
        $test=Product::where('categories',$req->category_id)->count();
        if ($test > 0) {
            return response()->json($data = [
                     'status' => 200,
                     'msg' => 'Total test',
                     'test'=>$test
                  ]);
        }else {
           return response()->json($data = [
               'status' => 404,
               'msg' => 'Data Not Found'
            ]);
        }
    }
    public function vendorsOrder(Request $req){
        $orders = OrderItem::where('assign_vendor_id',$req->vendor_id)->get();
        if ($orders->count()>0) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Your Assign Orders',
                      'Item'=>$orders
                   ]);
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'You have not assign any order'
             ]);
        }
    }
    public function shippingCharge(Request $req){
        $charge=ShippingCharge::get();
        if ($charge->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Shipping Charge',
                'charge'=>$charge
             ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Data Found'
             ]);
        }

    }

    public function shippingSetting(Request $req){
        $charge=ShippingSetting::get();
        if ($charge->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Shipping Charge',
                'charge'=>$charge
             ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Data Found'
             ]);
        }

    }

    public function deWalletCoin(Request $req){
        $wallet=DeWallet::where('user_id',$req->user_id)->first();
        $date = \Carbon\Carbon::today()->subDays(60);
        $lastMonth = WalletTransactionHistory::where(['user_id' => $req->user_id, 'payment_status' => 'success',['created_at','>=',$date]])->sum('amount');
        if ($wallet) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Wallet',
                'charge'=>$wallet,
                'last_month_earning' =>  $lastMonth
             ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Data Found'
             ]);
        }

    }
    public function deliveryBoyListing(Request $req){
        $vendor=Vendor::where('vendors_id',$req->vendor_id)->first();

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

        if ($result!=null) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Assign Delivery Boy',
                      'result'=>$result
                   ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data not found'
             ]);
        }
    }
    public function addToWishlist(Request $req){
        if (Wishlist::where(['product_id'=>$req->product_id,'user_id'=>$req->user_id,'type'=>$req->type])->count()>0) {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Item Already Present In Wishlist',
                'count'=>Wishlist::where('user_id',$req->user_id)->count()
             ]);
        }
        else{
            $reg = new Wishlist;
            $reg->quantity = $req->quantity;
            $reg->product_id = $req->product_id;
            $reg->user_id = $req->user_id;
            $reg->type = $req->type;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Item Added To Wishlist',
                    'count'=>Wishlist::where('user_id',$req->user_id)->count(),
                    'Item'=>Wishlist::where('id',$reg->id)->select('id','user_id','product_id','quantity','type')->first()
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

    public function myWishlist(Request $req){
        $wishlist = Wishlist::where('user_id',$req->user_id)->select('type','product_id')->get();
        //dd($wishlist);
        if($wishlist->count()>0) {
            foreach ($wishlist as $key => $r2) {
                if($r2->type==1){
                    $data1[]=DB::table('products')
                    ->join('wishlists', 'wishlists.product_id' , '=',  'products.products_id')
                    ->join('product_images', 'product_images.products_id' , '=' , 'products.products_id')
                    ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'wishlists.quantity' ,'wishlists.id' ,'wishlists.type')->where('products.products_id',$r2->product_id)->first();

                }
                elseif($r2->type==2){
                    $data1[]=DB::table('products')
                    ->join('wishlists', 'wishlists.product_id' , '=',  'products.products_id')
                     ->join('product_images', 'product_images.products_id' , '=' , 'products.products_id')
                     ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'wishlists.quantity' ,'wishlists.id' ,'wishlists.type')->where('products.products_id',$r2->product_id)->first();
                }
                elseif($r2->type==3){
                    $data1[]=DB::table('packages')
                    ->join('wishlists', 'wishlists.product_id' , '=',  'packages.id')
                    ->join('products','packages.package' , '=',  'products.products_id')
                     ->select('packages.id as products_id','packages.package_name as product_name','packages.package_cost as price' ,'packages.package_cost as special_price' ,'packages.offer_discount as extra_discount','packages.image as product_image','wishlists.quantity','wishlists.id','wishlists.type')->where('packages.id',$r2->product_id)-> first();
                }
            }
           if ($data1 != null) {
                $data1 = array_values(array_filter($data1));
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Items of Wishlist',
                      'count'=>count($data1),
                      'Item'=>$data1
                   ]);
              } else {
                  return response()->json($data = [
                      'status' => 404,
                      'msg' => 'Data not found'
                   ]);
              }
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Your Wishlist is empty'
             ]);
        }
    }
	public function productFilter(Request $req){
        $maxValue = Product::max('price');
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  '';
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        if(!empty($req->categories_id) && $req->categories_id != null && $req->categories_id != "null"){
            $brand1 =  DB::table('brands')
            ->join('brand_categories','brands.id','brand_categories.brand_id')
            ->where('brand_categories.category_id' , $req->categories_id)
            ->where('brands.status',0)->orderBy('brands.brand_name')->select('brands.*')->get();
        }else{
            $brand1 =  DB::table('brands')
            ->join('brand_categories','brands.id','brand_categories.brand_id')
            // ->where('brand_categories.category_id' , $req->categories_id)
            ->where('brands.status',0)->orderBy('brands.brand_name')->select('brands.*')->get();
        }


        //$brand1 = DB::table('brands')->where('parent_id',$req->categories_id)->where('status',0)->get();
        //dd($mainTags);
        $minpr = $req->minpr;
        $maxpr = $req->maxpr;
        $tags = !empty($req->tags);
        // $brand_array = explode(',', $req->brand);
        // $brand = !empty($brand_array)?$brand_array:[];
    	if(!empty($req->brand)){
        	$brand  = explode(',', $req->brand);
    	}else{
    		$brand = [];
    	}

    	if(!empty($req->rating)){
        	$rating  = explode(',', $req->rating);
    	}else{
    		$rating = [];
    	}

        //dd($rating);
        $price_sort = $req->price_sort;
        $subcategories = (int) $req->sub_category_id;
        $subsubcategories = (int) $req->sub_sub_category_id;
        $subsubsubcategories = (int) $req->sub_sub_sub_category_id;


        if($subcategories == null){
            $subcategories = Category::where('parent_id', $req->categories_id)->where('status',0)->select('categories_id')->get();
            //dd($subcategories);
        }

        if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){
            $parent = [];
            foreach($subcategories as $r) {
                $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('status',0)->select('categories_id')->get();
            }
        }
        if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){
            $parent1 = [];
            foreach($subsubcategories as $r1) {
                $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('status',0)->select('categories_id')->get();
            }
        }
        //dd($subsubcategories , $subsubsubcategories);
        if (!is_array($subcategories) && is_int($subcategories)) {
            //dd($subcategories);
            $subcategories = (array) $subcategories;
        }
        if (!is_array($subsubcategories) && is_int($subsubcategories)  && $subsubcategories > 0) {
            $subsubcategories = (array) $subsubcategories;
        }
        if (!is_array($subsubsubcategories) && is_int($subsubsubcategories)  && $subsubsubcategories > 0 ) {
            $subsubsubcategories = (array) $subsubsubcategories;
        }
        if (!is_array($brand) && is_int($brand)  && $brand > 0 ) {
            $brand = (array) $brand;
        }
        if (!is_array($rating) && is_int($rating)  && $rating > 0 ) {
            $rating = (array) $rating;
        }

        if (!is_array($tags) && is_int($tags)  && $tags > 0 ) {
            $tags = (array) $tags;
        }
        //dd($price_sort);
         if (!empty($price_sort) && $price_sort == 1) {
               $sortP = 'desc';
            }else{
                 $sortP = 'asc';
            }
        //dd($rating);
        //dd(json_decode(json_encode($subcategories)));
        if(!empty($req->categories_id) && $req->categories_id != null && $req->categories_id != "null"){
            $product_query = Product::Join('product_images','products.products_id','product_images.products_id')->where('product_images.type',2)->where('categories',$req->categories_id);
        }else{
            $product_query = Product::Join('product_images','products.products_id','product_images.products_id')->where('product_images.type',2);
        }
        $product = $product_query->where(function($query) use ($subcategories){
            $tessub = json_decode(json_encode($subcategories), true);
            if($subcategories!='' && !empty($tessub)){
                return $query->whereIn('sub_categories',$subcategories);
            }})
            ->where(function($query) use ($subsubcategories){
            $tessubsub = json_decode(json_encode($subsubcategories), true);
            if($subsubcategories!='' && !empty($tessubsub)){
                return $query->whereIn('sub_sub_categories',$subsubcategories);
            }})
            ->where(function($query) use ($subsubsubcategories){
            $tessubsubsub = json_decode(json_encode($subsubsubcategories), true);
            if($subsubsubcategories!='' && !empty($tessubsubsub)){
                return $query->whereIn('sub_sub_sub_categories',$subsubsubcategories);
            }})
            ->where(function($query) use ($brand){
            if (!empty($brand)) {
                return $query->whereIn('brand',$brand);
            }})
            ->where(function($query) use ($rating){
            if (!empty($rating)) {
                return $query->whereIn('rating',$rating);
            }})
            ->where(function($query) use ($tags){
            if (!empty($tags)) {
                return $query->where('tags', 'LIKE', '%' . $tags . '%');
            }})
            ->where(function($query) use ($minpr ,$maxpr){
            if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
                return $query->whereBetween('price', [$minpr, $maxpr]);
            }})

        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();
        foreach($product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        //dd($product);
        if($req->categories_id != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'product' => $product,
                'max_price' => $maxValue,
                'tags' => $mainTags,
                'brand' => $brand1
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function allCities(){
        $city = DB::table('cities')->orderby('city_name','asc')->get();
        if($city !=null){
            return response()->json($data = [
                'msg'=>'success',
                'status'=>200,
                'city'=>$city
            ]);
        }else{
             return response()->json($data = [
                'msg'=>'Data Not Found',
                'status'=>400
            ]);
        }
    }
    public function sexualWelnessDetail(Request $req){
        $result1=Category::where('parent_id',$req->id)->where('categories_id',438)->orwhere('categories_id',439)->get();
        $doctor = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('speciality',438)->orwhere('speciality',439)->orderBy(DB::raw('RAND()'))->select('user_details.*','categories.sub_category_name')->get();
        foreach ($doctor as $categories) {
            $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$categories->doctor_id)->orderBy('created_at','desc')->first();
            if($no_of_uses_left != null){
                $categories->is_credit = $no_of_uses_left->consultation_credit;
            }else{
                $categories->is_credit = 0;
            }

            $fper = 0;
            $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->get();
            $categories->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->count();
            $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->where('recommendation','yes')->get();
            if($posFeddback->count()>0 && $cfeedback->count()>0){
                $fper = ($posFeddback->count()*100)/$cfeedback->count();
                $categories->recommendation= floor($fper);
            }else{
                $categories->recommendation = null;
            }
        }
        if ($result1!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'product details',
                'product'=>$result1,
                'doctor'=>$doctor,
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Product Not Found'
             ]);
        }
    }
	public function allState(){
        $state = DB::table('tbl_state')->orderby('state_name','asc')->get();
        if($state !=null){
            return response()->json($data = [
                'msg'=>'success',
                'status'=>200,
                'state'=>$state
            ]);
        }else{
             return response()->json($data = [
                'msg'=>'Data Not Found',
                'status'=>400
            ]);
        }
    }
    public function productFilterSortBy(Request $req){
        $maxValue = Product::max('price');
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  '';
        foreach($ptags as $tags){
            $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        if(!empty($req->categories_id) && $req->categories_id != null && $req->categories_id != "null"){
            $brand1 =  DB::table('brands')
            ->join('brand_categories','brands.id','brand_categories.brand_id')
            ->where('brand_categories.category_id' , $req->categories_id)
            ->where('brands.status',0)->orderBy('brands.brand_name')->select('brands.*')->get();
        }else{
            $brand1 =  DB::table('brands')
            ->join('brand_categories','brands.id','brand_categories.brand_id')
            // ->where('brand_categories.category_id' , $req->categories_id)
            ->where('brands.status',0)->orderBy('brands.brand_name')->select('brands.*')->get();
        }

        //$brand1 = DB::table('brands')->where('parent_id',$req->categories_id)->where('status',0)->get();
        $price_sort = $req->price_sort;
        $subcategories = (int) $req->sub_category_id;
        $subsubcategories = (int) $req->sub_sub_category_id;
        $subsubsubcategories = (int) $req->sub_sub_sub_category_id;
        if($subcategories == null){
            $subcategories = Category::where('parent_id', $req->categories_id)->where('status',0)->select('categories_id')->get();
        }

        if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){
            $parent = [];
            foreach($subcategories as $r) {
                $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('status',0)->select('categories_id')->get();
            }
        }
        if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){
            $parent1 = [];
            foreach($subsubcategories as $r1) {
                $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('status',0)->select('categories_id')->get();
            }
        }
        if (!is_array($subcategories) && is_int($subcategories)) {
            $subcategories = (array) $subcategories;
        }
        if (!is_array($subsubcategories) && is_int($subsubcategories)  && $subsubcategories > 0) {
            $subsubcategories = (array) $subsubcategories;
        }
        if (!is_array($subsubsubcategories) && is_int($subsubsubcategories)  && $subsubsubcategories > 0 ) {
            $subsubsubcategories = (array) $subsubsubcategories;
        }

        if (!empty($price_sort) && $price_sort == 1) {
           $sortP = 'desc';
        }elseif (!empty($price_sort) && $price_sort == 3) {
           $newest = 'desc';
        }else{
             $sortP = 'asc';
        }

        if(!empty($req->categories_id) && $req->categories_id != null && $req->categories_id != "null"){
            $product_query = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',$req->categories_id);
        }else{
            $product_query = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2);
        }
        ini_set("memory_limit", "-1");
        set_time_limit(0);
        // error_reporting(E_ALL);
        // ini_set("display_errors", "On");
        // echo "<pre>"; print_r($product_query); exit;
        $product =$product_query
        ->where(function($query) use ($subcategories){
        $tessub = json_decode(json_encode($subcategories), true);
        if($subcategories!='' && !empty($tessub)){
            return $query->whereIn('sub_categories',$subcategories);
        }})
        ->where(function($query) use ($subsubcategories){
        $tessubsub = json_decode(json_encode($subsubcategories), true);
        if($subsubcategories!='' && !empty($tessubsub)){
            return $query->whereIn('sub_sub_categories',$subsubcategories);
        }})
        ->where(function($query) use ($subsubsubcategories){
        $tessubsubsub = json_decode(json_encode($subsubsubcategories), true);
        if($subsubsubcategories!='' && !empty($tessubsubsub)){
            return $query->whereIn('sub_sub_sub_categories',$subsubsubcategories);
        }})
        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();
        foreach($product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            //dd($catalogue2);
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if($req->categories_id != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'product' => $product,
                'max_price' => $maxValue,
                'tags' => $mainTags,
                'brand' => $brand1
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }

	public function searchData(Request $req){
        if($req->keyword){
            $maxValue = Product::max('price');
            $ptags = DB::table('products')->select('tags')->get();
            $mainTags =  '';
            foreach($ptags as $tags){
                  $mainTags =   $tags->tags.',';
            }
            $mainTags = array_unique(array_filter(explode(',',$mainTags)));
            //dd($mainTags);
             $brand1 = DB::table('brands')->where('status',0)->get();
            $minpr = $req->minpr;
            $maxpr = $req->maxpr;
            $tags = !empty($req->tags);
            $brand = !empty($req->brand)?$req->brand:[];
            $rating = !empty($req->rating)?$req->rating:[];
            $price_sort = $req->price_sort;

            if (!is_array($brand) && is_int($brand)  && $brand > 0 ) {
                $brand = (array) $brand;
            }
            if (!is_array($rating) && is_int($rating)  && $rating > 0 ) {
                $rating = (array) $rating;
            }
            if (!is_array($tags) && is_int($tags)  && $tags > 0 ) {
                $tags = (array) $tags;
            }
            //dd($price_sort);
            if (!empty($price_sort) && $price_sort == 1) {
               $sortP = 'desc';
            }else{
                 $sortP = 'asc';
            }
            $form_search = $req->keyword;
            //dd(json_decode(json_encode($subcategories)));
            $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->
            where(function($query) use ($brand){
            if (!empty($brand)) {
                return $query->whereIn('brand',$brand);
            }})
            ->where(function($query) use ($rating){
            if (!empty($rating)) {
                return $query->whereIn('rating',$rating);
            }})

            ->where(function($query) use ($tags){
            if (!empty($tags)) {
                return $query->where('tags', 'LIKE', '%' . $tags . '%');
            }})
            ->where(function($query) use ($minpr ,$maxpr){
            if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
                return $query->whereBetween('price', [$minpr, $maxpr]);
            }})
            ->where(function($query) use ($form_search){
            if(!empty($form_search)) {
                return $query->where('product_name', 'LIKE', "%$form_search%")->orwhere('brand', 'LIKE', "%$form_search%")->orwhere('short_description', 'LIKE', "%$form_search%")->orwhere('long_description', 'LIKE', "%$form_search%")->orwhere('key_features', 'LIKE', "%$form_search%")->orwhere('product_code', 'LIKE', "%$form_search%")->orwhere('tags', 'LIKE', "%$form_search%");
            }})
            ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();
            foreach($product as $r){
                $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
                $rating = Review::where('product_id',$r->product_id)->get();
                $r->rate = $rating->avg('rating');
                $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
                if($p1 != null){
                    $r->user_wishlist = 1;
                }else{
                    $r->user_wishlist = 0;
                }
                $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
                if($cart != null){
                    $r->user_cart = 1;
                }else{
                    $r->user_cart = 0;
                }
            }
            if($product->count()>0){
                return response()->json($data=[
                    'status'=>200,
                    'msg'=>count($product).' record found',
                    'product'=>($product),
                    'max_price' => $maxValue,
                    'tags' => $mainTags,
                    'brand' => $brand1
                ]);
            }else {
                return response()->json($data=[
                    'status'=>201,
                    'msg'=>'no record found'
                ]);
            }
        }
    }
	public function search(Request $req){
        $form_search = $req->keyword;
        if($req->count >= 2){
            $product = Product::where('status', 0)->where('product_name', 'LIKE', "%$form_search%")->orwhere('product_code', 'LIKE', "%$form_search%")->select('product_name','categories','products_id')->orderBy('product_name','asc')->get();
            if($product->count()>0){
                return response()->json($data=[
                    'status'=>200,
                    'msg'=>count($product).' record found',
                    'product'=>$product
                ]);
            }else {
                return response()->json($data=[
                    'status'=>201,
                    'msg'=>'no record found'
                ]);
            }
        }else {
            return response()->json($data=[
                'status'=>400,
                'msg'=>'no record found'
            ]);
        }

    }
	public function productByBrand(Request $req){
        $maxValue = Product::max('price');
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  '';
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $minpr = $req->minpr;
        $maxpr = $req->maxpr;
        $tags = !empty($req->tags);
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort;
        if (!is_array($rating) && is_int($rating)  && $rating > 0 ) {
            $rating = (array) $rating;
        }
        if (!is_array($tags) && is_int($tags)  && $tags > 0 ) {
            $tags = (array) $tags;
        }
        //dd($price_sort);
        if (!empty($price_sort) && $price_sort == 1) {
           $sortP = 'desc';
        }else{
             $sortP = 'asc';
        }
        $form_search = $req->brand_id;
        $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('brand',$req->brand_id)
        ->where(function($query) use ($rating){
        if (!empty($rating)) {
            return $query->whereIn('rating',$rating);
        }})

        ->where(function($query) use ($tags){
        if (!empty($tags)) {
            return $query->where('tags', 'LIKE', '%' . $tags . '%');
        }})
        ->where(function($query) use ($minpr ,$maxpr){
        if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
            return $query->whereBetween('price', [$minpr, $maxpr]);
        }})
        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->paginate(10);
        foreach($product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if($product->count()>0){
            return response()->json($data=[
                'status'=>200,
                'msg'=>count($product).' record found',
                'product'=>($product),
                'max_price' => $maxValue,
                'tags' => $mainTags
            ]);
        }else {
            return response()->json($data=[
                'status'=>201,
                'msg'=>'no record found'
            ]);
        }
    }
	public function productByBrandCount(Request $req){
        $maxValue = Product::max('price');
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  '';
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $minpr = $req->minpr;
        $maxpr = $req->maxpr;
        $tags = !empty($req->tags);
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort;
        if (!is_array($rating) && is_int($rating)  && $rating > 0 ) {
            $rating = (array) $rating;
        }
        if (!is_array($tags) && is_int($tags)  && $tags > 0 ) {
            $tags = (array) $tags;
        }
        //dd($price_sort);
        if (!empty($price_sort) && $price_sort == 1) {
           $sortP = 'desc';
        }else{
             $sortP = 'asc';
        }
        $form_search = $req->brand_id;
        $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('brand',$req->brand_id)
        ->where(function($query) use ($rating){
        if (!empty($rating)) {
            return $query->whereIn('rating',$rating);
        }})

        ->where(function($query) use ($tags){
        if (!empty($tags)) {
            return $query->where('tags', 'LIKE', '%' . $tags . '%');
        }})
        ->where(function($query) use ($minpr ,$maxpr){
        if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
            return $query->whereBetween('price', [$minpr, $maxpr]);
        }})
        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();
        foreach($product as $r){
            $r->review = DB::table('reviews')->where('product_id', $r->products_id)->count();
            $rating = Review::where('product_id',$r->product_id)->get();
            $r->rate = $rating->avg('rating');
            $p1 = Wishlist::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            if($p1 != null){
                $r->user_wishlist = 1;
            }else{
                $r->user_wishlist = 0;
            }
            $cart = Cart::where('product_id',$r->products_id)->where('user_id',$req->user_id)->where('type' ,1)->first();
            if($cart != null){
                $r->user_cart = 1;
            }else{
                $r->user_cart = 0;
            }
        }
        if($product->count()>0){
            return response()->json($data=[
                'status'=>200,
                'msg'=>count($product).' record found',
            	'product_count'=>$product->count(),

            ]);
        }else {
            return response()->json($data=[
                'status'=>201,
                'msg'=>'no record found'
            ]);
        }
    }

    public function getProfile($id){
        $user = UserDetail::where('user_id',$id)->first();
        if($user){
            return response()->json($data=[
                'status'=>200,
                'msg'=> 'user record found',
            	'user' =>$user,
            ]);
        }else{
            return response()->json($data=[
                'status'=>201,
                'msg'=>'No user found'
            ]);
        }
    }
}
