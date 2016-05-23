<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function courses() {
        return $this->hasMany('App\course');
    }
    
    public function uploads() {
        return $this->hasManyThrough('App\upload','App\course');
    }
    
    public function dept() {
        return $this->belongsTo('App\dept');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
