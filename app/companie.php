<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class companie extends Model
{
    protected $fillable=['name','name_short','email'];





     public function user()
    {
      //return $this->belongsTo('App\role');
      return $this->hasMany('App\user');
    }
}
