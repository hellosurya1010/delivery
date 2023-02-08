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
use Illuminate\Support\Facades\Cache;

class CSCService extends Service
{

    public static function getStates($countryId)
    {
        return  Cache::remember("state$countryId", now()->addDays(7), function() use($countryId) {
            return State::where('country_id', $countryId)->get();
        });
    }

    public static function getCountries()
    {
        return  Cache::remember('countries', now()->addDays(7), function () {
            return Country::all();
        });
    }

    public static function getCities($stateId)
    {
        return  Cache::remember("city$stateId", now()->addDays(7), function() use($stateId) {
            return City::where('state_id', $stateId)->get();
        });
    }
}
