<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    
    use RecordsActivity;
    
    protected $guarded = [];
    
    protected $with = ['creator', 'channel'];
    
    protected static function boot()
    {
        parent::boot();
        
     
        static::deleting(function ($thread){
           $thread->replies->each(function ($reply){
               $reply->delete();
           });
            
            });
      
    }
    
      /*
    Get a sting path for the thread
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
    
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
     public function getDateFormat()
{
     return 'Y-m-d H:i:s.u';
}

   
     
   
   
}
