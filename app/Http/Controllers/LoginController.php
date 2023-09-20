<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Login\LoginRequest;
use App\Models\PersonalAccessToken;
use App\Models\PersonalToken;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();
                PersonalAccessToken::where('tokenable_id', $user->id)->delete();
                PersonalToken::where('user_id', $user->id)->update([
                    'status' => false
                ]);
                $token = $user->createToken('JWT');
                PersonalToken::create([
                    'user_id' => $user->id,
                    'token' => $token->plainTextToken,
                ]);
                return response()->json($token->plainTextToken, 200);
            }
            return response()->json(['errors' => 'Usuário inválido'], 401);
        } catch (\Exception $ex) {
            return response()->json($ex, 401);
        }
    }
}
