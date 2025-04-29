<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define main categories for travel agency
        $mainCategories = [
            [
                'name' => 'Tours & Packages',
                'slug' => 'tours-packages',
                'page_type' => 'tour_package',
                'is_main' => true,
                'user_id' => 1,
                'description' => 'Explore our wide range of tour packages',
                'icon' => 'fa-suitcase',
                'status' => 1
            ],
            [
                'name' => 'Destinations',
                'slug' => 'destinations',
                'page_type' => 'destination',
                'is_main' => true,
                'user_id' => 1,
                'description' => 'Discover amazing places around the world',
                'icon' => 'fa-map-marker',
                'status' => 1
            ],
            [
                'name' => 'Activities',
                'slug' => 'activities',
                'page_type' => 'activity',
                'is_main' => true,
                'user_id' => 1,
                'description' => 'Find exciting activities for your trip',
                'icon' => 'fa-hiking',
                'status' => 1
            ],
            [
                'name' => 'Special Interests',
                'slug' => 'special-interests',
                'page_type' => 'tour_package',
                'is_main' => true,
                'user_id' => 1,
                'description' => 'Specialized tours for specific interests',
                'icon' => 'fa-star',
                'status' => 1
            ],
            [
                'name' => 'Travel Services',
                'slug' => 'travel-services',
                'page_type' => 'travel-guide',
                'is_main' => true,
                'user_id' => 1,
                'description' => 'Additional services to enhance your travel experience',
                'icon' => 'fa-concierge-bell',
                'status' => 1
            ]
        ];

        // Create or update main categories
        foreach ($mainCategories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // Define subcategories for each main category
        $subcategories = [
            // Tours & Packages subcategories
            'tours-packages' => [
                ['name' => 'Adventure Tours', 'slug' => 'adventure-tours', 'user_id' => 1, 'icon' => 'fa-mountain', 'description' => 'Thrilling adventures for the daring traveler'],
                ['name' => 'Cultural Tours', 'slug' => 'cultural-tours', 'user_id' => 1, 'icon' => 'fa-landmark', 'description' => 'Immerse yourself in local cultures and traditions'],
                ['name' => 'Wildlife Tours', 'slug' => 'wildlife-tours', 'user_id' => 1, 'icon' => 'fa-paw', 'description' => 'Observe amazing wildlife in their natural habitats'],
                ['name' => 'City Tours', 'slug' => 'city-tours', 'user_id' => 1, 'icon' => 'fa-city', 'description' => 'Explore urban landscapes and city attractions'],
                ['name' => 'Multi-Day Tours', 'slug' => 'multi-day-tours', 'user_id' => 1, 'icon' => 'fa-calendar-alt', 'description' => 'Comprehensive tours spanning multiple days'],
                ['name' => 'Day Trips', 'slug' => 'day-trips', 'user_id' => 1, 'icon' => 'fa-sun', 'description' => 'Quick getaways packed with excitement'],
            ],
            
            // Destinations subcategories
            'destinations' => [
                ['name' => 'Asia', 'slug' => 'asia', 'user_id' => 1, 'icon' => 'fa-globe-asia', 'description' => 'Explore the diverse cultures and landscapes of Asia'],
                ['name' => 'Europe', 'slug' => 'europe', 'user_id' => 1, 'icon' => 'fa-globe-europe', 'description' => 'Discover historic cities and stunning landscapes'],
                ['name' => 'North America', 'slug' => 'north-america', 'user_id' => 1, 'icon' => 'fa-globe-americas', 'description' => 'Experience the natural wonders and vibrant cities'],
                ['name' => 'South America', 'slug' => 'south-america', 'user_id' => 1, 'icon' => 'fa-globe-americas', 'description' => 'Adventure through rainforests and ancient ruins'],
                ['name' => 'Africa', 'slug' => 'africa', 'user_id' => 1, 'icon' => 'fa-globe-africa', 'description' => 'Safari adventures and cultural experiences'],
                ['name' => 'Oceania', 'slug' => 'oceania', 'user_id' => 1, 'icon' => 'fa-globe', 'description' => 'Island paradises and unique wildlife'],
            ],
            
            // Activities subcategories
            'activities' => [
                ['name' => 'Trekking', 'slug' => 'trekking', 'user_id' => 1, 'icon' => 'fa-hiking', 'description' => 'Explore magnificent trails and mountain paths'],
                ['name' => 'Rafting', 'slug' => 'rafting', 'user_id' =>  1, 'icon' => 'fa-water', 'description' => 'Thrilling white water adventures'],
                ['name' => 'Scuba Diving', 'slug' => 'scuba-diving', 'user_id' => 1, 'icon' => 'fa-swimmer', 'description' => 'Discover underwater wonders and marine life'],
                ['name' => 'Wildlife Safari', 'slug' => 'wildlife-safari', 'user_id' => 1, 'icon' => 'fa-binoculars', 'description' => 'Observe exotic animals in their natural habitats'],
                ['name' => 'Cultural Experiences', 'slug' => 'cultural-experiences', 'user_id' => 1, 'icon' => 'fa-theater-masks', 'description' => 'Engage with local traditions and customs'],
                ['name' => 'Food Tours', 'slug' => 'food-tours', 'user_id' => 1, 'icon' => 'fa-utensils', 'description' => 'Culinary adventures and local cuisine exploration'],
            ],
            
            // Special Interests subcategories
            'special-interests' => [
                ['name' => 'Honeymoon', 'slug' => 'honeymoon', 'user_id' => 1, 'icon' => 'fa-heart', 'description' => 'Romantic getaways for newlyweds'],
                ['name' => 'Family Travel', 'slug' => 'family-travel', 'user_id' => 1, 'icon' => 'fa-users', 'description' => 'Kid-friendly adventures for the whole family'],
                ['name' => 'Solo Travel', 'slug' => 'solo-travel', 'user_id' => 1, 'icon' => 'fa-user', 'description' => 'Perfect journeys for independent travelers'],
                ['name' => 'Senior Travel', 'slug' => 'senior-travel', 'user_id' => 1, 'icon' => 'fa-walking', 'description' => 'Comfortable paced tours for mature travelers'],
                ['name' => 'Eco Tourism', 'slug' => 'eco-tourism', 'user_id' => 1, 'icon' => 'fa-leaf', 'description' => 'Sustainable and environmentally conscious travel'],
                ['name' => 'Photography Tours', 'slug' => 'photography-tours', 'user_id' => 1, 'icon' => 'fa-camera', 'description' => 'Capture stunning landscapes and moments'],
            ],
            
            // Travel Services subcategories
            'travel-services' => [
                ['name' => 'Visa Services', 'slug' => 'visa-services', 'user_id' => 1, 'icon' => 'fa-passport', 'description' => 'Assistance with visa applications and requirements'],
                ['name' => 'Airport Transfers', 'slug' => 'airport-transfers', 'user_id' => 1, 'icon' => 'fa-shuttle-van', 'description' => 'Comfortable transportation to and from airports'],
                ['name' => 'Travel Insurance', 'slug' => 'travel-insurance', 'user_id' => 1, 'icon' => 'fa-shield-alt', 'description' => 'Protection and peace of mind for your journey'],
                ['name' => 'Currency Exchange', 'slug' => 'currency-exchange', 'user_id' => 1, 'icon' => 'fa-money-bill-wave', 'description' => 'Convenient currency conversion services'],
                ['name' => 'Equipment Rental', 'slug' => 'equipment-rental', 'user_id' => 1, 'icon' => 'fa-toolbox', 'description' => 'Rent gear for your adventure activities'],
                ['name' => 'Tour Guides', 'slug' => 'tour-guides', 'user_id' => 1, 'icon' => 'fa-user-tie', 'description' => 'Professional guides to enhance your experience'],
            ],
        ];

        // Add third-level categories
        $nestedSubcategories = [
            'asia' => [
                ['name' => 'Nepal', 'slug' => 'nepal', 'user_id' => 1, 'icon' => 'fa-mountain', 'description' => 'Land of Himalayas and ancient cultures'],
                ['name' => 'India', 'slug' => 'india', 'user_id' => 1, 'icon' => 'fa-gopuram', 'description' => 'Diverse landscapes and rich heritage'],
                ['name' => 'Thailand', 'slug' => 'thailand', 'user_id' => 1, 'icon' => 'fa-umbrella-beach', 'description' => 'Beautiful beaches and vibrant city life'],
                ['name' => 'Japan', 'slug' => 'japan', 'user_id' => 1, 'icon' => 'fa-torii-gate', 'description' => 'Blend of traditional culture and modern innovation'],
            ],
            'europe' => [
                ['name' => 'Italy', 'slug' => 'italy', 'user_id' => 1, 'icon' => 'fa-pizza-slice', 'description' => 'Art, history, and culinary delights'],
                ['name' => 'France', 'slug' => 'france', 'user_id' => 1, 'icon' => 'fa-wine-glass', 'description' => 'Romance, culture, and exquisite cuisine'],
                ['name' => 'Spain', 'slug' => 'spain', 'user_id' => 1, 'icon' => 'fa-fan', 'description' => 'Vibrant festivals and beautiful beaches'],
                ['name' => 'United Kingdom', 'slug' => 'united-kingdom', 'user_id' => 1, 'icon' => 'fa-crown', 'description' => 'Historic landmarks and countryside beauty'],
            ],
        ];

        // Create subcategories for each main category
        foreach ($subcategories as $mainSlug => $subCats) {
            // Get the main category
            $mainCategory = Category::where('slug', $mainSlug)->first();
            
            if ($mainCategory) {
                foreach ($subCats as $subData) {
                    // Include parent_id in the subcategory data
                    $subData['parent_id'] = $mainCategory->id;
                    
                    // Inherit page_type from parent if not specified
                    if (!isset($subData['page_type'])) {
                        $subData['page_type'] = $mainCategory->page_type;
                    }
                    
                    // Set default status
                    $subData['status'] = 1;
                    
                    // Create or update the subcategory
                    Category::updateOrCreate(
                        ['slug' => $subData['slug']],
                        $subData
                    );
                }
            }
        }
        
        // Create third-level categories (nested subcategories)
        foreach ($nestedSubcategories as $parentSlug => $nestedCats) {
            // Get the parent subcategory
            $parentCategory = Category::where('slug', $parentSlug)->first();
            
            if ($parentCategory) {
                foreach ($nestedCats as $nestedData) {
                    // Include parent_id in the nested subcategory data
                    $nestedData['parent_id'] = $parentCategory->id;
                    
                    // Inherit page_type from parent
                    $nestedData['page_type'] = $parentCategory->page_type;
                    
                    // Set default status
                    $nestedData['status'] = 1;
                    
                    // Create or update the nested subcategory
                    Category::updateOrCreate(
                        ['slug' => $nestedData['slug']],
                        $nestedData
                    );
                }
            }
        }
    }
}