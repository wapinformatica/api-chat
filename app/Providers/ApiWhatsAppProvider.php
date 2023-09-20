<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ApiWhatsAppProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('api-whatsapp', function(){
            return Http::withOptions([
                'verify' => false,
                'base_uri' => env('URL_WHATSAPP').'/'
            ])->withHeaders([
                'Authorization' => 'Bearer ',
            ]);
        });
    }
}
