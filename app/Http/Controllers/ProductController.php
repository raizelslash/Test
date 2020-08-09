<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\User;
use Illuminate\Http\Request;
use App\Models\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category=null;
    protected $user=null;
    protected $product=null;
    public function __construct(Category $category,User $user, Product $product)
    {
        $this->category=$category;
        $this->user=$user;
        $this->product= $product;
    }

    public function index()
    {
        //
        $product_data= $this->product->getAllProducts();

        return view('admin.pages.product')->with('all_products',$product_data);

    }


    public function getproductbyvendor($id){
        $product_data= $this->product->getAllProductsforvendor($id);
//$product_datas =$product_data->vendor_id


        return view('admin.pages.product')->with('all_products',$product_data);
    }
//



    public function create()
    {

$parent_cats =$this->category->getAllparentCats();

$vendor_list=$this->user->where('role','vendor')->where('status','active')->pluck('name','id');
if(count($vendor_list) <= 0){
    $vendor_list[request()->user()->id]= request()->user()->name;
}

        return view('admin.pages.product-add')->with('parent_cats',$parent_cats)->with('vendor_list',$vendor_list);
    }
public function getproductbyvendorforadd(){

    $parent_cats =$this->category->getAllparentCats();

    $vendor_list=$this->user->where('role','vendor')->where('status','active')->pluck('name','id');
    if(count($vendor_list) <= 0){
        $vendor_list[request()->user()->id]= request()->user()->name;
    }

    return view('admin.pages.product-add')->with('parent_cats',$parent_cats)->with('vendor_list',$vendor_list);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {

           $rules =$this->product->getAddRules();
           $request->validate($rules);
           $data=$request->all();

           $data['title']= strip_tags($data['title']);
           $data['summary']= strip_tags($data['summary']);
           $data['description']= htmlentities($data['description']);
           $data['is_featured']=isset($request->is_featured) ? 1: 0;
           $data['is_trending']=isset($request->is_trending) ? 1: 0;
           $data['added_by']=$request->user()->id;
           $data['slug']=$this->product->getSlug($data['title']);
            if ($request->has('image')){
                $image = uploadImage($request->image, 'products','200x200');
                $data['image'] = $image;
                if($this->product->image != null && file_exists(public_path().'/uploads/product/'.$this->product->image)){
                    unlink(public_path().'/uploads/product/'.$this->product->image);
                }
            }
           $this->product->fill($data);
            $success=$this->product->save();
            if ($success){

            if($request->has('other_image')){

                foreach($request->other_image as $related_image){
//                    dd($data);

                    $file_name =uploadImage($related_image,'products','100x100');
                    if ($file_name){
                        $data= array(
                            'product_id'=>$this->product->id,
                            'image_name'=>$file_name
                        );
                        $product_img =new ProductImage();
                        $product_img->fill($data);
                        $product_img->save();
                    }
                }


            }
    //            dd($data);
                $request->session()->flash('success','Product added successfully');
            }else{
                $request->session()->flash('error','Problem while adding');
            }
            return redirect()->route('product.index');
        }

    public function show($slug)
    {
$this->product = $this->product->getProductByslug($slug);
return view('home.product-detail')->with('products',$this->product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_info=$this->product->find($id);
        if (!$product_info){

            request()->session()->flash('error','Product does not exit ');
            return redirect()->route('product.index');
        }


        $parent_cats =$this->category->getAllparentCats();
        $child_cats= $this->category->getChildCats($product_info->cat_id);
        $vendor_list=$this->user->where('role','vendor')->where('status','active')->pluck('name','id');
        if(count($vendor_list) <= 0){
            $vendor_list[request()->user()->id]= request()->user()->name;
        }
if(count($child_cats) == 0){

    $child_cats =array();
}
        return view('admin.pages.product-add')
            ->with('parent_cats',$parent_cats)
            ->with('vendor_list',$vendor_list)
            ->with('product_data',$product_info)
            ->with('child_cats',$child_cats);

    }
public function getproductbyvendorforedit($id){
    $product_info=$this->product->find($id);
    if (!$product_info){

        request()->session()->flash('error','Product does not exit ');
        return redirect()->route('product.index');
    }


    $parent_cats =$this->category->getAllparentCats();
    $child_cats= $this->category->getChildCats($product_info->cat_id);
    $vendor_list=$this->user->where('role','vendor')->where('status','active')->pluck('name','id');
    if(count($vendor_list) <= 0){
        $vendor_list[request()->user()->id]= request()->user()->name;
    }
    if(count($child_cats) == 0){

        $child_cats =array();
    }
    return view('admin.pages.product-add')
        ->with('parent_cats',$parent_cats)
        ->with('vendor_list',$vendor_list)
        ->with('product_data',$product_info)
        ->with('child_cats',$child_cats);

}

    public function update(Request $request, $id)
    {
$this->product =$this->product->find($id);
if (!$this->product){
    $request->session()->flash('error','Product doesnot exist');
    return redirect()->route('product.index');
}
        $rules =$this->product->getAddRules('update');

        $request->validate($rules);
        $data=$request->all();
        $data['title']= strip_tags($data['title']);
        $data['summary']= strip_tags($data['summary']);
        $data['description']= htmlentities($data['description']);
        $data['is_featured']=isset($request->is_featured) ? 1: 0;
        $data['is_trending']=isset($request->is_trending) ? 1: 0;
        if ($request->has('image')){
            $image = uploadImage($request->image, 'products','200x200');
            $data['image'] = $image;
            if($this->product->image != null && file_exists(public_path().'/uploads/product/'.$this->product->image)){
                unlink(public_path().'/uploads/product/'.$this->product->image);
            }
        }

        $this->product->fill($data);
        $success=$this->product->save();
        if ($success){

            if($request->has('other_image')){

                foreach($request->other_image as $related_image){
//                    dd($data);

                    $file_name =uploadImage($related_image,'products','100x100');
                    if ($file_name){
                        $data= array(
                            'product_id'=>$this->product->id,
                            'image_name'=>$file_name
                        );
                        $product_img =new ProductImage();
                        $product_img->fill($data);
                        $product_img->save();
                    }
                }
            }
            if (isset($request->del_image)){
                foreach ($request->del_image as $del_image){
                    $product_img =new ProductImage();
                   $del= $product_img->where('image_name',$del_image)->delete();
                   if($del){
                        deleteFile($del_image,'products');
                        deleteFile('Thumb-'.$del_image,'products');
                   }
                }
            }

            $request->session()->flash('success','Product updated successfully');
        }else{
            $request->session()->flash('error','Problem while updating product');
        }
        return redirect()->route('product.index');
    }

    public function getproductbyvendorforupdate(Request $request, $id){

        $this->product =$this->product->find($id);
        if (!$this->product){
            $request->session()->flash('error','Product doesnot exist');
            return redirect()->route('product.index');
        }
        $rules =$this->product->getAddRules('update');

        $request->validate($rules);
        $data=$request->all();
        $data['title']= strip_tags($data['title']);
        $data['summary']= strip_tags($data['summary']);
        $data['description']= htmlentities($data['description']);
        $data['is_featured']=isset($request->is_featured) ? 1: 0;
        $data['is_trending']=isset($request->is_trending) ? 1: 0;
        if ($request->has('image')){
            $image = uploadImage($request->image, 'products','200x200');
            $data['image'] = $image;
            if($this->product->image != null && file_exists(public_path().'/uploads/product/'.$this->product->image)){
                unlink(public_path().'/uploads/product/'.$this->product->image);
            }
        }

        $this->product->fill($data);
        $success=$this->product->save();
        if ($success){

            if($request->has('other_image')){

                foreach($request->other_image as $related_image){
//                    dd($data);

                    $file_name =uploadImage($related_image,'products','100x100');
                    if ($file_name){
                        $data= array(
                            'product_id'=>$this->product->id,
                            'image_name'=>$file_name
                        );
                        $product_img =new ProductImage();
                        $product_img->fill($data);
                        $product_img->save();
                    }
                }
            }
            if (isset($request->del_image)){
                foreach ($request->del_image as $del_image){
                    $product_img =new ProductImage();
                    $del= $product_img->where('image_name',$del_image)->delete();
                    if($del){
                        deleteFile($del_image,'products');
                        deleteFile('Thumb-'.$del_image,'products');
                    }
                }
            }

            $request->session()->flash('success','Product updated successfully');
        }else{
            $request->session()->flash('error','Problem while updating product');
        }
        return redirect()->route('getproductbyvendor',$id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->product= $this->product->getProductById($id);
//        dd(  $this->product);
        if(!$this->product){
            request()->session()->flash('error','product does not exit ');
            return redirect()->route('product.index');
        }
        $thumb = $this->product->image;

        $product_images = $this->product->images;

//        dd($product_images);
        $del = $this->product->delete();
        if ($del){
if ($thumb){
    deleteFile($thumb,'products');
    deleteFile('Thumb-'.$thumb,'products');

    foreach($product_images as $key){

        deleteFile($key->image_name,'products');
        deleteFile('Thumb-'.$key->image_name,'products');
}
}
            request()->session()->flash('success','product deletd successfully ');

        }else{
            request()->session()->flash('error','Problem while deleting ');

        }
        return redirect()->route('product.index');



    }

    public function getproductbyvendorfordestroy($id){

        $this->product= $this->product->getProductById($id);
//        dd(  $this->product);
        if(!$this->product){
            request()->session()->flash('error','product does not exit ');
            return redirect()->route('product.index');
        }
        $thumb = $this->product->image;

        $product_images = $this->product->images;

//        dd($product_images);
        $del = $this->product->delete();
        if ($del){
            if ($thumb){
                deleteFile($thumb,'products');
                deleteFile('Thumb-'.$thumb,'products');

                foreach($product_images as $key){

                    deleteFile($key->image_name,'products');
                    deleteFile('Thumb-'.$key->image_name,'products');
                }
            }
            request()->session()->flash('success','product deletd successfully ');

        }else{
            request()->session()->flash('error','Problem while deleting ');

        }
        return redirect()->route('getproductbyvendor',$id);


    }
public function showallproduct(){
        $this->category =$this->category->getAllparentCatsforhome();
    $this->product=$this->product->where('status','active')->orderBy('id','DESC')->get();
        return view('home.product-list')->with('product_list',$this->product)->with('cats',$this->category);
}


public function isandfeatures(){
    $this->category =$this->category->getAllparentCatsforhome();
        $this->product =$this->product->where('is_featured',1)->orderBY('id','DESC')->get();
        return view('home.product-list')->with('product_list',$this->product)->with('cats',$this->category);;
}

public function addtocart(Request $request){
       $this->product = $this->product->find($request->prod_id );

        if(!$this->product){
            return response()->json(['status'=>false,'data'=>null]);
        }
        $current_item=array(
            'id'=>$this->product->id,
            'title'=>$this->product->title,
            'price'=>$this->product->price,
            'image'=>asset('uploads/products/Thumb-'.$this->product->image),
            'link' =>route('product-detail',$this->product->slug)

        );


    $current_item['cost']=$request->cost;
    $cost   =$this->product->price;
    if($this->product->discount > 0) {
        $cost = $this->product->price -($this->product->price * $this->product->discount / 100);
    }

    $current_item['cost']=ceil($cost);
//   $request->session()->flush();
        $cart= $request->session()->has('_cart') ? session('_cart') :array();
//        dd($cart);
        if($cart){


            $index = null;
            foreach ($cart as $key=> $cart_items){
                if($request->prod_id == $cart_items['id']){
                    $index=$key;
                    break;
                }
            }
            if($index === null){

                $current_item['quantity']=$request->quantity;
                $current_item['total_amount']=$request->quantity*$cost;
                $cart[]=$current_item;
            }else{
                $cart[$index]['quantity']+=$request->quantity;

                $cart[$index]['total_amount']=$cost*$cart[$index]['quantity'];
            }


        }else{
            $current_item['quantity']=$request->quantity;
            $current_item['total_amount']=$request->quantity*$cost;
            $cart[]=$current_item;
        }
    request()->session()->put('_cart',$cart);
return response()->json(['status'=>true,'data'=>$cart]);
    }

    public function removeFromCart(Request $request){
        $id = $request->prod_id;
        $quantity = $request->quantity;
        $index = $request->index;


        $this->product = $this->product->find($request->prod_id);

        if(!$this->product){
            return response()->json(['status'=>false,'data'=>null]);
        }


        $cost = $this->product->price;

        if($this->product->discount > 0) {
            $cost = $cost- (($cost*$this->product->discount) / 100);

        }
        $cost = ceil($cost);

        $cart = session('_cart');


        $cart[$index]['quantity'] = $cart[$index]['quantity']-$quantity;
        if($cart[$index]['quantity'] == 0){
            unset($cart[$index]);
        } else {

            $cart[$index]['total_amount'] = $cart[$index]['quantity'] * $cost;
        }
        session()->put('_cart',$cart);
        return response()->json(['status'=>true,'data'=>$cart]);
    }




    public function checkOut(Request $request){
        $cart = session('_cart');
        if(empty($cart)){
            return redirect()->route('product-list');
        }
        $cart_id = \Str::random(10);
        foreach($cart as $cart_items){
            $temp = array(
                'cart_id' => $cart_id,
                'user_id' => $request->user()->id,
                'product_id' => $cart_items['id'],
                'quantity' => $cart_items['quantity'],
                'total_amount' => $cart_items['total_amount'],
                'status' => 'new'
            );

            $order = new Order();
            $order->fill($temp);
            $order->save();
        }

        // Mail::to($request->user()->email)->send(new OrderBill($cart));
        $request->session()->forget('_cart');

        $request->session()->flash('success','Thank you for using Dsewa. Your order has been placed. You will be shortly notified about your order status.');
        return redirect()->route('customer');
    }




    public function getproductbyvendorforstore(Request $request,$id){
        $rules =$this->product->getAddRules();
        $request->validate($rules);
        $data=$request->all();

        $data['title']= strip_tags($data['title']);
        $data['summary']= strip_tags($data['summary']);
        $data['description']= htmlentities($data['description']);
        $data['is_featured']=isset($request->is_featured) ? 1: 0;
        $data['is_trending']=isset($request->is_trending) ? 1: 0;
        $data['added_by']=$request->user()->id;
        $data['slug']=$this->product->getSlug($data['title']);
        if ($request->has('image')){
            $image = uploadImage($request->image, 'products','200x200');
            $data['image'] = $image;
            if($this->product->image != null && file_exists(public_path().'/uploads/product/'.$this->product->image)){
                unlink(public_path().'/uploads/product/'.$this->product->image);
            }
        }
        $this->product->fill($data);
        $success=$this->product->save();
        if ($success){

            if($request->has('other_image')){

                foreach($request->other_image as $related_image){
//                    dd($data);

                    $file_name =uploadImage($related_image,'products','100x100');
                    if ($file_name){
                        $data= array(
                            'product_id'=>$this->product->id,
                            'image_name'=>$file_name
                        );
                        $product_img =new ProductImage();
                        $product_img->fill($data);
                        $product_img->save();
                    }
                }


            }

            $request->session()->flash('success','Product added successfully');
        }else{
            $request->session()->flash('error','Problem while adding');
        }
        return redirect()->route('getproductbyvendor',$id);
    }
}
