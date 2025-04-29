<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial\Testimonial;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonialData = [
            [
                'name' => 'Jibesh Singh Gurung',
                'designation' => 'Actor, Singer',
                'description' => "The Tech Rastra team is very professional, knowledgeable, and always delivers on time. I am pleased with the results they have achieved for me. They have been beneficial for my Social Media and web-related stuff.",
                'image' => '',
                'status' => 1
            ],
            [
                'name' => 'Subash Shrestha',
                'designation' => 'Chartered Accountant',
                'description' => "If you’re looking for a web development company in Nepal that will take your business to the next level, look no further than Tech Rastra. The team is experienced, and proficient, I couldn’t be happier with the work they did on my website.",
                'image' => '',
                'status' => 1
            ],
            [
                'name' => 'Alpana Bhandari',
                'designation' => 'Lawyer',
                'description' => "Thank you for your work on our law site. We are delighted with the results. The site is well organized and easy to navigate. We appreciate your attention to detail and willingness to make changes as requested. We would recommend your company to others.",
                'image' => '',
                'status' => 1
            ],
            [
                'name' => 'Sopan Gochhe',
                'designation' => 'Structural Design Engineer',
                'description' => "I had a great experience working with Tech Rastra to design and develop my company’s website. They were able to deliver the project on time and within our budget. I highly recommend their services to anyone seeking a web design and development company in Nepal.",
                'image' => '',
                'status' => 1
            ]
        ];

        foreach ($testimonialData as $data) {
            $totalTestimonial = Testimonial::where('name', $data['name'])->count();
            if ($totalTestimonial === 0) {
                Testimonial::create($data);
            }
        }


    }
}
