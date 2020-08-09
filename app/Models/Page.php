<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //


    protected $fillable = ['title','slug','summary','description','updated_by','image'];
    public function getPageBySlug($slug){
        return $this->where('slug',$slug)->first();
    }


}

