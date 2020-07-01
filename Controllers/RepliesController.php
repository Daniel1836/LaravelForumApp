<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;

class RepliesController extends Controller 

{
       /*
      Create a new RepliesController instance.
     */
    
    public function __construct()
        
    {
        $this->middleware('auth');
    }
    
     /*
      Persist a new reply.
     */
     
    public function store($channelId, Thread $thread)
        
    {
        
        $this->validate(request(), ['body' => 'required']);
        
        $thread->addReply([
            'body'=> request('body'),
            'user_id'=>auth()->id()
            
            ]);
            
            return back();
     }
    
    public function destroy(Reply $reply)
        
    {
        
       $this->authorize('update', $reply);
        
        $reply->delete();
        
        return back();
    }
    
}


