<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserHasAccessToEndpoint
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
        $user = User::findByEmail(auth('sanctum')->user()->email);
        $userRole = Role::find($user->role_id)->role_name;
        $currentRouteNameSplit = explode("/", Route::getCurrentRoute()->uri);
        if (count($currentRouteNameSplit) < 2) {
            return response()->json([
                'status' => false,
                'message' => "Invalid route"
            ], 404);
        }
        $currentRouteName = $currentRouteNameSplit[1];

        if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) {
            return $next($request);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to access this endpoint',
            ], 403);
        }
    }

    private function userAccessRole()
    {
        return [
            'admin' => [
                'admin'
            ],
            'user' => [],
        ];
    }
}
