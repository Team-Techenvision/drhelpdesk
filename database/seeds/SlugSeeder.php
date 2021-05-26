<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Brand;
use App\Blog;
use App\Product;
use App\Package;
use App\Banner;

class SlugSeeder extends Seeder
{
    private $tables = [
        'blogs' => 'blog_title',
        'categories' => 'category_name',
        'products' => 'product_name',
        'packages' => 'package_name',
        'brands' => 'brand_name',
        'banners' => 'banner_name',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->tables as $key => $tab){
            $model = null;
            
            switch($key){
                case 'categories':
                    $model = new Category();
                    break;
                case 'blogs':
                    $model = new Blog();
                    break;
                case 'products':
                    $model = new Product();
                    break;
                case 'packages':
                    $model = new Package();
                    break;
                case 'brands':
                    $model = new Brand();
                    break;
                case 'banners':
                    $model = new Banner();
                    break;
            }
            if($model){
                $data = $model->where('slug', '=', '')->orWhereNull('slug')->get();
                foreach($data as $d){
                    $slug = $this->generateSlug($key,$model,$d);
                    if($slug){
                        $d->update(['slug' => $slug]);
                    }
                }
            }
            
        }
        
    }

    /**
     * Generate Slug
     * @param String $table
     * @param Collection $item
     * @return String
     */
    public function generateSlug($table, $model, $item){
        
        if($table === 'categories'){
            $slug = $this->getTree($item);
        }else{
            $item = json_encode($item);
            $item = json_decode($item, true);
            $slug = str_slug($item[$this->tables[$table]],'-');
        }
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

    /**
     * Get tree structure of given category based on parent_id
     * @param Collection $item
     */
    public function getTree($item){
        $isParent = true;
        if($isParent){
            $item = json_encode($item);
            $item = json_decode($item, true);
            $slug = $item[$this->tables['categories']];
            if(!$slug){
                $slug = $item['title'];
            }
            return str_slug($slug,'-');
        }else{
            $slug = $item->getSubParents();
            return $slug; 
        }
    }
}
