<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Channel;
use App\Filters\ThreadFilters;
use Carbon\Carbon;


class ThreadsController extends Controller

{
    
     /*
    ThreadsController constructor
    */
    
    public function __construct()
        
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    /*
    Display a listing of the resource
    */
    
    public function index(Channel $channel, ThreadFilters $filters)
    
    {
        
        
        $threads = Thread::latest()->filter($filters);
        
        if ($channel->exists) 
            
        {
            $threads->where('channel_id', $channel->id);
        } 
        
        $threads=$threads->filter($filters)->get();
     
      
        return view('threads', compact('threads'));
     }
    
     /*
    Display the specified resource
    */
    
    public function show($channelId, Thread $thread)
    
    {
        
       return view('show', [
           'thread' => $thread,
           'replies' => $thread->replies()->paginate(1)
           ]);
    }
    
     /*
    Delete a resource
    */
    
    public function destroy($channel, Thread $thread)
    
    {
        
        $this->authorize('update', $thread);
        $thread->delete();
        
        if (request()->wantsJson())
        {
        return response([], 204);
        }
        return redirect('/threads.php');
    }
    
     /*
    Store a newly created resource in storage
    */
    
    public function store(Request $request)
        
    {
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
            
            ]);
        
       $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'channel_id' => request('channel_id'),
            'body' => request('body')
            ]);
            return redirect($thread->path());
     }
    
     /*
    Show the form for creating a new resource
    */
    
    public function create()
        
    {
        return view('createthd');
    }
    
  
}

