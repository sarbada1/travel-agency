<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settingData = [
            'name' => 'Booking system',
            'slug' => 'booking-system',
            'sub_name' => 'Booking system',
            'slogan' => 'we are best in Nepal',
            'email' => 'hello@bookingnepal.com',
            'address' => 'Kathmandu, Nepal',
            'phone' => '9843363725',
            'mobile' => '9843363725',
            'logo' => '',
            'favicon' => '',
            'description' => "BookingNepal.com is a portal dedicated to providing comprehensive information and resources related to educational consultancies in Nepal.",
            'meta_title' => 'ConsultancyNP.com - Educational Consultancies in Nepal',
            'meta_description' => "BookingNepal.com is a portal dedicated to providing comprehensive information and resources related to educational consultancies in Nepal.",
            'meta_keywords' => '',
        ];

        $total = Setting::count();
        if ($total == 0) {
            Setting::create($settingData);
        }

    }
}
