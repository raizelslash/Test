<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
class PagesController extends Controller
{
    protected $page= null;
    public function __construct(Page $page)
    {
$this->page= $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
$this->page = $this->page->get();
        return view('admin.pages.pages')->with('pages',$this->page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
$this->page=$this->page->where('slug',$slug)->first();
        return view('home.page');
    }
    public function gethelpandfaq()
    {
        $this->page = $this->page->getPageBySlug('help-and-faq');

        return view('home.help-faq')->with('data',$this->page);
    }
    public function getprivacypolicy()
    {
        $this->page = $this->page->getPageBySlug('privacy-policy');

        return view('home.privacy-policy')->with('data',$this->page);
    }
    public function getdeliverycharges()
    {
        $this->page = $this->page->getPageBySlug('delivery-charges');

        return view('home.delivery-charges')->with('data',$this->page);
    }
    public function getreturnpolicy()
    {
        $this->page = $this->page->getPageBySlug('return-policy');

        return view('home.return-policy')->with('data',$this->page);
    }
    public function gettermsandconditions()
    {
        $this->page = $this->page->getPageBySlug('terms-and-conditions');

        return view('home.terms-and-conditions')->with('data',$this->page);
    }
    public function aboutandus()
    {
        $this->page = $this->page->getPageBySlug('aboutandus');

        return view('home.about')->with('data',$this->page);
    }
 public function contact()
    {
        $this->page = $this->page->getPageBySlug('contact-slug');

        return view('home.contact')->with('data',$this->page);
    }













    public function edit($id)
    {
        //
        $this->page =$this->page->find($id);
        return view('admin.pages.pages-form')->with('page_data',$this->page);
    }


    public function update(Request $request, $id)
    {

        $rules =array(
            'title'=>'required|string',
            'summary'=>'required|string',
            'description'=>'nullable|string',
            'image'=>'sometimes|image|max:10000'
        );
        $request->validate($rules);
        $this->page =$this->page->find($id);
        $data =$request->all();
        if ($request->has('image')){
            $image = uploadImage($request->image, 'pages','200x200');
            $data['image'] = $image;
            if($this->page->image != null && file_exists(public_path().'/uploads/product/'.$this->page->image)){
                unlink(public_path().'/uploads/pages/'.$this->product->image);
            }

        }
        $this->page->fill($data);
        $success =$this->page->save();
        if ($success){
            $request->session()->flash('success','Page updated Successfully');
        }else{
            $request->session()->flash('error','Problem while updating page');

        }
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
