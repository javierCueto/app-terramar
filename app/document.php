<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    public function getUrlAttribute(){
    	

    	return '/images/documents/'.$this->document;

    }
}
