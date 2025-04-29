<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $countries = [
            [
                'continent_id' => 3,
                'country_name' => 'Nepal',
                'slug' => 'nepal',
                'code' => 'NP'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'India',
                'slug' => 'india',
                'code' => 'IN'
            ],
            [
                'continent_id' => 3,
                'country_name' => 'China',
                'slug' => 'china',
                'code' => 'CN'
            ],




        ];
        foreach ($countries as $key => $value) {
            $total = Country::where('country_name', $value['country_name'])->count();
            if ($total === 0) {
                Country::create($value);
            }
        }

    }
}
