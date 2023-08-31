<?php

namespace App\Http\Controllers;

use App\Services\CountryService;

class CountryController extends Controller
{
    /**
     * @param $country
     * @return array
     */
    public function state($country)
    {
        return CountryService::state($country);
    }

    /**
     * @param $state
     * @return array
     */
    public static function cities($state)
    {
        return CountryService::cities($state);
    }
}
