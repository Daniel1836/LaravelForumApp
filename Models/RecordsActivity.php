<?php

namespace App;

trait RecordsActivity{
    
     /*
      Boot the trait.
     */
    
    protected static function bootRecordsActivity()
    
    {
    
         foreach (static::getActivitiesToRecord() as $event)
             
           {
             static::$event(function ($model) use ($event)
                            
                 {
                     $model->recordActivity($event);
            
                 });
            }
    
    static::deleting(function ($model)
                     
       {
           
        $model->activity()->delete();
           
       });
    }
    
    /*
    Fetch all model events that require activity recording.
      */
    
     protected static function getActivitiesToRecord()
         
       {
           return ['created'];
       }
    
    /*
    Record new activity for the model.
        */
    
       protected function recordActivity($event)
       
       {
        
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
            ]);
       }
    
    /*
    Determine the activity type.
    */
    
        protected function getActivityType($event)
        
        {
            
      $type = strtolower((new \ReflectionClass($this))->getShortName());
      return "{$event}_{$type}";
            
        }
      
        public function activity()
        
        {
            
        return $this->morphMany('App\Activity', 'subject');
            
        }
    
    
}
