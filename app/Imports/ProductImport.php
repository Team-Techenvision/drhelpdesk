<?php
   
namespace App\Imports;
   
use App\Product;
use App\ProductAttribute;
use App\Brand;
use App\Vendor;
use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
    
class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // dd($row);
        if(Product::where('product_code', $row['product_code'])->count() > 0 ){
            $product = Product::where('product_code', $row['product_code'])->first();
            $product->update([
                'product_name'          => $row['product_name'],
                'slug'                  => $this->generateSlug(new Product(), $row['product_name']), 
                'product_code'          => $row['product_code'],
                // 'price'                 => $row['price'],
                // 'special_price'         => $row['special_price'], 
                // 'quantity'              => $row['quantity'],
                // 'extra_discount'        => $row['extra_discount'],
                'key_features'          => $row['key_features'], 
                'short_description'     => $row['short_description'],
                'long_description'      => $row['long_description'],
                'brand'                 => $this->getBrand($row['brand']), 
                'prescription'          => $row['prescription'],
                'categories'            => $this->getCategory($row['categories']),
                'sub_categories'        => $this->getCategory($row['sub_categories']), 
                'sub_sub_categories'    => $this->getCategory($row['sub_sub_categories']),
                'sub_sub_sub_categories'=> $this->getCategory($row['sub_sub_sub_categories']),
                'featured_product'      => $row['featured_product'],
                'top_selling_product'   => $row['top_selling_product'],
                'vendor_id'             => $this->getVender($row['vendor']),
                'tags'                  => $row['tags'],
                'gst_id'                => $row['gst_id'],
                'rating'                => $row['rating'],
                'status'                => $row['status'],
                'app_key_features'      => $row['app_key_features'],
                'app_long_description'  => $row['app_long_description'],
                'in_stock'              => $row['in_stock'],
            ]);

            $ProductAttribute = ProductAttribute::where('barcode', $row['barcode'])->first();
            $ProductAttribute->update([
                'products_id'           => $ProductAttribute->products_id,
                'product_size'          => $row['product_size'], 
                'per_stript_qty'        => $row['per_stript_qty'],
                'price_per_pic'         => $row['price_per_pic'],
                'product_color'         => $row['product_color'],
                'barcode'               => $row['barcode'], 
                'manufacturer_price'    => $row['manufacturer_price'],
                'price'                 => $row['price'],
                'quantity'              => $row['quantity'],
                'special_price'         => $row['special_price'],
                'extra_discount'        => $row['extra_discount'], 
                'status'                => $row['status'],
                'in_stock'              => $row['in_stock'],
                'incremental_gst'       => $row['incremental_gst'],
                'multiple_attribute'    => $row['multiple_attribute'],
            ]);
        }else{
            $new_product = new Product([
                'product_name'          => $row['product_name'],
                'slug'                  => $this->generateSlug(new Product(), $row['product_name']), 
                'product_code'          => $row['product_code'],
                // 'price'                 => $row['price'],
                // 'special_price'         => $row['special_price'], 
                // 'quantity'              => $row['quantity'],
                // 'extra_discount'        => $row['extra_discount'],
                'key_features'          => $row['key_features'], 
                'short_description'     => $row['short_description'],
                'long_description'      => $row['long_description'],
                'brand'                 => $this->getBrand($row['brand']), 
                'prescription'          => $row['prescription'],
                'categories'            => $this->getCategory($row['categories']),
                'sub_categories'        => $this->getCategory($row['sub_categories']), 
                'sub_sub_categories'    => $this->getCategory($row['sub_sub_categories']),
                'sub_sub_sub_categories'=> $this->getCategory($row['sub_sub_sub_categories']),
                'featured_product'      => $row['featured_product'],
                'top_selling_product'   => $row['top_selling_product'],
                'vendor_id'             => $this->getVender($row['vendor']),
                'tags'                  => $row['tags'],
                'gst_id'                => $row['gst_id'],
                'rating'                => $row['rating'],
                'status'                => $row['status'],
                'app_key_features'      => $row['app_key_features'],
                'app_long_description'  => $row['app_long_description'],
                'in_stock'              => $row['in_stock'],
            ]);
            $new_product->save();
            // $product_new = Product::where('slug',$new_product->slug)->first();
            // dd($new_product->products_id);

            return new ProductAttribute([
                'products_id'           =>$new_product->products_id,
                'product_size'          => $row['product_size'], 
                'per_stript_qty'        => $row['per_stript_qty'],
                'price_per_pic'         => $row['price_per_pic'],
                'product_color'         => $row['product_color'],
                'barcode'               => $row['barcode'], 
                'manufacturer_price'    => $row['manufacturer_price'],
                'price'                 => $row['price'],
                'quantity'              => $row['quantity'],
                'special_price'         => $row['special_price'],
                'extra_discount'        => $row['extra_discount'], 
                'status'                => $row['status'],
                'in_stock'              => $row['in_stock'],
                'incremental_gst'       => $row['incremental_gst'],
                'multiple_attribute'    => $row['multiple_attribute'],
            ]);
        }
       

    
        
    }

    public function generateSlug($model,$title){
        $slug = str_slug($title,'-');
        if($slug){
            $slugs = $model->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->get();
        }
        
        if(isset($slugs) && $slugs->count() > 0){
            // $count = $count+1;
            // $slug = $slug . '-' . $count;

            // Get the last matching slug
            $lastSlug = $model->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->orderBy('slug', 'desc')->first()->slug;
            
            // Strip the number off of the last slug, if any
            $lastSlugNumber = intval(str_replace($slug . '-', '', $lastSlug));
            return $slug . '-' . ($lastSlugNumber + 1);
        }
        //dd($slug);
        return $slug;
    }

    public function getBrand($name){
        if(!$name){
            return 0;
        }
        $brand = Brand::where('brand_name',$name)->first();
        return $brand ? $brand->id : 0; 
    }
    public function getVender($name){
        if(!$name){
            return 0;
        }
        $vendor = Vendor::where('vendor_name',$name)->first();
        return $vendor ? $vendor->vendors_id : 0; 
    }
    public function getCategory($name){
        if(!$name){
            return 0;
        }
        $category = Category::where('category_name',$name)->orWhere('title',$name)->first();
        return $category ? $category->categories_id : 0; 
    }
}