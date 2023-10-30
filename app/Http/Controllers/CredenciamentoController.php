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
use Illuminate\Support\Facades\DB;

class CredenciamentoController extends Controller
{

    public function ateg() : JsonResponse
    {
        try{
            $json = file_get_contents('ateg.json');
            $data = json_decode($json, true);
            return response()->json([
                'error' => false,
                'data' => $data
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function instructor() : JsonResponse
    {
        try{
            $data =  DB::select("SELECT id, nome, rg, cpf, endereco, complemento, bairro, cep, estado, cidade, telefone, celular, e_mail, data_nascimento, senha, situacao FROM t_formulario_credenciamento WHERE e_mail <> 'sample@email.tst' ");
            return response()->json([
                'error' => false,
                'data' => $data
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
