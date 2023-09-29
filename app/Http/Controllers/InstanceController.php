<?php

namespace App\Http\Controllers;

use App\Facades\ApiWhatsApp;
use App\Models\RetornWhat;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    public function index()
    {
        try{
            return (object) ApiWhatsApp::get('/instance/list')->json();
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function restore()
    {
        try{
            $apiWhatsApp = (object) ApiWhatsApp::get('/instance/restore')->json();
            $result =  $apiWhatsApp->error ?? true;
            if($result){
                RetornWhat::create(['message' => $apiWhatsApp, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha na restauração!'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Restaurada com sucesso.'], 200);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function init($key_name)
    {
        try{
            return ApiWhatsApp::get('/instance/init?key='.$key_name.'&token='.env('TOKEN_WHATSAPP'))->json();
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function qrcode($key_name)
    {
        try{
            //dd(ApiWhatsApp::get('/instance/qr?key='.$key_name)->json());
            //return (object) ApiWhatsApp::get('/instance/qr?key='.$key_name)->json();

            $url = 'http://127.0.0.1:3333/instance/qr?key='.$key_name;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url ,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;




        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function logout($key_name)
    {
        try{
            $apiWhatsApp = (object) ApiWhatsApp::delete('/instance/logout?key='.$key_name)->json();
            $result =  $apiWhatsApp->error ?? true;
            if($result){
                RetornWhat::create(['message' => $apiWhatsApp, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha na restauração!'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Desconectado com sucesso.'], 200);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

    public function delete($key_name)
    {
        try{
            $apiWhatsApp = (object) ApiWhatsApp::delete('/instance/delete?key='.$key_name)->json();
            $result =  $apiWhatsApp->error ?? true;
            if($result){
                RetornWhat::create(['message' => $apiWhatsApp, 'type' => 'error']);
                return response()->json(['error' => true, 'message' => 'Houve uma falha ao deletar!'], 401);
            }
            return response()->json(['error' => false, 'message' => 'Deletado com sucesso.'], 200);
        } catch (\Exception $ex) {
            RetornWhat::create(['message' => $ex->getMessage(), 'type' => 'error']);
            return response()->json(['error' => true, 'message' => $ex->getMessage()], 401);
        }
    }

}
