<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dept extends Model
{
    public function users() {
        return $this->hasMany('App\User');
    }
    
    public function courses() {
        return $this->hasManyThrough('App\course','App\User');
    }

    public function posts() {
    	return $this->hasManyThrough('App\post','App\User');
    }
    
}
