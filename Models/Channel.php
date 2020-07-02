<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
    
{
    
    public function getRouteKeyName()
        
    {
        return 'slug';
    }
    
       /*
   A Channel has many threads
    */
    
    public function threads()
        
    {
        return $this->hasMany(Thread::class);
    }
}
