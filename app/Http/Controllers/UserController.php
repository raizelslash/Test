<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
protected $user = null;

    public function __construct(User $user)
    {
        $this->user=$user;
    }


    public function submitVendor(Request $request){
        $rules =[
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:6',
            'address'=>'required|string',
            'phone'=>'required|string'


        ];

        $request->validate($rules);

        $data= $request->all();

        $data['role'] ='vendor';
        $data['status'] ='inactive';



//        $data['id'] =$this->user->id;
        $data['shipping_address'] =$data['address'];
        $data['phone'] =$data['phone'];
        $data['password'] =Hash::make($data['password']);


$this->user->fill($data);
$success = $this->user->save();

if ($success){

    request()->session()->flash('success','Thank you for registering your account will be shortly activated');
}else{

    request()->session()->flash('error','Sorry there was problem while registrating your account. Please contact our admin');
}
    return redirect()->route('user-register');

//flash message ako xaina...paxi mila hai



    }
    public function showRegisterform(){
        return view('home.register');
    }


public function submitUser(Request $request){
    $rules =[
        'name'=>'required|string',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|confirmed|min:6',
        'address'=>'required|string',
        'phone'=>'required|string'


    ];

    $request->validate($rules);

    $data= $request->all();

    $data['role'] ='Customer';
    $data['status'] ='active';



//        $data['id'] =$this->user->id;
    $data['shipping_address'] =$data['address'];
    $data['phone'] =$data['phone'];
    $data['password'] =Hash::make($data['password']);


    $this->user->fill($data);
    $success = $this->user->save();

    if ($success){

        request()->session()->flash('success','Thank you for registering your account will be shortly activated');
    }else{

        request()->session()->flash('error','Sorry there was problem while registrating your account. Please contact our admin');
    }
    return redirect()->route('user-register');

//flash message ako xaina...paxi mila hai


}
}
