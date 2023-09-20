<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function edit(Request $request): JsonResponse
    {
        try{
            return response()->json([
                'data' => new UserResource($request->user())
            ],200);
        } catch (\Exception $ex) {
            return response()->json($ex, 401);
        }
    }

}
