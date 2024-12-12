<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\User;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    protected function login($request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]
        );

        $user = User::where('email', $request->email)->first();

        

        $token = $user->createToken('auth_token')->plainTextToken;

        return 
    }

    public function logout($request){
        $request->user()->currentAccessToken()->delete();

        return route('');
    }
}
