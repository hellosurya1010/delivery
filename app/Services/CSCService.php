<?php

namespace App\Services;

use AmrShawky\LaravelCurrency\Facade\Currency as FacadeCurrency;
use App\Models\City;
use App\Models\College;
use App\Models\Country;
use App\Models\Course;
use App\Models\Currency;
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

    public static function getCurrencies()
    {
        return  Cache::remember('currencies', now()->addDays(7), function () {
            return Currency::all();
        });
    }

    public static function getCities($stateId)
    {
        return  Cache::remember("city$stateId", now()->addDays(7), function() use($stateId) {
            return City::where('state_id', $stateId)->get();
        });
    }

    public static function findCurreny($currencyId)
    {
        return Cache::remember("currency$currencyId", now()->addDays(7), function() use($currencyId) {
            return Currency::find($currencyId);
        });
    }

    public static function currencyConvert()
    {
        $currency = FacadeCurrency::convert()
        ->to('USD')
        ->from('INR')
        ->amount(82)
        ->get();
        dd($currency);   
    }

}
