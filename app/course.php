<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $appends = ['dept']; 
    
    public function getDeptAttribute() {
        return $this->user->dept;
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function uploads() {
        return $this->hasMany('App\User');
    }
}
