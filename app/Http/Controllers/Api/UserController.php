<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function editDetails(Request $request)
    {
        try {
            $user = User::find(auth('sanctum')->user()->id);
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }
            // return ['data' => $request->email];
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();

            return response()
                ->success('User details changed Successfully', [
                    'newEmail' => $user->email,
                    'newName' => $user->name
                ]);
        } catch (\Throwable $th) {
            return response()
                ->error($th->getMessage(), 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $user = User::find(auth('sanctum')->user()->id);
            $validateUser = Validator::make(
                $request->all(),
                [
                    'currentPassword' => 'required',
                    'newPassword' => 'required|different:currentPassword',
                    'confirmPassword' => 'required|same:newPassword',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }
            if (!Hash::check($request->currentPassword, $user->password)) {
                return response()->error('wrong password', 401, ['password' => "Wrong password provided"]);
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();
            User::logout($user->id);

            return response()->success('User details changed Successfully', [
                'newEmail' => $user->email,
                'newName' => $user->name
            ]);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function deleteProfile(Request $request)
    {
        try {
            $user = User::find(auth('sanctum')->user()->id);
            $validateUser = Validator::make(
                $request->all(),
                [
                    'password' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }
            if (!Hash::check($request->password, $user->password)) {
                return response()->error('wrong password', 401, ['password' => "Wrong password provided"]);
            }

            User::logout($user->id);
            $user->delete();

            return response()->success('User deleted Successfully');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }
}
