<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category\Category;
use App\Models\TourPackage\PackageAttribute;

class CategoryAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all package attributes for easier reference
        $attributes = PackageAttribute::all()->keyBy('slug');
        
        // Define attribute associations for different category types
        $categoryAttributeMap = [
            // Tour Package categories
            'adventure-tours' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
                'gear-requirements' => ['required' => true, 'filterable' => false, 'order' => 8],
                'fitness-level' => ['required' => true, 'filterable' => true, 'order' => 9],
                'age-restrictions' => ['required' => false, 'filterable' => true, 'order' => 10],
                'eco-friendly-practices' => ['required' => false, 'filterable' => true, 'order' => 11],
            ],
            'cultural-tours' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
                'cultural-sensitivity' => ['required' => true, 'filterable' => false, 'order' => 8],
                'attractions' => ['required' => true, 'filterable' => true, 'order' => 9],
            ],
            'wildlife-tours' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
                'gear-requirements' => ['required' => false, 'filterable' => false, 'order' => 8],
                'attractions' => ['required' => true, 'filterable' => true, 'order' => 9],
                'eco-friendly-practices' => ['required' => true, 'filterable' => true, 'order' => 10],
            ],
            
            // Activity categories
            'trekking' => [
                'gear-requirements' => ['required' => true, 'filterable' => true, 'order' => 1],
                'fitness-level' => ['required' => true, 'filterable' => true, 'order' => 2],
                'age-restrictions' => ['required' => true, 'filterable' => true, 'order' => 3],
                'route-map' => ['required' => true, 'filterable' => false, 'order' => 4],
                'weather-information' => ['required' => true, 'filterable' => false, 'order' => 5],
            ],
            'rafting' => [
                'gear-requirements' => ['required' => true, 'filterable' => true, 'order' => 1],
                'fitness-level' => ['required' => true, 'filterable' => true, 'order' => 2],
                'age-restrictions' => ['required' => true, 'filterable' => true, 'order' => 3],
                'safety-measures' => ['required' => true, 'filterable' => false, 'order' => 4],
                'weather-information' => ['required' => true, 'filterable' => false, 'order' => 5],
            ],
            
            // Special interest categories  
            'honeymoon' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
            ],
            'family-travel' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
                'age-restrictions' => ['required' => true, 'filterable' => true, 'order' => 8],
            ],
            
            // Destination categories should inherit attributes from their parent tour types
            
            // Add fallback for main categories to ensure all tour types have essential attributes
            'tours-packages' => [
                'accommodations' => ['required' => true, 'filterable' => true, 'order' => 1],
                'meals' => ['required' => true, 'filterable' => true, 'order' => 2],
                'transportation' => ['required' => true, 'filterable' => true, 'order' => 3],
                'activities' => ['required' => true, 'filterable' => true, 'order' => 4],
                'inclusions' => ['required' => true, 'filterable' => false, 'order' => 5],
                'exclusions' => ['required' => true, 'filterable' => false, 'order' => 6],
                'itinerary' => ['required' => true, 'filterable' => false, 'order' => 7],
            ],
            'destinations' => [
                'attractions' => ['required' => true, 'filterable' => true, 'order' => 1],
                'weather-information' => ['required' => false, 'filterable' => false, 'order' => 2],
                'cultural-sensitivity' => ['required' => false, 'filterable' => false, 'order' => 3],
            ],
            'activities' => [
                'fitness-level' => ['required' => true, 'filterable' => true, 'order' => 1],
                'gear-requirements' => ['required' => false, 'filterable' => true, 'order' => 2],
                'age-restrictions' => ['required' => false, 'filterable' => true, 'order' => 3],
            ],
        ];
        
        // Create the category attribute relationships
        foreach ($categoryAttributeMap as $categorySlug => $attributeData) {
            $category = Category::where('slug', $categorySlug)->first();
            
            if (!$category) {
                $this->command->warn("Category not found: $categorySlug");
                continue;
            }
            
            $syncData = [];
            
            foreach ($attributeData as $attributeSlug => $settings) {
                if (!isset($attributes[$attributeSlug])) {
                    $this->command->warn("Attribute not found: $attributeSlug");
                    continue;
                }
                
                $attributeId = $attributes[$attributeSlug]->id;
                
                $syncData[$attributeId] = [
                    'is_required' => $settings['required'],
                    'is_featured' => $settings['filterable'],
                    'display_order' => $settings['order'],
                ];
            }
            
            // Sync attributes to the category
            $category->attributes()->sync($syncData);
            
            $this->command->info("Associated " . count($syncData) . " attributes with category: {$category->name}");
        }
        
        // Add a special safety attribute for rafting if it doesn't exist
        if (!isset($attributes['safety-measures'])) {
            $rafting = Category::where('slug', 'rafting')->first();
            
            if ($rafting) {
                // Find the right attribute group
                $requirementsGroup = \App\Models\TourPackage\AttributeGroup::where('slug', 'requirements')->first();
                
                if ($requirementsGroup) {
                    // Create the safety measures attribute
                    $safetyAttr = PackageAttribute::create([
                        'name' => 'Safety Measures',
                        'slug' => 'safety-measures',
                        'attribute_group_id' => $requirementsGroup->id,
                        'type' => 'rich_text',
                        'description' => 'Safety procedures and precautions for water activities',
                        'is_required' => true,
                        'is_filterable' => false,
                        'active' => true,
                        'display_order' => 23,
                    ]);
                    
                    // Associate it with the rafting category
                    $rafting->attributes()->attach($safetyAttr->id, [
                        'is_required' => true,
                        'is_featured' => false,
                        'display_order' => 4,
                    ]);
                    
                    $this->command->info("Created and associated Safety Measures attribute with Rafting category");
                }
            }
        }
    }
}