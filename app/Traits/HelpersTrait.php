<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HelpersTrait {

    public function storeInPublic($path, $file)
    {
        if (is_file($file)) {
            return Storage::disk('public')->put($path, $file);
        }
        return null;
    }

}   