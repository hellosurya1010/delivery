<?php

namespace App\Services;

use App\Traits\HelpersTrait;
use App\Traits\ResourcesTrait;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Storage;

class Service
{
    use ResponseTrait, HelpersTrait, ResourcesTrait;

    public static function storeInPublic($path, $file)
    {
        if (is_file($file)) {
            return Storage::disk('public')->put($path, $file);
        }
        return null;
    }

    public static function debugException($ex)
    {
        if (env('APP_DEBUG')) {
            dd($ex);    
        }
    }
}
