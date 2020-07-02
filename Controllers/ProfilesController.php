<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Reply;
use App\Activity;

class ProfilesController extends Controller
    
{
       /*
      Show the user's profile.
     */
    
    public function show(User $user)
       
    {
            return view('profileshow', [
            
            'profileUser' => $user,
            'activities' => Activity::feed($user)
            ]);
    }

}
