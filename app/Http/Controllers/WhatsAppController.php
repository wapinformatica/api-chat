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

            $sslOptions = array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );

            Http::post('https://hsgee.senarmt.org.br/api/whats-app', file_get_contents('', false, stream_context_create($sslOptions)), [
                'message' => $request,
                'type' => 'return',
            ]);

        } catch (Exception $ex) {
            RetornWhat::create([
                'message' => $ex->getMessage(),
                'type' => 'error'
            ]);
            return ;
        }
    }
}
