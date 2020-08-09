<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category=null;
    public function __construct(Category $category){
$this->category=$category;
    }

    public function index()
    {
        //
        $this->category=$this->category->getAllCategory();
//        $this->category =$this->category->getAllparentCatsforhome();
        return view('admin.pages.category')->with('category',$this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->category=$this->category->getAllparentCats();

        return view('admin.pages.category-form')->with('parent_cats',$this->category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
$rules =$this->category->getCategoryRules();

$request->validate($rules);
        $data=$request->all();
        $data['slug']=$this->category->getSlug($request->title);
        $data['added_by']=$request->user()->id;

        if ($request->has('image')){
            $image = uploadImage($request->image, 'category');
            $data['image'] = $image;

//            deleteFile($this->category->image,'category');
        }
//        dd($data);
        if (!isset($data['is_parent'])){
            $data['is_parent']=0;
        }
//        $data['is_parent']=(isset($request->is_parent))?1 :0;

        $this->category->fill($data);
$success=$this->category->save();
if ($success){
    $request->session()->flash('success','Category added succesfully');
}else{
    $request->session()->flash('error','THere was problem while adding category');
}
return redirect()->route('category.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$this->category= $this->category->find($id);
        $parent_cats=$this->category->getAllparentCats();
//        dd($this->category);
        return view('admin.pages.category-form')
            ->with('parent_cats',$parent_cats)
            ->with('category_data',$this->category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $rules=$this->category->getCategoryRules('update');
       $request->validate($rules);
$data =$request->all();
       $this->category=$this->category->find($id);
       if(!$this->category){
           request()->session()->flash('error','category id invalid');
return redirect()->route('category.index');
       }

        if ($request->has('image')){
            $image = uploadImage($request->image, 'category');
            $data['image'] = $image;
        }
//
        if (!isset($data['is_parent'])){
            $data['is_parent']=0;

        }
        if($data['is_parent']){
            $data['parent_id']= null;

        }

        $this->category->fill($data);

        $success=  $this->category->save();
//        dd($this->category);
if ($success){
    request()->session()->flash('success','category updated successfully');
}else{
    request()->session()->flash('error','There is problem while updating');
}
return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function getChildCats($cat_id){
$child_cats=$this->category->getChildCats($cat_id);

if($child_cats->count() > 0){

    return response()->json(['data'=>$child_cats,'status'=>true]);
}else{
    return response()->json(['data'=>null,'status'=>false]);
}
    }



    public function destroy($id)
    {
        $cat_info= $this->category->getCategoryById($id);
        if (!$cat_info){
            request()->session()->flash('error','Category not found');
            return redirect()->route('category.index');
        }
        $image=$cat_info->image;
$child_id= $cat_info->getChildId($id);

$del=$cat_info->delete();
if ($del){
    deleteFile($image,'category');
    $this->category->shiftChild($child_id);
    request()->session()->flash('success','category deleted succcefully');
}else{
    request()->session()->flash('error','Sorry!category could not be deleted');
    }
return redirect()->route('category.index');

    }

    public function getcategoryProduct($cat_slug)
    {
        $cat_dat =$this->category->getCategoryInfo($cat_slug);
        if(!$cat_dat){
            return redirect()->back();
        }
        return view('home.category_product')->with('product_list',$cat_dat->products);
    }


    public function getSubCategoryProduct($cat_slug, $sub_cat_slug){
        $cat_data = $this->category->getSubCategoryInfo($sub_cat_slug);
        if(!$cat_data){
            return redirect()->back();
        }

        return view('home.category_product')->with('product_list', $cat_data->child_products);
    }

}
