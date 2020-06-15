<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Reply extends Model
     
{
       use RecordsActivity;
     
       protected $guarded = [];
       
       protected $with = ['owner'];
       
    public function getDateFormat()
         
{
         
     return 'Y-m-d H:i:s.u';
         
}
     
 /*
    A reply has a owner
    */
     
public function owner()

{
    return $this->belongsTo(User::class, 'user_id');
}

public function favorites()

{
   return $this->morphMany(Favorite::class, 'favorited');
}
     
 /*
    Favourite the current reply
    */
     
public function favorite()

{
    
    $attributes = ['user_id' => auth()->id()];
    
    if (! $this->favorites()->where($attributes)->exists())
    
    {
         
return $this->favorites()->create($attributes);
        
    }
    
}

public function isFavorited()

{
    return !! $this->favorites->where('user_id', auth()->id())->count();
}

public function getFavoritesCountAttribute()

{
    return $this->favorites->count();
}

public function thread()

{
    return $this->belongsTo(Thread::class);
}
 public function path()
 
 {
     return $this->thread->path() . "#reply-{$this->id}";
 }
    
    protected static function boot()
    
    {
        parent::boot();
        
        static::created(function ($reply) 
                        
          {
            $reply->thread->increment('replies_count');
          });
        
        static::deleted(function ($reply) 
                        
          {
            $reply->thread->decrement('replies_count');
          });
    }
}
