<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class FrontendController extends Controller
{
protected $product=null;
protected $banner=null;
protected $category;
public function __construct(Product $product, Banner $banner, Category $category)
{
    $this->product=$product;
    $this->banner=$banner;
    $this->category=$category;

}

    public function index(){
    $this->banner = $this->banner->where('status','active')->orderby('id','DESC')->limit(3)->get();
    $this->product=$this->product->where('status','active')->orderBy('id','DESC')->limit(20)->get();
        $this->category =$this->category->getAllCategoryformenu();
        return view('home.index')->with('title','Homepage')
            ->with('product_list',$this->product)
            ->with('banner_list',$this->banner)
            ->with('cats',$this->category);
    }
    public function submitreview(Request $request){
    $data = $request->all();
    $data['user_id']=$request->user()->id;
    $data['product_id']=$request->product_id;
    $data['status']='active';
$review = new ProductReview();
$review->fill($data);
$success =$review->save();


return redirect()->back();
}
}
