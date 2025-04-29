<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageData = [
            [
                'user_id' => 1,
                'title' => 'About Us – Booking System',
                'slug' => 'about-us-booking-system',
                'sub_title' => 'About Us',
                'is_published' => 1,
                'icons' => 'bi bi-person',
                'summary' => "Booking System is a web development and digital marketing agency in Nepal.
                 An innovative team of young, tech-savvy,
                 marketing-passionate professionals founded the company.",
                'description' => "Booking System is a web development and digital marketing agency in Nepal.
                 An innovative team of young, tech-savvy,
                 marketing-passionate professionals founded the company.",
                'page_section_name' => 'about-us',
            ],
            [
                'user_id' => 1,
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'sub_title' => 'Terms & Conditions',
                'is_published' => 1,
                'icons' => 'bi bi-person',
                'summary' => "Booking System is a web development and digital marketing agency in Nepal.
                 An innovative team of young, tech-savvy,
                 marketing-passionate professionals founded the company.",
                'description' => "Booking System is a web development and digital marketing agency in Nepal.",
                'page_section_name' => 'terms-conditions',
            ],
        ];

        foreach ($pageData as $data) {
            $total = Page::where('slug', $data['slug'])->count();
            if ($total === 0) {
                Page::create($data);
            }
        }
    }
}
