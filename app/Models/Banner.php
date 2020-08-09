<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','link','status','image','added_by'];

    public function getBannerAddRules( $act='add'){
        $array=[
            'title' => 'required|string',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
//            'image' => 'required|image|max:10000'
        ];
        if ($act=='add')
        {
            $array['image']='required|image|max:10000';
        }
        else{
            $array['image']='sometimes|image|max:10000';

        }
        return $array;
    }
    public function posted_by(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function getAllBanner(){
        return $this->with('posted_by')->orderBy('id','DESC')->get();}
}
