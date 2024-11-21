<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Elmira Estate',
            'logo_path' => '/images/logo.png',
            'hero_title' => 'Discover Your Dream <br>Luxury Home',
            'hero_subtitle' => 'Experience the epitome of luxury living with our handpicked selection of premium properties. Each home tells a unique story of elegance and sophistication.',
            'hero_cta_text' => 'Explore Properties',
            'hero_cta_link' => '/properties',
            'hero_background_image' => '/images/hero-bg.jpg',
        ]);
    }
}
