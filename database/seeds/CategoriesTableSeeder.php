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
            'title' => 'Web Development',
            'parent_id' => '0',
        ]);
        Category::create([
            'title' => 'Design',
            'parent_id' => '0',
        ]);
        Category::create([
            'title' => 'Mobile Apps',
            'parent_id' => '0',
        ]);
        Category::create([
            'title' => 'Javascript',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'React',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'iOS',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Android',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'Swift',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'React Navite',
            'parent_id' => '3',
        ]);
        Category::create([
            'title' => 'NodeJS',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'PHP',
            'parent_id' => '1',
        ]);
        Category::create([
            'title' => 'WordPress',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Photoshop',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Responsive Design',
            'parent_id' => '2',
        ]);
        Category::create([
            'title' => 'Adobe XD',
            'parent_id' => '2',
        ]);
    }
}
