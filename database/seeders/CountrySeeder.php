<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  CountryService::country();
        foreach ($data as $value) {
            Country::query()->create([
                'name' =>  $value['name'],
                'code' => $value['code'],
                'flag_link' => 'https://flagsapi.com/'.$value['code'].'/flat/32.png'
            ]);
        }
    }
}
