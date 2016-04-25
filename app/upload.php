<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    protected $appends = ['user']; 
    
    public function getUserAttribute() {
        return $this->course->user;
    }
    
    public function course() {
        return $this->belongsTo('App\course');
    }
    
}
