<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $user_type)
    {

        if(auth()->user()->user_type === $user_type)
            return $next($request);
        if($user_type == User::MANAGER)
            $type = 'quản trị viên';
        else{
            $type = 'nhân viên';
        }
        return redirect('/')->with('error', "Chức năng chỉ áp dụng với $type!");
    }
}
