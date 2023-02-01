<?php

namespace App\Services;

use App\Models\City;
use App\Models\College;
use App\Models\Country;
use App\Models\Course;
use App\Models\Department;
use App\Models\State;
use App\Models\UserCollege;
use App\Services\Service;

class CSCService extends Service
{
    public static function getStates($countryId)
    {
        return State::where('country_id', $countryId)->get();
    }

    public static function getCountries()
    {
        return Country::all();
    }

    public static function getCities($stateId)
    {
        return City::where('state_id', $stateId)->get();
    }
}
