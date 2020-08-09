<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    protected $banner = null;

    public function __construct(Banner $banner){

        $this->banner = $banner;
    }

    public function getBanner(){
        $banner_data=$this->banner->getAllBanner();
//dd($banner_data);
        return view('admin.pages.banner')->with('banner',$banner_data);
    }

    public function showBannerForm(Request $request){
        if ($request->id !=null) {
            $this->banner = $this->banner->find($request->id);
            if (!$this->banner) {
                request()->session()->flash('error', 'Invalid  Banner id');
                return redirect()->route('banner-list');
            }
        } else{
                $this->banner =null;
            }


        return view('admin.pages.banner-add')->with('banner_data',$this->banner);
    }

    public function submitPost(Request $request){
        $act='add';
        if (isset($request->id)){
            $act='update';
            $rules = $this->banner->getBannerAddRules('update');
            $this->banner=$this->banner->find($request->id);
            if(!$this->banner){
                $request->session()->flash('error','Banner not found');
                return redirect()->route('banner-list');
            }

        }else{
            $rules = $this->banner->getBannerAddRules('add');
        }


        $request->validate($rules);

        $data = $request->all();
        if ($request->has('image')){
            $image = uploadImage($request->image, 'banner');
            $data['image'] = $image;
            if($this->banner->image != null && file_exists(public_path().'/uploads/banner/'.$this->banner->image)){
                unlink(public_path().'/uploads/banner/'.$this->banner->image);
            }
        }
        $data['added_by']= $request->user()->id;
        $this->banner->fill($data);
        $success = $this->banner->save();
        if ($success){
            $request->session()->flash('success','Banner '.$act.'ed Successfully.');
        }else{
            $request->session()->flash('error','Sorry! There was a problem while '.$act.'ing banner.');
        }
        return redirect()->route('banner-list');
    }
    public function deletebanner($id)
    {
       $banner_info=$this->banner->find($id);
       if (!$banner_info){
           request()->session()->flash('error',"banner not found");
           return redirect()->route('banner-list');

       }
       $image=$banner_info->image;
       $success=$banner_info->delete();
       if ($success){

if ($image!=null && file_exists(public_path().'/uploads/banner/'.$image)){
    unlink(public_path().'/uploads/banner/'.$image);
}
           request()->session()->flash('success','Banner deleted successfully');
       }else{
           request()->session()->flash('error','Problem deleting banner');
       }
       return redirect()->route('banner-list');

    }
}
