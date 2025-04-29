<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad\AdPosition;

class AdPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'name' => 'Home Sponsored Banner',
                'identifier' => 'home_sponsored_banner',
                'description' => 'Appears after the header section on the home page'
            ],
            [
                'name' => 'Home Categories Banner',
                'identifier' => 'home_categories_banner',
                'description' => 'Appears below or within the categories section on home page'
            ],
            [
                'name' => 'Home Featured Listings Banner',
                'identifier' => 'home_listings_banner',
                'description' => 'Appears within the featured listings section on home page'
            ],
            [
                'name' => 'Home Blog Banner',
                'identifier' => 'home_blog_banner',
                'description' => 'Appears within or after the blog section on home page'
            ],
            [
                'name' => 'Blog Sidebar Top',
                'identifier' => 'blog_sidebar_top',
                'description' => 'Appears at the top of the blog sidebar'
            ],
            [
                'name' => 'Blog After Content',
                'identifier' => 'blog_after_content',
                'description' => 'Appears after blog post content'
            ],
            [
                'name' => 'Real Estate Top Banner',
                'identifier' => 'real_estate_top_banner',
                'description' => 'Appears at the top of real estate listings page'
            ],
            [
                'name' => 'Real Estate Sidebar',
                'identifier' => 'real_estate_sidebar',
                'description' => 'Appears in the sidebar of real estate listings page'
            ]
        ];

        foreach ($positions as $key => $value) {
            $total = AdPosition::where('identifier', $value['identifier'])->count();
            if ($total === 0) {
                AdPosition::create($value);
            }
        }
    }
}