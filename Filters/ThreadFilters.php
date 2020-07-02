<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
    
{
      /*
    Registered filters to operate upon.
    */
    
  protected $filters = ['by', 'popular', 'unanswered'];
  
     /*
    Filter the query by a given username
    */
    
  protected function by($username)
      
  {
            $user = User::where('name', $username)->firstOrFail();
            
            return $this->builder->where('user_id', $user->id);
  }
    
         /*
    Filter the query by most popular threads
    */
    
    protected function popular()
    
    {
        $this->builder->getQuery()->orders = [];
       return $this->builder->orderBy('replies_count', 'desc');
    }
    
         /*
    Filter the query by unanswered threads
    */
    
    protected function unanswered()
    
    {
        
         return $this->builder->where('replies_count', 0);
    }
        
    }
    
    
