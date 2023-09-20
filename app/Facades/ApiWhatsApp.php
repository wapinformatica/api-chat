<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiWhatsApp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api-whatsapp';
    }
}
