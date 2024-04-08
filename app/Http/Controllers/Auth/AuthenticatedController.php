<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    public function store(Request $request) {
        $requestUser = $request->validate(
            array(
                "email" => "required|string|email",
                "password" => "required"
            )
        );

        $user = User::where("email", $requestUser["email"])->first();

        if (!$user && !Hash::check($requestUser["password"], $user->password)) {
            return response()->json(["message" => "Your credentials are invalid."], 401);
        }

        $token = $user->createToken($user->email);

        return response()->json([
            "access_token" => $token->plainTextToken
        ], 200);
    }

    public function destroy(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(["message" => "You are not logged."], 200);
    }
}
