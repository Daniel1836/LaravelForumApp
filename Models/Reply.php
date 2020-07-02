<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Reply extends Model
     
{
       use RecordsActivity;
     
       /*
      Don't auto-apply mass assignment protection.
     */
     
       protected $guarded = [];
       
       /*
      Eager loaded on every query.
     */
     
       protected $with = ['owner'];
       
      /*
  Set Date format
    */
    
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
     
      /*
    A reply can be favorited
    */
    
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

        /*
    Count Favorites
    */
     
public function getFavoritesCountAttribute()

{
    return $this->favorites->count();
}

      /*
    A reply belongs to a thread
    */
    
public function thread()

{
    return $this->belongsTo(Thread::class);
}
     
        /*
    Get a string path for the reply
    */
     
 public function path()
 
 {
     return $this->thread->path() . "#reply-{$this->id}";
 }
    
      /*
      Boot the model.
     */
     
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
