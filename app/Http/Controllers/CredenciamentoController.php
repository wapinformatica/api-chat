<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoadMessage\MessagesResource;
use App\Http\Resources\SatisfactionSurvey\ListSatisfactionSurveyResource;
use App\Models\Message;
use App\Models\SatisfactionSurvey;
use App\Repositories\WhatsappClientRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CredenciamentoController extends Controller
{

    public function ateg() : JsonResponse
    {
        try{
            $json = file_get_contents('ateg.json');
            return response()->json([
                'error' => false,
                'data' => $json
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function instructor() : JsonResponse
    {
        try{
            $json = file_get_contents('instructor.json');
            return response()->json([
                'error' => false,
                'data' => $json
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function ategs() : JsonResponse
    {
        try{
            $json = file_get_contents('ategs.json');
            return response()->json([
                'error' => false,
                'data' => $json
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

}
