<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourPackage\TourPackage;
use App\Models\TourPackage\PackageAttributeValue;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            // Define tour packages with direct category IDs
            $tourPackages = [
                [
                    'title' => 'Everest Base Camp Trek',
                    'category_id' => 2, // Adventure Tours
                    'duration_days' => 14,
                    'price' => 1499,
                    'price_type' => 'per_person',
                    'difficulty_level' => 'difficult',
                    'destination_id' => 13, // Nepal
                    'description' => 'Experience the adventure of a lifetime trekking to the base of the world\'s highest mountain.',
                    'is_featured' => true,
                    'attributes' => [
                        1 => 'Tea houses and mountain lodges throughout the trek.', // Accommodations (ID: 1)
                        2 => json_encode(['Breakfast', 'Lunch', 'Dinner']),       // Meals (ID: 2)
                        3 => 'Return flights from Kathmandu to Lukla.',           // Transportation (ID: 3)
                    ]
                ],
                
                [
                    'title' => 'Annapurna Circuit Trek',
                    'category_id' => 2, // Adventure Tours
                    'duration_days' => 16,
                    'price' => 1299,
                    'price_type' => 'per_person',
                    'difficulty_level' => 'moderate',
                    'destination_id' => 13, // Nepal
                    'description' => 'Circle the entire Annapurna massif on this classic Himalayan trek.',
                    'is_featured' => true,
                    'attributes' => [
                        1 => 'Teahouses throughout the trek.',
                        2 => json_encode(['Breakfast', 'Lunch', 'Dinner']),
                        3 => 'All ground transportation from Kathmandu to trailhead and return.',
                    ]
                ],
                
                // India packages (assuming destination_id=14 for India, package_category_id=3 for Cultural Tours)
                [
                    'title' => 'Golden Triangle Tour',
                    'category_id' => 3, // Cultural Tours
                    'duration_days' => 7,
                    'price' => 799,
                    'price_type' => 'per_person',
                    'difficulty_level' => 'easy',
                    'destination_id' => 14, // India
                    'description' => 'Discover the iconic Golden Triangle of India, visiting Delhi, Agra, and Jaipur.',
                    'is_featured' => true,
                    'attributes' => [
                        1 => '4-star hotels throughout the tour.',
                        2 => json_encode(['Breakfast', 'Selected lunches and dinners']),
                        3 => 'Air-conditioned private vehicle throughout the tour.',
                    ]
                ],
                
                // Thailand packages (assuming destination_id=15 for Thailand, package_category_id=5 for Multi-day Tours)
                [
                    'title' => 'Bangkok & Phuket Highlights',
                    'category_id' => 5, // Multi-day Tours
                    'duration_days' => 8,
                    'price' => 899,
                    'price_type' => 'per_person',
                    'difficulty_level' => 'easy',
                    'destination_id' => 15, // Thailand
                    'description' => 'Experience the best of Thailand with Bangkok and beach relaxation in Phuket.',
                    'is_featured' => true,
                    'attributes' => [
                        1 => '3-star hotels in Bangkok and Phuket.',
                        2 => json_encode(['Breakfast']),
                        3 => 'Domestic flights and private transfers.',
                    ]
                ]
            ];

            // Create tour packages with direct ID references
            foreach ($tourPackages as $packageData) {
                // Extract destination_id for reference but don't use it in package creation
                $destinationId = $packageData['destination_id'] ?? null;
                unset($packageData['destination_id']);
                
                // Extract attributes before creating package
                $attributes = $packageData['attributes'] ?? [];
                unset($packageData['attributes']);
                
                // Create the package
                $package = TourPackage::updateOrCreate(
                    ['slug' => Str::slug($packageData['title'])],
                    array_merge($packageData, [
                        'slug' => Str::slug($packageData['title']),
                        'sub_title' => $packageData['description'] ?? null,
                        'overview' => $packageData['description'] ?? null,
                        'user_id' => 1, // Admin user
                        'status' => 'published',
                    ])
                );
                
                $this->command->info("Created package: {$package->title}");
                
                // Create attribute values with direct IDs
                foreach ($attributes as $attributeId => $value) {
                    PackageAttributeValue::updateOrCreate(
                        [
                            'tour_package_id' => $package->id,
                            'package_attribute_id' => $attributeId
                        ],
                        [
                            'value' => $value
                        ]
                    );
                }
            }
            
            
   
    }
}

// Itinerary (ID: 6): {"Day 1":"Arrival in Kathmandu (1,400m)","Day 2":"Fly to Lukla (2,840m), trek to Phakding (2,610m)","Day 3":"Trek to Namche Bazaar (3,440m)","Day 4":"Acclimatization day in Namche Bazaar","Day 5":"Trek to Tengboche (3,860m)","Day 6":"Trek to Dingboche (4,410m)","Day 7":"Acclimatization day in Dingboche","Day 8":"Trek to Lobuche (4,940m)","Day 9":"Trek to Everest Base Camp (5,364m) and back to Gorak Shep (5,170m)","Day 10":"Hike to Kala Patthar (5,545m), trek to Pheriche (4,280m)","Day 11":"Trek to Namche Bazaar (3,440m)","Day 12":"Trek to Lukla (2,840m)","Day 13":"Fly to Kathmandu","Day 14":"Departure"}