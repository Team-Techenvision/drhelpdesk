<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Category;
use App\UserDetail;
use App\Product;
use App\ProductImage; 
use App\Blog; 
use App\Location; 
use App\Testimonial; 
use App\DoctorFeedback; 
use App\Package;
use App\Wallet;
use App\Brand;
use App\Newslatters;
use App\OrderItem;
use Session;
use Auth;
use DB;
use Mail;
use App\Prescription;
use App\ConsultationTransaction;
use App\ConsultationHistory;
use App\ContactUs;
use App\DeTransaction;
use App\Http\Controllers\UI\UserController;
use App\Refer_code;
use App\ProductAttribute;
use PDF;

class MainController extends Controller
{
       public function checkaddress(Request $request){  

             $name    =  $request->name; 
             $location = DB::table("locations")->where("location_name",$name)->count(); 
             $request->session()->put('set_location_name', $name );
             if($location > 0){
                $request->session()->put('location_name', $name );
             }else{
                 $request->session()->put('location_name', 'notfound' );
             }
             
            
             return $location; 
    }
    public function checkcheckoutaddress(Request $request){  

             $name    =  $request->name;
             $location = DB::table("locations")->where("location_name",$name)->count();
             $request->session()->put('set_location_name', $name );
             if($location > 0){
                $request->session()->put('location_name', $name );
             }else{
                 $request->session()->put('location_name', 'notfound' );
                 $session = Session::getId();
                 DB::Select(DB::raw("delete from temp_carts where session_id='".$session."' and (type=2 || type=3)"));
                 if(Auth::check()){
                    DB::Select(DB::raw("delete from carts where user_id='".Auth::id()."' and (type=2 || type=3)"));
                 }
             }
             return $location; 
    }
    public function homePage(Request $request){  
        // $latitude = 26.4947;
        // $longitude =  77.9940;
        // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";
        // $geocodeResponseData = file_get_contents($googleMapUrl);
        // $responseData = json_decode($geocodeResponseData, true);
        // if($responseData['status']=='OK') 
        // {  
        //     foreach ($responseData['results'][0]['address_components'] as $r) { 
        //         if ($r['types'][0]== 'locality') {
        //             $city = $r['long_name'];
        //             break;   
        //         } 
        //     }  
           
        // } 
        // session(['city'=>$city]); 
        
        if(empty($request->session()->get('location_name'))){
            $request->session()->put('location_name', 'no_location');
            $data['session']= '';
        }else{
            $data['session']= $request->session()->get('location_name');
        }
         
        // $data['location'] = Location::get(); 
        $data['banner1'] = Banner::where('page_name','homepage')->where('status',0)->get();
        $data['category'] = Category::where('category_name','!=' , null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
        $data['save_more_category'] = Category::where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','desc')->get();
        $data['doctor'] = UserDetail::where('role_id' , 1)->where('status',0)->orderBy('user_details_id','desc')->get();
        $data['top_selling_product'] = Product::where('categories', '!=', 15)->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('top_selling_product' , '!=', null)->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
        $data['top_selling_product1'] = Product::where('categories', 285)->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
    	$data['blog'] = Blog::where('status',0)->orderBy('blogs_id','desc')->get();
        $data['packages'] = Package::where('status',0)->where('package_type',1)->orderBy('id','desc')->get();
        $data['testimonial'] = Testimonial::where('status',0)->orderBy('testimonials_id','desc')->get();
        // dd($data['top_selling_product1']);

        //new code
        // 1st Tab
        $data['all_product']  = DB::table('products')
        ->leftjoin('product_images', 'products.products_id', '=', 'product_images.products_id')
        ->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')           
        ->select('products.*', 'product_images.product_images_id','product_images.product_image','product_images.type', 'product_attributes.id', 'product_attributes.price','product_attributes.special_price')
        ->where('products.status',0)
        ->where('products.categories',14)
        ->groupBy('product_attributes.products_id')
        ->orderBy(DB::raw('RAND()'))->take(12)
        ->get();

        // dd($data['all_product']);

         // 2nd tab
         $data['sale_product']  = DB::table('products')
         ->join('product_images', 'products.products_id', '=', 'product_images.products_id') 
         ->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')          
         ->select('products.*', 'product_images.*', 'product_attributes.id', 'product_attributes.price','product_attributes.special_price')
         ->where('products.status',0)
        //  ->where('products.categories',14)
         ->where('product_attributes.special_price', '!=', null)
         ->groupBy('product_attributes.products_id')
         ->orderBy(DB::raw('RAND()'))->take(12)
         ->get();



        // 3rd tab
        $data['off_product']  = DB::table('products')
        ->join('product_images', 'products.products_id', '=', 'product_images.products_id')  
        ->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')         
        ->select('products.*', 'product_images.*', 'product_attributes.id', 'product_attributes.price','product_attributes.special_price')
        ->where('products.status',0)
        // ->where('products.categories',14)
        ->where('product_attributes.special_price', '!=', null)
        ->groupBy('product_attributes.products_id')
        ->orderBy(DB::raw('RAND()'))->take(12)
        ->get();

        
         // 4th Tab
         $data['trending_product']  = DB::table('products')
         ->join('product_images', 'products.products_id', '=', 'product_images.products_id') 
         ->join('order_items', 'products.products_id', '=', 'order_items.prod_id')  
         ->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')     
        //  ->select('products.*', 'product_images.*', 'COUNT(order_items.prod_id) AS Maxvisit')
         ->select(array('products.*', 'product_images.*','product_attributes.id', 'product_attributes.price','product_attributes.special_price', DB::raw('COUNT(order_items.prod_id) as Maxvisit')))
        //  ->where('products.status',0)
        // ->where('products.categories',14)
         ->groupBy(['order_items.prod_id']) // should group by primary key
        ->orderByDesc('Maxvisit')
        ->take(12) // 12 best-selling products
        ->get();


       

        // 5rd tab
        $data['new_product']  = DB::table('products')
        ->join('product_images', 'products.products_id', '=', 'product_images.products_id')           
        ->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')         
        ->select('products.*', 'product_images.*', 'product_attributes.id', 'product_attributes.price','product_attributes.special_price')
        ->where('products.status',0)
        // ->where('products.categories',14)
        ->orderBy('products.products_id', 'desc')->take(12)
        ->groupBy('product_attributes.products_id')
        ->get();
        // dd($data['new_product']);


        $data['brand'] = DB::table('brands')->where('status',0)->get();
        $data['top_featured_product'] = Product::where('categories', '!=', 15)->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('featured_product' , '!=', null)->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(6)->get();
        $data['sexual_wellness_product'] = Product::where('categories',285)->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(6)->get();
        $data['promotional_home_page'] = Banner::where('type',"promotional")->where('show_on' ,"web")->where('location',"middle")->get();
        $data['blog_home'] = Blog::where('status',0)->orderBy(DB::raw('RAND()'))->take(9)->get();
        // dd($data['top_featured_product']);
        return view('UI/webviews.main_home_page',$data);
        // return view('UI/webviews.coming_soon');
    } 
    
    public function productFilter3(Request $req , $categories_id , $subcategories = null ,$subsubcategories = null ,$subsubsubcategories = null){
        // dd($req);
        $data['maxValue'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->max('price'); 
        // dd($data['maxValue']);
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $data['parameter'] = [$categories_id , $subcategories ,$subsubcategories ,$subsubsubcategories]; 
        $minpr = $req->minpr;  
        $maxpr = $req->maxpr; 
        $tags = !empty($req->tags);    
        $brand = !empty($req->brand)?$req->brand:[]; 
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort; 
        $subcategories = (int) $subcategories;
        $subsubcategories = (int) $subsubcategories;
        $subsubsubcategories = (int) $subsubsubcategories;
        // dd($categories_id,$subcategories,$subsubcategories,$subsubsubcategories);
    //dd();
        $data['page'] = $req->all();
        
        $data['r'] = Category::where('categories_id', $categories_id)->where('category_name','!=' , null)->where('status',0)->first();
		//echo '<pre>'; print_r($data); exit;
        if($subcategories == null){
            $subcategories = Category::where('parent_id', $categories_id)->where('categories.status',0)->select('categories_id')->get();
            //dd($subcategories);
        }

        if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){  
            $parent = [];
            foreach($subcategories as $r) {
                $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('categories.status',0)->select('categories_id')->get(); 
            }  
        }   
        if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){  
            $parent1 = [];
            foreach($subsubcategories as $r1) {
                $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('categories.status',0)->select('categories_id')->get(); 
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
           
        // dd($categories_id,$subcategories,$subsubcategories,$subsubsubcategories);
        $data['product'] = Product::where('categories',$categories_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
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
        ->where('products.status',0)->orderBy('price',$sortP)->paginate(20);   
        // dd($data['product']); 
        $slugCreator = 'category/';
        //dd($data['parameter']);
        foreach($data['parameter'] as $cat_id){
            if($cat_id){
                $category = Category::find($cat_id);
               $catSlug = $category->slug;
               if($catSlug)
                   $slugCreator .= $catSlug .'/';
            }
        }
        //return redirect($slugCreator);
    	
        return view('UI/webviews.main_product_page')->with('data', $data)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);   
    }  
    /**
     * Category by slug
     */
    public function productFilterSlug(Request $req , $slug , $slug1 = null ,$slug2 = null ,$slug3 = null){
        // dd($req);
        $data['maxValue'] = Product::max('price'); 
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $data['parameter'] = [$slug , $slug1 ,$slug2 ,$slug3]; 
        $minpr = $req->minpr;  
        $maxpr = $req->maxpr; 
        $tags = !empty($req->tags);    
        $brand = !empty($req->brand)?$req->brand:[]; 
        $price = $req->price;
        // dd($req->price);
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort; 
        $data['page'] = $req->all();
        // $categories_id = (int) Category::where('slug', $slug)->first();
        $categories_id = $req->categories_id;
        // dd( $categories_id);
        $subcategories = 0;
        $subsubcategories = 0;
        $subsubsubcategories = 0;
        if($slug1){
            $subcategories = (int) Category::where('slug',$slug1)->first();
        }
        if($slug2){
            $subsubcategories = (int) Category::where('slug',$slug2)->first();
        }
        if($slug3){
            $subsubsubcategories = (int) Category::where('slug',$slug3)->first();
        }
        
        // $data['r'] = Category::where('slug', $slug)->where('category_name','!=' , null)->where('status',0)->first();
        $data['r'] = Category::where('categories_id', $categories_id)->where('category_name','!=' , null)->where('status',0)->first();
        // dd( $data['r']);
		//echo '<pre>'; print_r($data); exit;
        if($subcategories == null){
            $subcategories = Category::where('parent_id', $categories_id)->where('status',0)->select('categories_id')->get();
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

        //dd($slug2 , $slug3);
        if (!is_array($subcategories) && is_int($subcategories)) { 
            //dd($slug1);
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

        //dd($brand,$rating,$tags,$minpr ,$maxpr ,$sortP);
        $data['product'] = Product::where('categories',$categories_id)
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
            ->where(function($query) use ($brand){
            if (!empty($brand)) {
                return $query->whereIn('brand',$brand);
            }}) 

            //**************  filter by Price 

            ->where(function($query) use ($price){
                if (!empty($price)) {
                    if($price == "1"){
                    return $query->whereBetween('price',array(10, 100));  
                    }elseif($price == "2"){
                        return $query->whereBetween('price',array(100, 200));
                    }elseif($price == "3"){
                        return $query->whereBetween('price',array(200, 300));
                    }elseif($price == "4"){
                        return $query->whereBetween('price',array(300, 400));
                    }elseif($price == "5"){
                        return $query->whereBetween('price',array(400, 1000000));
                    }else{}
                                
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
        ->where('status',0)->orderBy('price',$sortP)->paginate(20); 
    	
        return view('UI/webviews.main_product_page')->with('data', $data)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);   
    }

    public function productDetail($products_id){ 
        $data['product'] = Product::where('products.products_id',$products_id)->first();
        $data['top_selling_product'] = Product::where('top_selling_product' , '!=', null)->where('products.status',0)->orderBy(DB::raw('RAND()'))->take(30)->get(); 
        // dd( $data['product']);
        //new code rahul
        Session::put('product_id1', $products_id);
        
        if(!empty($data['product'])){
            if(isset($data['product']->slug)){
                $category  = str_slug(Category::find($data['product']->categories)->category_name,'-');
                
                return redirect($data['product']->slug);
            }
            return view('UI/webviews.main_product_detail_page',$data); 
        }else{
            return view('UI/components.product_error'); 
        }
    } 

    public function productDetailSlug(Request $req, $slug){
        // dd($req);
        $data['product'] = DB::table('products')->select('product_attributes.*','products.*')->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('slug',$slug)->first();
        // dd($data['product']);
        // $data['attributes'] = ProductAttribute::where('products_id', $data['product']->products_id)->get();
        $data['attributes'] = DB::table('product_attributes')
                ->join('sizes', 'sizes.id', '=', 'product_attributes.product_size')
                // ->select('product_attributes.*','sizes.*')
                ->select('product_attributes.*','sizes.size_name', 'sizes.id As size_id')
                ->where('products_id', $data['product']->products_id)
                ->get();
        // dd($data['attributes']);
        $data['top_selling_product'] = Product::where('top_selling_product' , '!=', null)->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get(); 
        if(!empty($data['product'])){
            if($req->refer_code){
                $key = 'refer_code_'.$data['product']->products_id;
                // session = ['refer_code_11'=> 'SXERS34']
                Session::put($key,$req->refer_code);
                if(Auth::id()){
                    $userController = new UserController();
                    $userController->removeInvalidReferCodes();
                    $refer_code = Refer_code::where('refer_code',$req->refer_code)->first();
                    if(isset($refer_code)){
                        $from = $refer_code->user_id;
                        $to = Auth::id();
                        //2%$ of ammount => 
                        $product_attribute = ProductAttribute::where('products_id',$refer_code->product_id)->first();
                        if($product_attribute->special_price){
                        $price = $product_attribute->special_price;
                        }else{
                            $price = $product_attribute->price;
                        }
                        // dd($price);
                        $coin = (round(($price/100)*2));
                        
                        $userController->deWalletTransaction($from,$to,'refer',$coin,$refer_code->refer_code,'Viewed');
                        $userController->deWalletTransaction($to,$from,'company',$coin,$refer_code->refer_code,'Pending');
                    }
                }
            } 
            return view('UI/webviews.main_product_detail_page',$data); 
        }else{
            return view('UI/components.product_error'); 
        }
    }


    public function doctorListing(Request $req){  
        $data['flag'] = 1;
        $data['page'] = $req->all(); 
        $data['feedbacks'] = DoctorFeedback::where('doctor_id' , $req->id)->count();
        $data['doctor'] = UserDetail::where('role_id' , '!=' , null)->where('status',0)->orderBy(DB::raw('RAND()'))->get();
        return view('UI/webviews.doctor.manage_doctor',$data); 
    }

    public function doctorDetails(Request $req){  
        $data['flag'] = 2; 
        $data['feedbacks'] = DoctorFeedback::where('doctor_id' , $req->id)->get();
        $data['doctor'] = UserDetail::where('user_details_id' , $req->id)->first();
        return view('UI/webviews.doctor.manage_doctor',$data); 
    }

    public function uploadPrescription($type){ 
        $data['flag'] = 1;
        $user_id = Auth::id(); 
        $prescription_list = [];
        
        $temp_prescription_list = Prescription::where('user_id', $user_id)->where('prescription_type', $type)->get();
        if($temp_prescription_list) {
            $prescription_list = $temp_prescription_list->toArray();
        }
        $data['user_id'] = $user_id;
    	$data['type'] = $type;
        $data['prescription_list'] = $prescription_list;
        return view('UI/webviews/order_prescription',$data);
    }
   public function aboutUs()
    {
        $data['flag'] = 1; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    public function privacyPolicy()
    {
        $data['flag'] = 2; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function contactUs()
    {
        $data['flag'] = 3; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

     public function blog(Request $req)
    {   
        $data['page'] = $req->all();
        $data['flag'] = 4;
        $data['blog'] = Blog::where('status',0)->orderBy('blogs_id','desc')->paginate(9);   
        return view('UI/webviews.user.manage_pages',$data); 
    }
    public function refundPolicy()
    {
        $data['flag'] = 5; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function returnPolicy()
    {
        $data['flag'] = 6; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function cancellationPolicy()
    {
        $data['flag'] = 7; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function termCondition()
    {
        $data['flag'] = 8; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function disclaimer()
    {
        $data['flag'] = 9; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    public function appContactUs()
    { 
        return view('UI/components.user.app_contact_us'); 
    }
    public function appTermCondition()
    { 
        return view('UI/components.user.app_term_condition'); 
    }
    public function appPrivacyPolicy()
    { 
        return view('UI/components.user.app_privacy_policy'); 
    }
	 public function appReturnPolicy()
    { 
        return view('UI/components.user.app_return_policy'); 
    }
    public function addPrescTocheckout(Request $req)
    {
        return redirect('/checkout1/'.$req->user_id.'/'.$req->prescription_list);
    }
    
    public function saveWallet(Request $req)
    {
        $totalAmt = 0;
        if(!empty($req->user_id) && $req->user_id > 0) {
            $wallet_details = DB::table('wallets')->where('user_id', Auth::user()->id)->first();
            if(empty($wallet_details)) {
                $wallet = new Wallet;
                $wallet->user_id = $req->user_id;
                $wallet->amount = $req->amount; 
                $totalAmt = $req->amount;
                $wallet->save();
            } else {
                $alAmt = (int) $wallet_details->amount;
                $currentAmt = (int) $req->amount;
                $totalAmt = $alAmt+$currentAmt;
                Wallet::where('user_id',$req->user_id)->update([
                'amount'=>$totalAmt
                ]);
            }

            $doctor = UserDetail::where('user_id', $req->doc_id)->first();
            $cunsultRes = ConsultationTransaction::where('user_id', $req->user_id)->where('doc_id', $req->doc_id)->orderBy('id', 'DESC')->first();

            
            if(empty($cunsultRes)) {
                $cultTxn = new ConsultationTransaction();
                $cultTxn->user_id = $req->user_id;
                $cultTxn->doc_id = $req->doc_id; 
                $cultTxn->consultation_credit = $doctor->number_of_consultation; 
                $cultTxn->save();

                $rest_amount = $totalAmt - (int) $doctor->consultation_fees;

                Wallet::where('user_id',$req->user_id)->update([
                'amount'=>$rest_amount
                ]);

            }
            
            return back();
        } else {
            return back();
        }
    }

    public function callToConnect(Request $req){
        
        try {
            
            $consult = explode("#", $req->consult_call);
             
            $user = UserDetail::where('user_id', $consult[0])->first();
            $doc = UserDetail::where('user_id', $consult[1])->first();
            
            if(!empty($user->mobile) && !empty($doc->mobile)) {
                $curl = curl_init();
    
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://panelv2.cloudshope.com/api/click_to_call?from_number=".$user->mobile."&to_number=".$doc->mobile,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS =>"{}",
                  CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer BUCt3btReSZWV7aS0648huzhEpm8P75JXOkHImcZhSx83zZtxFO97S6H3qG3ziFqbCqQRk8Ze8yMeEwa"
                  ),
                ));
                $error_msg = '';
                $response = curl_exec($curl);
                if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
                }
    
                curl_close($curl);
                if(!empty($error_msg) ){
                    echo '2';
                  
                } else {
    
                    $consultDetail = explode("#", $req->consult_call);
                    $data = json_decode($response, true);
                    
                    if($data['status']!="failed") {
                    
                        $culthst = new ConsultationHistory();
                        $culthst->user_id = $consultDetail[0];
                        $culthst->doc_id = $consultDetail[1]; 
                        $culthst->status = '1';
                        $culthst->type = '2'; 
                        $culthst->save();
        
                        $credit = (int) $consultDetail[2];
                        $cultTxn = new ConsultationTransaction();
                        $cultTxn->user_id = $consultDetail[0];
                        $cultTxn->doc_id =  $consultDetail[1];
                        $cultTxn->consultation_credit = $credit-1;
                        $cultTxn->type = '2';  
                        $cultTxn->save();
                    
                        echo '1';
                    } else {
                       echo '2';
                    }
                    
                }
            } else {
                echo '2';
            }
            exit;
            
        } catch(Exception $e){
            echo '2';
            exit;
        }
    }
    /**
     * @input form
     * @param Request $request
     */
    
    public function submitContactUs(Request $request){
        
         $culthst = new ContactUs();
                $culthst->name	 = $request->name;
                $culthst->email =  $request->email;
                $culthst->phone_number	 = $request->phone_number;
                $culthst->message =  $request->message;
                $culthst->save();
    			//enter data to crm
    			$lmsData = array(
               'company' => 'aensahealthsolution',
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone_number,
               'location' => 'na',
               'message' => $request->message,
               'lead_source' => 4,
               'division' => 1,
                );
         
           $url = "http://192.168.100.3:80/contact-form-leads";
          
            $curl = curl_init();
            $url = sprintf("%s?%s", $url, http_build_query($lmsData));
           
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            $result = curl_exec($curl);
 			// dd($result);
                //fire mail to support
                 $to = $request->email;
                   $to_name = $request->name;
                $data = array('user'=>$culthst->name);
                 $to_email = $request->email;
            $subject = 'WelCome In DHD';
            $message = "Dear ".$request->name.", \n. Thanking you for contact us we will contact you shortly!";
            $headers = 'From:$request->email';        
           
            
            Mail::send('emails.user_contact_mail', $data, function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)
                    ->subject('Submiting Contact-Us In DHD');
                    $message->from('support@drhelpdesk.in','Drhelpdesk');
                });

                $phone = $request->phone_number;
                $message =$request->message;

                $phone = $request->phone_number;
                $message1 =$request->message;

                        $to = 'anujrathoure9889@yahoo.com';
                         $subject = 'Contact Us From   DHD';
                         $message = "Contact us information from Website \n name : ".$to_name." and \nmail : ".$to_email." \nmobile no : ".$phone." and \nmessage is : ".$message1;
                    Mail::send('emails.approve', ['msg' => $message], function($message) use ($to) {
                        $message->to($to)
                        ->subject('Registration In DHD');
                        $message->from('support@drhelpdesk.in','Drhelpdesk');
                    }); 
   
 
        return back()->with('msg', 'Thanks for Contact us , We will contact you Soon.');
    }
    
    /**
     * @view page for brand
     */
    public function brands(Request $req){
        $data['flag'] = 10; 
        $data['page'] = $req->all(); 
        $data['brands'] =  DB::table('brands')->where('status',0)->paginate(16); 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function submitNewslatter(Request $request){
        $n = new Newslatters();
                $n->newslatter_email =  $request->get('newslatter_email');
                $n->save();
                return 1;
    }
    
    public function deliveryInfo(){
         $data['flag'] = 11; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    
     public function storeLocation(){
         $data['flag'] = 12; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    /*
     * get Invoice
     */
    public function userInvoice($order_id){
        $userDetail = Auth::user();
         $orderDetails = DB::table('orders')->where('order_id', $order_id)->first();
         $orders = OrderItem::where('order_id',$order_id)->get(); 
       $orderStatus = DB::table('order_status')->get(); 
        
         return view ('UI/webviews.user_invoice')
                ->with('userDetail',$userDetail)
                ->with('orderDetails',$orderDetails)
                ->with('order',$orders)
                ->with('orderStatus',$orderStatus);
    }
    
    public function cunsultNow(Request $req)
    {
        $consult_data = explode("#", $req->consult_ids);
       
        $doctor = UserDetail::where('user_id', $consult_data[1])->first();
        $wallet_details = DB::table('wallets')->where('user_id', $consult_data[0])->first();
        $cultTxn = new ConsultationTransaction();
        $cultTxn->user_id = $consult_data[0];
        $cultTxn->doc_id = $consult_data[1]; 
        $cultTxn->consultation_credit = $doctor->number_of_consultation; 
        $cultTxn->save();

        $rest_amount = $wallet_details->amount - (int) $doctor->consultation_fees;

        Wallet::where('user_id',$consult_data[0])->update([
        'amount'=>$rest_amount
        ]);
        
        echo 1;
        exit;
    }
	/**
     * TODO:: Remove ID route from frontend and use slug route
     * simply hostname/{slug}  => slug for blogs
     * Replace blogDetailsSlug method with blogDetails
     */
	public function blogDetails($id){
        $data['flag'] = 13;
        $data['blog'] = Blog::where('blogs_id',$id)->first();
        return redirect('blogs/'.$data['blog']->slug);
        return view('UI/webviews.user.manage_pages', $data); 
    }

    public function blogDetailsSlug($slug){
        $data['flag'] = 13;
        $data['blog'] = Blog::where('slug',$slug)->first();
   		
        return view('UI/webviews.user.manage_pages', $data); 
    }

	public function searchData(Request $req){
        // dd($req);
        if($req->homesearch != null) {
            $data['page'] = $req->all();  

            $data['maxValue'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->max('price'); 
            $ptags = DB::table('products')->select('tags')->get();
            $mainTags =  ''; 
            foreach($ptags as $tags){
                  $mainTags =   $tags->tags.',';
            }
            $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
            //dd($mainTags);  
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
            $form_search = $req->homesearch;
            //dd(json_decode(json_encode($subcategories)));
            $data['product'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id') 
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
            ->where(function($query) use ($form_search){
            if(!empty($form_search)) {
                return $query->where('product_name', 'LIKE', "%$form_search%")->orwhere('brand', 'LIKE', "%$form_search%")->orwhere('short_description', 'LIKE', "%$form_search%")->orwhere('long_description', 'LIKE', "%$form_search%")->orwhere('key_features', 'LIKE', "%$form_search%")->orwhere('product_code', 'LIKE', "%$form_search%")->orwhere('tags', 'LIKE', "%$form_search%");
                
            }}) 
            ->where('products.status',0)->orderBy('price',$sortP)->paginate(20);  

            
            // dd($data);            
          // if(!empty($data['product'])) {
          // 		if(count($data['product']) == '1') {
          //       	return redirect('/product-detail/'.$data['product'][0]['products_id']);
          //       } else {
          //       	return view('UI.components.product_listing_search_page')->with('data', $data)->with('form_search', $form_search)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);    
          //       }
          // }
        //   dd($data['product'][0]);
            if($data['product'][0]){
          	if($data['product'][0]['categories']  == '15') {
                if(count($data['product']) == '1') {
                    return redirect('/lab-test-detail/'.$data['product'][0]['products_id']);
                }else {
                    return view('UI.components.product_listing_search_page')->with('data', $data)->with('form_search', $form_search)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);    
                }
            }else{
          		if(count($data['product']) == '1') {
                	return redirect('/product-detail/'.$data['product'][0]['products_id']);
                }else {
                	return view('UI.components.product_listing_search_page')->with('data', $data)->with('form_search', $form_search)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);    
                }
            }
        }
            return view('UI.components.product_listing_search_page')->with('data', $data)->with('form_search', $form_search)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);    
        }else{
            return redirect('/');
        }
    }
	public function searchProductFilter3(Request $req , $categories_id , $subcategories = null ,$subsubcategories = null ,$subsubsubcategories = null){  
        if($req->homesearch != null) {
            $data['page'] = $req->all(); 
             $data['parameter'] = [$categories_id , $subcategories ,$subsubcategories ,$subsubsubcategories]; 
            
           
            $data['maxValue'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->max('price'); 
            $ptags = DB::table('products')->select('tags')->get();
            $mainTags =  ''; 
            foreach($ptags as $tags){
                  $mainTags =   $tags->tags.',';
            }
            $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
            //dd($mainTags);
            $data['parameter'] = [$categories_id , $subcategories ,$subsubcategories ,$subsubsubcategories]; 
            $minpr = $req->minpr;  
            $maxpr = $req->maxpr; 
            $tags = !empty($req->tags);    
            $brand = !empty($req->brand)?$req->brand:[]; 
            $rating = !empty($req->rating)?$req->rating:[];
            $price_sort = $req->price_sort; 
            $subcategories = (int) $subcategories;
            $subsubcategories = (int) $subsubcategories;
            $subsubsubcategories = (int) $subsubsubcategories;
            $data['page'] = $req->all();
        
            $data['r'] = Category::where('categories_id', $categories_id)->where('category_name','!=' , null)->where('status',0)->first();

            if($subcategories == null){
                $subcategories = Category::where('parent_id', $categories_id)->where('status',0)->select('categories_id')->get();
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

            //dd(json_decode(json_encode($subcategories)));
            $data['product'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('categories',$categories_id)
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
             ->where('product_name', 'LIKE', "%$req->keyword%")->orWhere('brand', 'LIKE', "%$req->keyword%")->orWhere('short_description', 'LIKE', "%$req->keyword%")->orWhere('long_description', 'LIKE', "%$req->keyword%")->orWhere('key_features', 'LIKE', "%$req->keyword%")->orWhere('product_code', 'LIKE', "%$req->keyword%")->orWhere('tags', 'LIKE', "%$req->keyword%")->where('products.status',0)->orderBy('price',$sortP)->paginate(20);      
            //dd($data['product']); 
            return view('UI.components.product_listing_search_page')->with('data', $data)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);    
        }else{
            return redirect('/');
        }
    }
	public function index(Request $req)
    {
        return view('UI/components/search');
    }
	public function getProductList(Request $req)
    {
        return $req;
        $prod_array = [];
        $form_search = $req->term;
        $product = Product::where('product_name', 'LIKE', "%$form_search%")->orwhere('brand', 'LIKE', "%$form_search%")->orwhere('short_description', 'LIKE', "%$form_search%")->orwhere('long_description', 'LIKE', "%$form_search%")->orwhere('key_features', 'LIKE', "%$form_search%")->orwhere('product_code', 'LIKE', "%$form_search%")->orwhere('tags', 'LIKE', "%$form_search%")->get();
        dd($product);
        foreach($product as $key=>$val) {
            array_push($prod_array, $val->product_name); 
        }
          
        return response()->json($prod_array);
    }

	public function chatMobileView($id){ 
        $data['flag'] = 2;
        $data['user_id'] = $id;
        return view('UI/webviews/user.manage_chat',$data);
    }

	public function comingSoonPage(){  
        return view('UI/webviews/coming_soon');
    }
	
	public function downloadUserInvoice($order_id){ 
         $orderDetails = DB::table('orders')->where('order_id', $order_id)->first();
         $orders = OrderItem::where('order_id',$order_id)->get(); 
       	 $orderStatus = DB::table('order_status')->get();  
    	$data['orderDetails'] = $orderDetails;
    	$data['order'] = $orders;
    	$data['orderStatus'] = $orderStatus;
        $pdf = PDF::loadView('UI/webviews.download_invoice', $data);
        return $pdf->download('invoice.pdf');
    }
	 public function productByBrand(Request $req , $categories_id){
        //dd($req);
        $data['maxValue'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->max('price'); 
        // dd($data['maxValue']);
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $data['parameter'] = [$categories_id]; 
        $minpr = $req->minpr;  
        $maxpr = $req->maxpr; 
        $tags = !empty($req->tags);    
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort;  
        $data['page'] = $req->all(); 
        if (!is_array($rating) && is_int($rating)  && $rating > 0 ) { 
            $rating = (array) $rating;
        }
        if (!is_array($tags) && is_int($tags)  && $tags > 0 ) { 
            $tags = (array) $tags;
        } 
        if (!empty($price_sort) && $price_sort == 1) {
               $sortP = 'desc';
        }else{
             $sortP = 'asc';
        } 
        $form_search = $categories_id;
        $data['product'] = Product::leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('brand',$categories_id) 
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
        ->where('products.status',0)->orderBy('price',$sortP)->paginate(20);   
            return view('UI.components.product_listing_by_brand')->with('data', $data)->with('form_search', $form_search)->with('sortP',$sortP)->with('tags' ,$tags)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);  
    }

    public function setlocation(Request $request){  
        $name    =  $request->location; 
        $location = DB::table("locations")->where("location_name",$name)->count(); 
        $request->session()->put('set_location_name', $name );
        if($location > 0){
           $request->session()->put('location_name', $name );
        }else{
            $request->session()->put('location_name', 'notfound' );
        }
        
       
        return $location; 
}

// new code
public function logout(Request $request) {
    Auth::logout();
    Session::flush();
    return redirect('/');
  }

public function homesubmitContactUs(Request $request)
{
  //  echo $request;

   $this->validate($request,[
      'Name'=>'required|alpha',
      'Number'=>'required|numeric',
      'Email'=>'required|email',
      'Message'=>'required'
   ]);
   }

   public function getattributeinfo(Request $req){
    //    return $req;
    $data['attributes'] = ProductAttribute::where('id', $req->attribute_id)->get();
    return $data;
   }
   public function getproductdetailinmodel(Request $req){
    $data['product'] = DB::table('products')->select('product_attributes.*','products.*','product_images.*')->join('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                                                ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                                                ->where('products.products_id',$req->products_id)
                                                ->where('product_images.type', 2)
                                                ->first();
    return $data;
   }
}