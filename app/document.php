<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    public function getUrlAttribute(){
    	

    	return '/images/documents/'.$this->document;

    }


    public function user()
    {
      //return $this->belongsTo('App\role');

      return $this->belongsTo('App\User');
    }




    public function getNameUserAttribute(){
            return $this->user->name;

    }

}
