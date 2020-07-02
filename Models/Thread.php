<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
    
{
    
    use RecordsActivity;
    
     /*
    Don't auto-apply mass assignment protection
    */
    
    protected $guarded = [];
    
     /*
    The relationships to always eager load
    */
    
    protected $with = ['creator', 'channel'];
    
    /*
      Boot the model.
     */
    
    protected static function boot()
        
    {
        parent::boot();
        
        static::deleting(function ($thread)
         {
           $thread->replies->each(function ($reply)
             {
               $reply->delete();
             });
            
         });
      
    }
    
      /*
    Get a string path for the thread
    */
    
    public function path()
        
    {
        return "/threads.php/{$this->channel->slug}/{$this->id}";
    }
    
     /*
    A thread may have many replies
    */
    
    public function replies()
        
    {
        return $this->hasMany(Reply::class);
    }
    
     /*
    A thread belongs to a creator
    */
    
    public function creator()
        
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
     /*
    Add a reply to a thread
    */
    
    public function addReply($reply)
        
    {
        $this->replies()->create($reply);
    }
    
     /*
    A thread belongs to a channel
    */
    
    public function channel()
        
    {
        return $this->belongsTo(Channel::class);
    }
    
 /*
    Apply all relevant thread filters.
         */
    
    public function scopeFilter($query, $filters)
        
    {
        return $filters->apply($query);
    }
    
     /*
  Set Date format
    */
    
    
     public function getDateFormat()
         
{
     return 'Y-m-d H:i:s.u';
}

   
}
