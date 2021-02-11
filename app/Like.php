<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     protected $fillable = [
        'user_id', 'album_id',
    ];

    public function checkLike($album_id,$user_id){
    	 return static::where(['album_id'=>$album_id,'user_id'=>$user_id])->first();
    }
}
