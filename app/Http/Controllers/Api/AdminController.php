<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function editUserRole(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'role' => 'required|integer|exists:roles,id',
                    'email' => 'required|email|exists:users,email',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $role = Role::find($request->role);
            $user = User::where('email', '=', $request->email)->first();
            $user->role_id = $role->id;
            $user->save();

            return response()->success('User role changed Successfully', [
                'role' => $role->role_name,
            ]);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function createRole(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'roleName' => 'required|unique:roles,role_name',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $role = new Role();
            $role->role_name = $request->roleName;
            $role->save();

            return response()->success("Role with name: $role->role_name created successfully", [
                'role' => $role,
            ]);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function deleteRole(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'roleId' => 'required|exists:roles,id|gt:2',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $role = Role::find($request->roleId);

            // change all users with this role to role user
            foreach (User::where('role_id', '=', $role->id)->get() as $user) {
                $user->role_id = 1;
                $user->save();
            }

            $role->delete();

            return response()->success("Role with name: $role->role_name deleted successfully");
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function addUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $role = Role::find($request->roleId);
            if ($role == null) {
                $role = Role::find(1);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $role->id;
            $user->password = Hash::make('12345678');
            $user->save();

            return response()->success("User with name: $user->name created successfully");
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|exists:users,email',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $user = User::where('email', '=', $request->email)->first();
            $user->delete();

            return response()->success("User with name: $user->name deleted successfully");
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }
}
