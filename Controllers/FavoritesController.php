<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Favorite;

class FavoritesController extends Controller 

{
    
     /*
    Create a new controller instance
    */
    
    public function __construct()
    
    {
        $this->middleware('auth');
    }
    
     /*
    Store a new favourite in the database
    */
    
    public function store(Reply $reply)
    
    {
      $reply->favorite();
     
     return back();
    }
}
