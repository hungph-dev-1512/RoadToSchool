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
            'vi_title' => 'Phát triển',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-code color-8'
        ]);
        Category::create([
            'title' => 'Business',
            'vi_title' => 'Kinh doanh',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-briefcase color-5'
        ]);
        Category::create([
            'title' => 'IT & Software',
            'vi_title' => 'IT & Phần mềm',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-laptop-phone color-2'
        ]);
        Category::create([
            'title' => 'Design',
            'vi_title' => 'Thiết kế',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-pencil color-7'
        ]);
        Category::create([
            'title' => 'Marketing',
            'vi_title' => 'Marketing',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-briefcase color-1'
        ]);
        Category::create([
            'title' => 'Lifestyle',
            'vi_title' => 'Kĩ năng sống',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-magic-wand color-4'
        ]);
        Category::create([
            'title' => 'Photography',
            'vi_title' => 'Nhiếp ảnh',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-camera color-3'
        ]);
        Category::create([
            'title' => 'Health & Fitness',
            'vi_title' => 'Sức khỏe & Thể hình',
            'parent_id' => '0',
            'css_classes' => 'lnr lnr-heart-pulse color-6'
        ]);
        // Sub Development
        Category::create([
            'title' => 'Web Development',
            'vi_title' => 'Phát triển web',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Mobile Apps',
            'vi_title' => 'Ứng dụng di động',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Programming Languages',
            'vi_title' => 'Ngôn ngữ lập trình',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Game Development',
            'vi_title' => 'Phát triển game',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Databases',
            'vi_title' => 'Cơ sở dữ liệu',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Software Testing',
            'vi_title' => 'Kiểm thử phần mềm',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Software Engineering',
            'vi_title' => 'Kỹ sư phần mềm',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'Development Tools',
            'vi_title' => 'TODO',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'E-Commerce',
            'vi_title' => 'TODO',
            'parent_id' => '1',
        ]);
        // Sub Bussiness
        Category::create([
            'title' => 'Finance',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Entrepreneurship',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Communications',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Management',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Sales',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Strategy',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Operations',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Project Management',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Business Law',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Data Analytics',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Home Business',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Human Resources',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Industry',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Media',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Real Estate',
            'vi_title' => 'TODO',
            'parent_id' => '2',
        ]);
        // Sub IT & Software
        Category::create([
            'title' => 'IT Certification',
            'vi_title' => 'TODO',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Network & Security',
            'vi_title' => 'TODO',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Hardware',
            'vi_title' => 'TODO',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Operating Systems',
            'vi_title' => 'TODO',
            'parent_id' => '3',
        ]);
        // Sub Design
        Category::create([
            'title' => 'Web Design',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Graphic Design',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Design Tools',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'User Experience',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Game Design',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Design Thinking',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => '3D & Animation',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Fashion',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Architectural Design',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        Category::create([
            'title' => 'Interior Design',
            'vi_title' => 'TODO',
            'parent_id' => '4',
        ]);
        // Sub Marketing
        Category::create([
            'title' => 'Digital Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Search Engine Optimization',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Social Media Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Branding',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Marketing Fundamentals',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Analytics & Automation',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Public Relations',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Advertising',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Video & Mobile Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Content Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Growth Hacking',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Affiliate Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        Category::create([
            'title' => 'Product Marketing',
            'vi_title' => 'TODO',
            'parent_id' => '5',
        ]);
        // Sub Lifestyle
        Category::create([
            'title' => 'Arts & Crafts',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Food & Beverage',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Beauty & Makeup',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Travel',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Gaming',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Home Improvement',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        Category::create([
            'title' => 'Pet Care & Training',
            'vi_title' => 'TODO',
            'parent_id' => '6',
        ]);
        // Sub Photography
        Category::create([
            'title' => 'Digital Photography',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Photography Fundamentals',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Portraits',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Photography Tools',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Commercial Photography',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        Category::create([
            'title' => 'Video Design',
            'vi_title' => 'TODO',
            'parent_id' => '7',
        ]);
        // Sub Health & Fitness
        Category::create([
            'title' => 'Fitness',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'General Health',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Sports',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Nutrition',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Yoga',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Mental Health',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Dieting',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Self Defense',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Safety & First Aid',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Dance',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
        Category::create([
            'title' => 'Meditation',
            'vi_title' => 'TODO',
            'parent_id' => '8',
        ]);
    }
}
