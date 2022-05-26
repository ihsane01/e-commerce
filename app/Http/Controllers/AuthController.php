<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Monolog\Handler\RollbarHandler;

class AuthController extends Controller
{
    use HasApiTokens;

    public function register(Request $request)
{
$validatedData = $request->validate([
'name' => 'required|string|max:255',
'prenom' => 'required|string|max:255',
'adresse' => 'required|string|max:255',
                   'email' => 'required|string|email|max:255|unique:users',
                   'password' => 'required|string|',
]);

      $user = User::create([
              'name' => $validatedData['name'],
              'prenom' => $validatedData['prenom'],
              'adresse' => $validatedData['adresse'],
              'email' => $validatedData['email'],
              'password' => Hash::make($validatedData['password']),
       ]);

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
              'access_token' => $token,
                   'token_type' => 'Bearer',
]);
}

public function login(Request $request)
{
if (!Auth::attempt($request->only('email', 'password'))) {
return 1;
       }

$user = User::where('email', $request['email'])->firstOrFail();

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer',
           'user'=>$user,
]);
}
public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    } 
    
}
