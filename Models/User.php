<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
    
{
    /*
      The attributes that are mass assignable.
     */
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /*
      The attributes that should be hidden for arrays.
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getRouteKeyName()
    
    {
        return 'name';
    }
    
       /*
   A user has many threads
    */
    
    public function threads()
    
    {
        return $this->hasMany(Thread::class)->latest();
    }
    
       /*
    A user has many activities
    */
    
    public function activity()
    
    {
        return $this->hasMany(Activity::class);
    }
    
}
