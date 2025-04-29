<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog\BlogCategory;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            ['name' => 'Construction', 'slug' => 'construction', 'user_id' => 1],
            ['name' => 'Market Update', 'slug' => 'market-update', 'user_id' => 1],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'user_id' => 1],
            ['name' => 'Vastu', 'slug' => 'vastu', 'user_id' => 1],
            ['name' => 'Property', 'slug' => 'property', 'user_id' => 1],
            ['name' => 'Homeloan', 'slug' => 'homeloan', 'user_id' => 1],
            ['name' => 'History of real estate', 'slug' => 'history-of-real-estate', 'user_id' => 1],
            ['name' => 'Guide', 'slug' => 'guide', 'user_id' => 1],
        ];

        foreach ($categoryData as $data) {
            $total = BlogCategory::where('slug', $data['slug'])->count();
            if ($total == 0) {
                BlogCategory::create($data);
            }
        }
    }
}
