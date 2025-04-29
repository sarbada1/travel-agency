<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting\SocialMedia;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMediaData = [
            [
                'name' => 'Facebook',
                'icon' => 'fab fa-facebook-f',
                'url' => 'https://www.facebook.com/',
                'status' => 1,

            ],
            [
                'name' => 'Twitter',
                'icon' => 'fab fa-twitter',
                'url' => 'https://twitter.com/',
                'status' => 1,

            ],
            [
                'name' => 'Instagram',
                'icon' => 'fab fa-instagram',
                'url' => 'https://www.instagram.com/',
                'status' => 1,

            ],
            [
                'name' => 'Linkedin',
                'icon' => 'fab fa-linkedin-in',
                'url' => 'https://www.linkedin.com/',
                'status' => 1,

            ],
            [
                'name' => 'Youtube',
                'icon' => 'fab fa-youtube',
                'url' => 'https://www.youtube.com/',
                'status' => 1,

            ],
            [
                'name' => 'Pinterest',
                'icon' => 'fab fa-pinterest',
                'url' => 'https://www.pinterest.com/',
                'status' => 1,

            ],
            [
                'name' => 'Snapchat',
                'icon' => 'fab fa-snapchat-ghost',
                'url' => 'https://www.snapchat.com/',
                'status' => 1,

            ],
            [
                'name' => 'Reddit',
                'icon' => 'fab fa-reddit-alien',
                'url' => 'https://www.reddit.com/',
                'status' => 1,

            ],

        ];
        foreach ($socialMediaData as $data) {
            $total = SocialMedia::where('name', $data['name'])->count();
            if ($total == 0) {
                SocialMedia::create($data);
            }
        }
    }
}
