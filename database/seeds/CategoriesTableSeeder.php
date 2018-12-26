<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();
        Category::create([
            'title' => 'Development',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-code color-8'
        ]);
        Category::create([
            'title' => 'Business',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-briefcase color-5'
        ]);
        Category::create([
            'title' => 'IT & Software',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-laptop-phone color-2'
        ]);
        Category::create([
            'title' => 'Design',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-pencil color-7'
        ]);
        Category::create([
            'title' => 'Marketing',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-briefcase color-1'
        ]);
        Category::create([
            'title' => 'Lifestyle',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-magic-wand color-4'
        ]);
        Category::create([
            'title' => 'Photography',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-camera color-3'
        ]);
        Category::create([
            'title' => 'Health & Fitness',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-heart-pulse color-6'
        ]);
        // Sub Development
        Category::create([
            'title' => 'Web Development',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Mobile Apps',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Programming Languages',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Game Development',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Databases',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Software Testing',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Software Engineering',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Development Tools',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'E-Commerce',
            'parent_id' => '1',
        ]);
        // Sub Bussiness
        Category::create([
            'title' => 'Finance',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Entrepreneurship',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Communications',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Management',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Sales',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Strategy',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Operations',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Project Management',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Business Law',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Data Analytics',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Home Business',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Human Resources',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Industry',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Media',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Real Estate',
            'parent_id' => '2',
        ]);
        // Sub IT & Software
        Category::create([
            'title' => 'IT Certification',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Network & Security',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Hardware',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Operating Systems',
            'parent_id' => '3',
        ]);
        // Sub Design
        Category::create([
            'title' => 'Web Design',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Graphic Design',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Design Tools',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'User Experience',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Game Design',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Design Thinking',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => '3D & Animation',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Fashion',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Architectural Design',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Interior Design',
            'parent_id' => '4',
        ]);
        // Sub Marketing
        Category::create([
            'title' => 'Digital Marketing',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Search Engine Optimization',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Social Media Marketing',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Branding',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Marketing Fundamentals',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Analytics & Automation',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Public Relations',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Advertising',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Video & Mobile Marketing',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Content Marketing',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Growth Hacking',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Affiliate Marketing',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Product Marketing',
            'parent_id' => '5',
        ]);
        // Sub Lifestyle
        Category::create([
            'title' => 'Arts & Crafts',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Food & Beverage',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Beauty & Makeup',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Travel',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Gaming',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Home Improvement',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Pet Care & Training',
            'parent_id' => '6',
        ]);
        // Sub Photography
        Category::create([
            'title' => 'Digital Photography',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Photography Fundamentals',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Portraits',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Photography Tools',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Commercial Photography',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Video Design',
            'parent_id' => '7',
        ]);
        // Sub Health & Fitness
        Category::create([
            'title' => 'Fitness',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'General Health',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Sports',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Nutrition',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Yoga',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Mental Health',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Dieting',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Self Defense',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Safety & First Aid',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Dance',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Meditation',
            'parent_id' => '8',
        ]);
    }
}
