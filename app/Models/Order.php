<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =['user_id','product_id','cart_id','quantity','total_amount','status'];
}
