<?php

namespace App\Services;
use App\Models\Country;
use Illuminate\Support\Facades\Http;


/**
 * Class CountryService
 * @package App\Services
 */
class CountryService
{
    /**
     * @return array
     */
    public static function country()
    {
        $authToken = self::getToken();
        $response = Http::withHeaders([
            "Authorization" => "Bearer ". $authToken,
            "Accept" => "application/json",
        ])->get('https://www.universal-tutorial.com/api/countries/');

        $country = [];
        if($response->ok()) {
            foreach ($response->json() as $value) {
                $country[]=[
                    'name' => $value['country_name'],
                    'code' => $value['country_short_name'],
                ];
            }
        }
        return $country;
    }

    /**
     * @param $countryId
     * @return array
     */
    public static function state($countryId)
    {
        $country = Country::query()->find($countryId);
        $states = [];
        if($country ) {
            $authToken = self::getToken();
            $response = Http::withHeaders([
                "Authorization" => "Bearer ". $authToken,
                "Accept" => "application/json",
            ])->get('https://www.universal-tutorial.com/api/states/'. $country->name);

            if( $response->ok()) {
                foreach ( $response->json() as $value) {
                    $states[] = $value['state_name'];
                }
            }
        }


        return $states;
    }

    /**
     * @param $state
     * @return array
     */
    public static function cities($state)
    {
        $authToken = self::getToken();
        $response = Http::withHeaders([
            "Authorization" => "Bearer ". $authToken,
            "Accept" => "application/json",
        ])->get('https://www.universal-tutorial.com/api/cities/'.$state);

        $cities = [];
        if( $response->ok()) {
            foreach ( $response->json() as $value) {
                $cities[] = $value['city_name'];
            }
        }
        return $cities;
    }

    /**
     * @return mixed
     */
    public static function getToken()
    {
        $token = 'oALpSYhY4aM7dWYVuoTX4eQMYfgVu3mlaX_6_ohMvaOa56ugOSJLsBtv2UrsmNgyllU';
        $response = Http::withHeaders([
                "Accept" => "application/json",
                "api-token" => $token,
                "user-email" => "artakkspoyan111290@gmail.com"
            ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $token = null;
        if($response->ok()) {
            $token = $response->json()['auth_token'];
        }
        return $token;
    }


    /**
     * @return mixed|null
     */
    public static function getCurrentCountry($ip)
    {
        $response = Http::get('http://ip-api.com/json/' . $ip);
        $data = null;
        if($response->ok()) {
            if($response->json()['status'] != 'fail') {
                $data = $response->json()['country'];
            }
        }
        return $data;
    }
}
