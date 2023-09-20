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
            return response()->json(['error' => true, 'message' => $ex], 401);
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
            return response()->json(['error' => true, 'message' => $ex], 401);
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
            return response()->json(['error' => true, 'message' => $ex], 401);
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
            return response()->json(['error' => true, 'message' => $ex], 401);
        }
    }



}
