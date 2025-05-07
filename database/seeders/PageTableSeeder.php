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
        // First create core pages without parent dependencies
        $corePages = [
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'About Us',
                'slug' => 'about-us',
                'sub_title' => 'The rapid and reliable electrical services for your home or offices.',
                'is_published' => 1,
                'icons' => 'bi bi-person',
                'summary' => "We are your trusted service provider for any kind of electric issues, specializing in installations, repairs and maintenance. We ensure to provide you with rapid and reliable solutions for your home and businesses in the most affordable price possible.",
                'description' => "We are your trusted service provider for any kind of electric issues, specializing in installations, repairs and maintenance. We ensure to provide you with rapid and reliable solutions for your home and businesses in the most affordable price possible.",
                'page_section_name' => 'about-us',
            ],
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'sub_title' => 'Terms & Conditions',
                'is_published' => 1,
                'icons' => 'bi bi-shield-check',
                'summary' => "The rapid and reliable electrical services for your home or offices",
                'description' => "The rapid and reliable electrical services for your home or offices",
                'page_section_name' => 'terms-conditions',
            ],
   
            [
                'user_id' => 1,
                'parent_id' => null,
                'title' => 'Why Choose Us',
                'slug' => 'why-choose-us',
                'sub_title' => 'Choose us for reliable, safe, and high-quality electrical services delivered',
                'is_published' => 1,
                'icons' => 'bi bi-award',
                'summary' => "Discover why our clients trust us with their electrical needs",
                'description' => "We pride ourselves on providing reliable, efficient, and professional electrical services for homes and businesses.",
                'page_section_name' => 'why-choose-us',
            ],

        ];

        foreach ($corePages as $data) {
            $total = Page::where('slug', $data['slug'])->count();
            if ($total === 0) {
                Page::create($data);
            }
        }

  
     
        $whyChooseUsPage = Page::where('slug', 'why-choose-us')->first();

        if ($whyChooseUsPage) {
            $features = [
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Rapid & Reliable Service',
                    'slug' => 'rapid-reliable-service',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-lightning',
                    'image' => 'features/feature-1.png',
                    'summary' => "Round-the-clock assistance, ensuring client safety throughout their electrical project.",
                    'description' => "Our rapid response team is available 24/7 to address any electrical emergencies or urgent needs. We understand that electrical issues can disrupt your life or business, which is why we prioritize quick response times and efficient service delivery.",
                    'page_section_name' => 'feature-rapid-service',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Affordable Pricing',
                    'slug' => 'affordable-pricing',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-cash-coin',
                    'image' => 'features/feature-2.png',
                    'summary' => "Competitive rates without compromising on quality, providing excellent value for all electrical work.",
                    'description' => "We offer competitive, transparent pricing with no hidden costs. Our quotes are detailed and fair, ensuring you get excellent value for high-quality electrical work. We work within your budget without compromising on quality or safety.",
                    'page_section_name' => 'feature-pricing',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => '100% Customer Satisfaction',
                    'slug' => '100-customer-satisfaction',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-emoji-smile',
                    'image' => 'features/feature-3.png',
                    'summary' => "Committed to exceptional service quality and complete customer satisfaction on every project.",
                    'description' => "Our commitment to customer satisfaction drives everything we do. We listen carefully to your needs, communicate clearly throughout the process, and ensure that our work meets or exceeds your expectations. Our success is measured by your satisfaction.",
                    'page_section_name' => 'feature-satisfaction',
                ],
                [
                    'user_id' => 1,
                    'parent_id' => $whyChooseUsPage->id,
                    'title' => 'Installation, Maintenance & Repairs',
                    'slug' => 'installation-maintenance-repairs',
                    'sub_title' => '',
                    'is_published' => 1,
                    'icons' => 'bi bi-tools',
                    'image' => 'features/feature-4.png',
                    'summary' => "Comprehensive electrical services from installation and maintenance to prompt repairs.",
                    'description' => "We provide a full spectrum of electrical services, from new installations and system upgrades to routine maintenance and emergency repairs. Our skilled technicians are equipped to handle all your electrical needs, ensuring your systems function safely and efficiently.",
                    'page_section_name' => 'feature-services',
                ],
            ];

            foreach ($features as $data) {
                $total = Page::where('slug', $data['slug'])->count();
                if ($total === 0) {
                    Page::create($data);
                }
            }
        }
    }
}