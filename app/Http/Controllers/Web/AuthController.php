<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\ResponseService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkExists(Request $request, $slug)
    {
        $exists = false;
        if ($slug == "email") {
            $exists = User::where('email', $request->email)->first() ? false : true;
        }
        // return (new ResponseService)->data(['cities' => $states])->getResponse();
        return $exists;
    }
}
