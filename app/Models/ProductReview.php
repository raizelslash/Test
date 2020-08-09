<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }

    protected $fillable=['user_id','product_id','review','rate','status','moderated_review','is_moderated'];
}
