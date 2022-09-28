<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                    'confirmPassword' => 'required|same:password'
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            return response()->success('User Created Successfully', [
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ]);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->validationError($validateUser->errors());
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->error('Email & Password does not match with our record.', 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->success('User Logged In Successfully', [
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ]);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }

    public function logoutUser(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            User::logout($user->id);

            return response()->success('User Logged Out Successfully');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 500);
        }
    }
}
