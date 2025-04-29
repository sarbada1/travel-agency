<?php

namespace Database\Seeders;

use App\Models\Address\Continents;
use Illuminate\Database\Seeder;

class ContinentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $continentsData = [
            ['continent_name' => 'Africa','continent_code' => 'AF'],
            ['continent_name' => 'Antarctica','continent_code' => 'AN'],
            ['continent_name' => 'Asia','continent_code' => 'AS'],
            ['continent_name' => 'Europe','continent_code' => 'EU'],
            ['continent_name' => 'North America','continent_code' => 'NA'],
            ['continent_name' => 'Oceania','continent_code' => 'OC'],
            ['continent_name' => 'South America','continent_code' => 'SA']

        ];

        foreach ($continentsData as $continent) {
            $totalData = Continents::where('continent_name', $continent['continent_name'])->count();
            if ($totalData === 0) {
                Continents::create($continent);
            }
        }
    }
}
