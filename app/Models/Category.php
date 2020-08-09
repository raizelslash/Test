<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 protected $fillable=['title','slug','summary','is_parent','parent_id','status','image','added_by'];
 public function getCategoryRules($act='add'){
     $rule=[

         'summary'=>'sometimes|nullable|string',
         'is_parent'=> 'sometimes|in:1',
         'parent_id'=>'sometimes|nullable|exists:categories,id',
         'image'=> 'sometimes|image|max:3000',
         'status'=>'required|in:active,inactive'

     ];
     if($act=='add'){
         $rule['title'] = 'required|string|unique:categories,title';

     }else{
         $rule['title'] = 'required|string';

     }
     return $rule;

 }
public function getSlug($title){
     $slug=\Str::slug($title);
$exits=$this->where('slug',$slug)->count();
if($exits >0){
    $slug .=date('his');
}
return $slug;
 }

 public  function parent_data(){
     return $this->hasOne('App\Models\Category','id','parent_id');
 }

 public function getAllCategory(){
     return $this->with('parent_data')->orderBy('id','Desc')->get();
 }
 public function getAllCategoryformenu(){
     return $this->with('child_cats')->where('status','active')->orderBy('title','DESC')->where('is_parent',1)->limit(8)->get();
 }
 public function child_id(){
//     seltect * from category where parent_id=id
     return $this->hasMany('App\Models\Category','parent_id','id');
 }
    public function child_cats(){
//     seltect * from category where parent_id=id
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }
 public function getChildId($parent_id){
     return $this->where('parent_id', $parent_id)->pluck('id');
 }

 public function getCategoryById($id){
     return $this->where('id',$id)->with('child_id')->first();
 }
 public function shiftChild($child_id )
 {
     return $this->whereIn('id',$child_id)->update(['is_parent'=>1]);
 }

    public function getAllparentCats(){
     return $this->where('is_parent',1)->orderby('title','ASC')->pluck('title','id');
}
    public function getAllparentCatsforhome(){
        return $this->where('is_parent',1)->where('status','active')->orderby('title','ASC')->limit(6)->pluck('title','id','image');
    }
public function getChildCats($parent_id){
return $this->where('parent_id',$parent_id)->where('is_parent',0)->orderBy('title','ASC')->pluck('title','id');
}

public function getCategoryformenu(){
     return $this->with('child_cats')->where('status','active')->orderBy('title','DESC')->where('is_parent',1)->get();
}
public function getCategoryInfo($cat_slug){
     return $this->with('products')->where('slug',$cat_slug)->orderBy('title','DESC')->first();
}
    public function getSubCategoryInfo($sub_cat_slug){
        return $this->with('child_products')->where('slug',$sub_cat_slug)->first();
    }
public function products(){
    return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
}
    public function child_products(){
        return $this->hasMany('App\Models\Product','child_cat_id','id')->where('status','active');
    }

}
