<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'categories_id';

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function child(){

        return $this->hasMany('App\Category', 'parent_id')->with('child');

    }
    /**
     * TODO: Remove if client is not convienced for category changes
     * Usage: use if and only if category hirarchy followed
     */
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }
    /**
     * TODO: Remove if client is convienced for category changes
     * Usage: Category structure for this system
     */
    public function getSubParents(){
        $parents = collect([]);
        $parent_id = $this->parent_id;
        $sub_parent_id = $this->sub_parent_id;
        $sub_sub_parent_id = $this->sub_sub_parent_id;

        if($parent_id && $sub_parent_id && $sub_sub_parent_id){
            $self = str_slug($this->title,'-');
            $level_one = Category::find($parent_id) ? Category::find($parent_id)->title : '';
            $level_two = Category::find($sub_parent_id) ? Category::find($sub_parent_id)->title : '';
            $level_three = Category::find($sub_sub_parent_id) ? Category::find($sub_sub_parent_id)->category_name : '';
            $slug = '';
            if($level_three){
                $slug = $slug.'/'.str_slug($level_three,'-') ;
            }
            if($level_two){
                $slug = $slug.'/'.str_slug($level_two,'-');  
            }
            if($level_one){
                $slug = $slug.'/'.str_slug($level_one,'-');  
            }
            if($self){
                $slug = $slug.'/'.str_slug($self,'-');  
            }
            return $self ? substr($slug,1) : false;
        }elseif($parent_id && $sub_parent_id){
            $self = $this->title;
            $level_one = Category::find($parent_id) ? Category::find($parent_id)->title : '';
            $level_two = Category::find($sub_parent_id) ? Category::find($sub_parent_id)->category_name : '';
            $slug = '';
            if($level_two){
                $slug = $slug.'/'.str_slug($level_two,'-');  
            }
            if($level_one){
                $slug = $slug.'/'.str_slug($level_one,'-');  
            }
            if($self){
                $slug = $slug.'/'.str_slug($self,'-');  
            }
            return $self ? substr($slug,1) : false;
        }elseif($parent_id){
            $self = $this->title;
            $level_one = Category::find($parent_id) ? Category::find($parent_id)->category_name : '';
            $slug = '';
            if($level_one){
                $slug = $slug.'/'.str_slug($level_one,'-');  
            }
            if($self){
                $slug = $slug.'/'.str_slug($self,'-');  
            }
            return $self ? substr($slug,1) : false;
        }
    }
}
