<?php

namespace App\Http\Controllers;

use App\Facades\ApiWhatsApp;
use App\Http\Requests\Api\Message\ImageRequest;
use App\Http\Requests\Api\Message\TextRequest;
use Illuminate\Http\JsonResponse;
use App\Models\RetornWhat;
use App\Models\What;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function texto(TextRequest $request)
    {
        try{
            $array = '{
                "id" :  "' . $this->validPhone($request->phone) . '",
                "message": "' . $request->message . '"
            }';
            $url = env('URL_WHATSAPP').'/message/text?key='.$request->key_name;
            $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$array,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $json = json_decode($response);
            $result =  $json->error ?? true;
            if($result){
                RetornWhat::create(['message' => $response, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha no envia da mensagem.'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Mensagem enviada com sucesso.'], 201);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex], 401);
        }
    }

    public function image(ImageRequest $request)
    {
        try{
            $name_img = 'q9OpernOGte8u8NoGT9QpLXxKBF16UmcaCHpNKHd.png';
            $initInstance = (object) ApiWhatsApp::attach('file',  file_get_contents($request->image) , $name_img)
            ->post('/message/image?key='.$request->key_name,[
                'id' => $this->validPhone($request->phone),
                'caption' => $request->message
            ])->json();
            $result =  $initInstance->error ?? true;
            if($result){
                RetornWhat::create(['message' => $initInstance, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha no envia da mensagem.'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Mensagem enviada com sucesso.'], 201);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex], 401);
        }
    }


    public function store(Request $request): JsonResponse
    {
        try{
            $what = What::create(['message' => $request->message, 'type' => $request->type]);
            if(!$what){
                RetornWhat::create(['message' => $what, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha no envia da mensagem.'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Mensagem enviada com sucesso.'], 201);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex], 401);
        }
    }

    public function text(TextRequest $request)
    {
        try{
            $phone = $this->validPhone($request->phone);
            $result = ApiWhatsApp::post('/message/text?key='.$request->key_name,[
                'id' => $phone,
                'message' => $request->message
            ])->json();
            if(!$result){
                RetornWhat::create(['message' => 'FALHA ' . $request, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha no envia da mensagem.'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Mensagem enviada com sucesso.'], 201);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex], 401);
        }
    }

    private function validPhone($phone){
        try {
            $key_phone = preg_replace('/[^0-9]/', '', $phone);
            $ddd = substr($key_phone, 0, 2);
            if( ($ddd >= 11 ) AND ($ddd <= 28) ){
                $fone = '55'. $ddd . substr($key_phone, 2, 10);
            } else {
                if(strlen(substr($key_phone, 2, 10)) > 8){
                    $fone = '55'. $ddd . substr($key_phone, 3, 11);
                } else {
                    $fone = '55'. $ddd . substr($key_phone, 2, 11);
                }
            }
            return $fone;
        } catch (\Exception $ex) {
            return '';
        }
    }
}
