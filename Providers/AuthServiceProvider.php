<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
    
{
    /*
     The policy mappings for the application.
     */
    
    protected $policies = [
        'App\Thread' => 'App\Policies\ThreadPolicy',
         'App\Reply' => 'App\Policies\ReplyPolicy',
    ];

    /*
      Register any application authentication / authorization services.
     */
    
    public function boot(GateContract $gate)
        
    {
        $this->registerPolicies($gate);

        //
    }
}
