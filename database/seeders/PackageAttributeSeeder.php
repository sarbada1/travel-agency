<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\TourPackage\AttributeGroup;
use App\Models\TourPackage\PackageAttribute;

class PackageAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define attribute groups with their attributes
        $attributeGroups = [
            'basic' => [
                'name' => 'Basic Information',
                'description' => 'Basic details about accommodations, meals, transportation and activities',
                'attributes' => [
                    [
                        'name' => 'Accommodations',
                        'slug' => 'accommodations',
                        'type' => 'rich_text',
                        'description' => 'Details about the accommodations included in the package',
                        'is_required' => true,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'Meals',
                        'slug' => 'meals',
                        'type' => 'array',
                        'description' => 'Meals included in the package (breakfast, lunch, dinner)',
                        'is_required' => true,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'Transportation',
                        'slug' => 'transportation',
                        'type' => 'rich_text',
                        'description' => 'Transportation details for the tour',
                        'is_required' => true,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'Activities',
                        'slug' => 'activities',
                        'type' => 'array',
                        'description' => 'Primary activities included in the tour',
                        'is_required' => true,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 4,
                    ],
                ]
            ],
            'inclusions' => [
                'name' => 'Inclusions & Exclusions',
                'description' => 'What is and isn\'t included in the package',
                'attributes' => [
                    [
                        'name' => 'Inclusions',
                        'slug' => 'inclusions',
                        'type' => 'array',
                        'description' => 'What is included in the package price',
                        'is_required' => true,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 5,
                    ],
                    [
                        'name' => 'Exclusions',
                        'slug' => 'exclusions',
                        'type' => 'array',
                        'description' => 'What is not included in the package price',
                        'is_required' => true,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 6,
                    ],
                ]
            ],
            'itinerary' => [
                'name' => 'Itinerary Details',
                'description' => 'Day-by-day breakdown and route information',
                'attributes' => [
                    [
                        'name' => 'Itinerary',
                        'slug' => 'itinerary',
                        'type' => 'json',
                        'description' => 'Day-by-day breakdown of the tour',
                        'is_required' => true,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 7,
                    ],
                    [
                        'name' => 'Route Map',
                        'slug' => 'route-map',
                        'type' => 'text',
                        'description' => 'URL or reference to route map',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 8,
                    ],
                ]
            ],
            'requirements' => [
                'name' => 'Tour Requirements',
                'description' => 'Gear, fitness and age requirements for participants',
                'attributes' => [
                    [
                        'name' => 'Gear Requirements',
                        'slug' => 'gear-requirements',
                        'type' => 'array',
                        'description' => 'Essential gear and equipment needed',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 9,
                    ],
                    [
                        'name' => 'Fitness Level',
                        'slug' => 'fitness-level',
                        'type' => 'text',
                        'description' => 'Required fitness level for the tour',
                        'is_required' => false,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 10,
                    ],
                    [
                        'name' => 'Age Restrictions',
                        'slug' => 'age-restrictions',
                        'type' => 'text',
                        'description' => 'Minimum/maximum age requirements',
                        'is_required' => false,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 11,
                    ],
                ]
            ],
            'booking' => [
                'name' => 'Booking Information',
                'description' => 'Policies, requirements and payment options',
                'attributes' => [
                    [
                        'name' => 'Cancellation Policy',
                        'slug' => 'cancellation-policy',
                        'type' => 'rich_text',
                        'description' => 'Terms for cancellation and refunds',
                        'is_required' => true,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 12,
                    ],
                    [
                        'name' => 'Booking Requirements',
                        'slug' => 'booking-requirements',
                        'type' => 'rich_text',
                        'description' => 'Documents and information needed for booking',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 13,
                    ],
                    [
                        'name' => 'Payment Options',
                        'slug' => 'payment-options',
                        'type' => 'array',
                        'description' => 'Available payment methods',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 14,
                    ],
                ]
            ],
            'extra' => [
                'name' => 'Additional Information',
                'description' => 'Optional activities, insurance and travel tips',
                'attributes' => [
                    [
                        'name' => 'Optional Activities',
                        'slug' => 'optional-activities',
                        'type' => 'array',
                        'description' => 'Additional activities available at extra cost',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 15,
                    ],
                    [
                        'name' => 'Travel Insurance',
                        'slug' => 'travel-insurance',
                        'type' => 'text',
                        'description' => 'Information about travel insurance options',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 16,
                    ],
                    [
                        'name' => 'Travel Tips',
                        'slug' => 'travel-tips',
                        'type' => 'rich_text',
                        'description' => 'Helpful tips for travelers',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 17,
                    ],
                    [
                        'name' => 'Weather Information',
                        'slug' => 'weather-information',
                        'type' => 'rich_text',
                        'description' => 'Typical weather patterns for the destination',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 18,
                    ],
                ]
            ],
            'location' => [
                'name' => 'Location Details',
                'description' => 'Destinations and attractions covered in the tour',
                'attributes' => [
                    [
                        'name' => 'Attractions',
                        'slug' => 'attractions',
                        'type' => 'array',
                        'description' => 'Key attractions covered in the tour',
                        'is_required' => false,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 19,
                    ],
                    [
                        'name' => 'Destinations',
                        'slug' => 'destinations',
                        'type' => 'array',
                        'description' => 'Cities/locations visited during the tour',
                        'is_required' => true,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 20,
                    ],
                ]
            ],
            'sustainability' => [
                'name' => 'Sustainability',
                'description' => 'Eco-friendly practices and cultural sensitivity',
                'attributes' => [
                    [
                        'name' => 'Eco-friendly Practices',
                        'slug' => 'eco-friendly-practices',
                        'type' => 'rich_text',
                        'description' => 'Sustainability measures implemented in the tour',
                        'is_required' => false,
                        'is_filterable' => true,
                        'active' => true,
                        'display_order' => 21,
                    ],
                    [
                        'name' => 'Cultural Sensitivity',
                        'slug' => 'cultural-sensitivity',
                        'type' => 'rich_text',
                        'description' => 'Information about respecting local cultures',
                        'is_required' => false,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 22,
                    ],
                ]
            ],
        ];

        foreach ($attributeGroups as $slug => $groupData) {
            $group = AttributeGroup::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $groupData['name'],
                    'slug' => $slug,
                    'description' => $groupData['description'],
                    'display_order' => array_search($slug, array_keys($attributeGroups)) + 1,
                    'active' => true
                ]
            );
            
            $this->command->info("Created attribute group: {$group->name}");
            
            // Create the attributes for this group
            foreach ($groupData['attributes'] as $attributeData) {
                // Link to the attribute group
                $attributeData['attribute_group_id'] = $group->id;
                
                // Remove the attribute_group field if it exists
                if (isset($attributeData['attribute_group'])) {
                    unset($attributeData['attribute_group']);
                }
                
                PackageAttribute::updateOrCreate(
                    ['slug' => $attributeData['slug']],
                    $attributeData
                );
                
            }
        }

    }
}