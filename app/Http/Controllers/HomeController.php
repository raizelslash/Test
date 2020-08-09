<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $product= null;
    public function __construct(Product $product)
    {
        $this->product= $product;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(request()->user()->role == 'admin'){
            return redirect()->route('admin');
        }elseif (request()->user()->role == 'vendor'){
            return redirect()->route('vendor');
        }elseif (request()->user()->role == 'customer'){
            return redirect()->route('customer');
        }
        return view('home');
    }

    public function admin(){
        return view('admin.pages.dashboard');
    }

    public function vendor(){
        $product_data= $this->product->getAllProducts();


        return view('admin.pages.dashboard')->with('all_products',$product_data);
    }

    public function customer(){
        return redirect()->route('homepage');
    }
}
