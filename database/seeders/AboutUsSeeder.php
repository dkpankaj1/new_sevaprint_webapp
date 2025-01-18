<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            "title" => "Grow your website with our SEO Tools & Project Management",
            "description" => "You can browse free HTML templates on Too CSS website. Visit the website and explore latest website templates for your projects.",

            'achievements_one_title' => 'SEO Projects',
            'achievements_one_description' => 'Lorem ipsum dolor sitti amet, consectetur.',
            'achievements_one_count' => 120,

            'achievements_two_title' => 'Website',
            'achievements_two_description' => 'Lorem ipsum dolor sitti amet, consectetur.',
            'achievements_two_count' => 120,

            'achievements_three_title' => 'Satisfied Clients',
            'achievements_three_description' => 'Lorem ipsum dolor sitti amet, consectetur.',
            'achievements_three_count' => 120,

        ]);
    }
}
