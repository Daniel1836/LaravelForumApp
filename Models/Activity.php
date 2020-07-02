<?php

namespace App;
use App\Thread;
use App\Reply;
use App\Favorite;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
  
{
  
  /*
     Don't auto-apply mass assignment protection.
   */
  
  protected $guarded = [];
  
  public function subject()
  {
      return $this->morphTo();
  }
  
  /*
  Set Date format
     */
    
   public function getDateFormat()
     
{
     return 'Y-m-d H:i:s.u';
}
  
 public static function feed($user, $take=50)
 
 {
     
      return static::where('user_id', $user->id)
      ->latest()
      ->with('subject')
      ->take($take)
      ->get()
      ->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
   });
 }

}
