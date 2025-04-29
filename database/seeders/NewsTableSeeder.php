<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


//              'name' => 'Market Updates',
//
//                'name' => 'Industry Trends',
//                'slug' => 'industry-trends',
//                'name' => 'Company News',
//
//                'name' => 'Press Releases',
//
//                'name' => 'Events',
//
//                'name' => 'Announcements',

        $newsData = [
            [
                'parent_id' => null,
                'user_id' => 1,
                'category_id' => 1,
                'title'=>'',
                'slug'=>'',
                'sub_title'=>'',
                'summary'=>'',
                'description'=>'',
                'image'=>'',
                'meta_title'=>'',
                'meta_description'=>'',
                'meta_keywords'=>'',
            ]
        ];


    }
}
