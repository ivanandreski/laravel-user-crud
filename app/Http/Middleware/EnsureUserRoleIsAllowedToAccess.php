<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::findByEmail(auth()->user()->email);
        $userRole = Role::find($user->role_id)->role_name;
        $currentRouteName = Route::getCurrentRoute()->uri;

        if(in_array($currentRouteName, $this->userAccessRole()[$userRole]))
            return $next($request);
        else
            abort(403, "You do not have permission to access this page");
    }

    private function userAccessRole() {
        return [
            'admin' => [
                'admin'
            ],
            'user' => [

            ],
        ];
    }
}
