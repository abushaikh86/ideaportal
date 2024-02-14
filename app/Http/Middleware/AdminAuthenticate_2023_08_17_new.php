<?php

namespace App\Http\Middleware;
use Session;
use Illuminate\Support\Facades\Auth;


use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {

        if ($this->auth->guard('admin')->check()) {
            $time_login = strtotime(session('login_time'));
            $current_time = strtotime(date('Y-m-d H:i:s'));
            $left = $current_time - $time_login;
            $left = round($left / (60));

            if($left >= 1 ){
                Auth::guard('admin')->logout(); // Logout the currently authenticated user
            }
            return $this->auth->shouldUse('admin');

            }
        $this->unauthenticated($request, ['admin']);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
}
