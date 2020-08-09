<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','slug','summary','description','price','discount','brand','stock','image','status','vendor_id','is_featured','is_trending',
    'cat_id','child_cat_id','added_by'];
public function cat_Info(){
    return $this->hasOne('App\Models\Category','id','cat_id');

}
public function child_cat_info(){
    return $this->hasOne('App\Models\Category','id','child_cat_id');
}public function child_cat_infos(){
    return $this->hasOne('App\Models\Category','id','child_cat_id')->where('status','active');
}
    public function vendor_info(){
        return $this->hasOne('App\User','id','vendor_id');
    }
    public function images(){
//    product images table ma bhayeko product_id hamro id bhanne
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }

public function getProductByslug($slug){
return $this->with(['images','vendor_info','child_cat_infos','cat_info','product_review'])->where('slug',$slug)->first();


}
    public function getAllProducts(){
      return $this->with(['cat_Info','child_cat_info','vendor_info','images','product_review'])->get();

    }
    public function getAllProductsforvendor($id){

        return $this->with(['cat_Info','child_cat_info','vendor_info','images','product_review'])->where('vendor_id',$id)->get();

    }

    public function product_review(){
    return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active');
    }
public function getAddRules($act ='add'){
    $rules =[
      'title'=>'required|string',
      'summary'=>'required|string',
      'description'=>'nullable|string',
      'price'=>'required|numeric|min:10',
      'discount'=>'nullable|numeric|min:10,max:95',
      'brand'=>'nullable|string',
      'stock'=>'required|numeric|min:0',
        'image'=>'required|image|max:10000',
//      'is_featured'=>'required|string',
//      'is_trending'=>'required|string',
      'status'=>'required|in:active,inactive',
      'vendor_id'=>'sometimes|nullable|exists:users,id',
      'other_image'=>'sometimes|max:10000',
      'cat_id'=>'required|exists:categories,id',
      'child_cat_id'=>'sometimes|nullable|exists:categories,id',

    ];
    if($act =='add'){
        $rules['image'] ='required|image|max:10000';

    }else{
        $rules['image'] ='sometimes|image|max:10000';
    }
    return $rules;
}

public function getProductById($id){
return $this->with('images')->find($id);
}
public function getSlug($title){
    $slug=\Str::slug($title);
    $slug =substr($slug,0,20);
    $exits=$this->where('slug',$slug)->count();
    if($exits >0){
        $slug .=date('ymdhis');
    }
    return $slug;
}

}
