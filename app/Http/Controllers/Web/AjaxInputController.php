<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CSCService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class AjaxInputController extends Controller
{
    public function getStates($countryId)
    {
        $states = CSCService::getStates($countryId);
        return (new ResponseService)->data(['states' => $states])->getResponse();
    }

    public function getCities($stateId)
    {
        $states = CSCService::getCities($stateId);
        return (new ResponseService)->data(['cities' => $states])->getResponse();
    }
}
