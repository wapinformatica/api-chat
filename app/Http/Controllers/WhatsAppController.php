<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\RetornWhat;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Exception;

class WhatsAppController extends Controller
{
    protected $webHookService;

    public function __construct()
    {
        $this->webHookService = '123456789';
    }

    public function store(Request $request)
    {
        try {
            RetornWhat::create([
                'message' => $request,
                'type' => 'return'
            ]);

            $url = 'https://hsgee.senarmt.org.br/api/whats-app';
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
                CURLOPT_POSTFIELDS => array(
                    'message' => 'GRAVADO COM SUCESSO', // Envia o texto
                ),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            // $sslOptions = array(
            //     "ssl"=>array(
            //         "verify_peer"=>false,
            //         "verify_peer_name"=>false,
            //     ),
            // );

            // Http::post('https://hsgee.senarmt.org.br/api/whats-app', file_get_contents('', false, stream_context_create($sslOptions)), [
            //     'message' => $request
            // ]);

        } catch (Exception $ex) {
            RetornWhat::create([
                'message' => $ex->getMessage(),
                'type' => 'error'
            ]);
            return ;
        }
    }
}
