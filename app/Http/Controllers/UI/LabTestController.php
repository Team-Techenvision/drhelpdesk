<?php

namespace App\Http\Controllers\UI; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Location; 
use App\Testimonial; 
use App\Brand;
use App\Package; 
use App\Vendor;
use App\Product; 
class LabTestController extends Controller{
        
   	Public function popularPackages(){
    	$data['brand'] = Brand::where('parent_id',15)->get();
       $data['packages'] = Package::where('status',0)->where('package_type',1)->orderBy('id','desc')->get();
   		$data['vendor'] = Vendor::orderBy('vendors_id','desc')->where('status',0)->get();
      $data['testimonial'] = Testimonial::where('status',0)->orderBy('testimonials_id','desc')->get();
    	return view('UI.webviews/lab_module/popular_package',$data);
  	}

   	Public function allTest(Request $req){ 
      $data['page'] = $req->all();
      $data['test'] = Product::Join('product_images','products.products_id','product_images.products_id')->where('products.categories',15)->where('product_images.type',2)->select('products.*','product_images.product_image')->orderBy('product_name','asc')->where('status',0)->paginate(10);
      $data['test1'] = Product::Join('product_images','products.products_id','product_images.products_id')->where('products.categories',15)->where('product_images.type',2)->select('products.*','product_images.product_image')->orderBy('product_name','asc')->where('status',0)->get();
    	return view('UI.webviews/lab_module/all-tests',$data);
    }

    Public function testDetail(Request $req){ 
      $data['test'] = Product::where('products_id',$req->id)->first(); 
    	return view('UI.webviews/lab_module/test-detail',$data);
    }

    Public function allPackage(Request $req){ 
        $data['page'] = $req->all(); 
        $data['package'] = Package::orderBy('package_name','asc')->where('status',0)->paginate(12);
    	 $data['package2'] = Package::orderBy('package_name','asc')->where('status',0)->paginate(12);
    
    	return view('UI.webviews/lab_module/all-package',$data);
    }

    Public function packageDetail(Request $req){
      $package = Package::where('id',$req->id)->first();
      $data['pck'] = $package;
      
      if($package->slug){
        return redirect('packages/'.$package->slug);
      }
      return view('UI.webviews/lab_module/package-detail', $data);
    }
    Public function packageDetailSlug(Request $req,$slug){
        $package = Package::where('slug',$slug)->first();
        $data['pck'] = $package;
        return view('UI.webviews/lab_module/package-detail', $data);
    }
}
