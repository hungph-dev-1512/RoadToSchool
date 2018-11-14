<?php
use Illuminate\Database\Seeder;
use App\Models\Course;
class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('courses')->truncate();
        Schema::enableForeignKeyConstraints();
        Course::create([
            'title' => 'Git',
            'course_avatar' => 'images/course_avatar/git1.png',
            'course_avatar_2' => 'images/course_avatar/git2.png',
            'course_avatar_3' => 'images/course_avatar/git3.png',
            'description' => 'Một khóa học bổ ích về Git cho người mới bắt đầu',
            'lecture_numbers' => '4',
            'duration' => '0',
            'views' => '100',
            'level' => '2',
            'course_rate' => '4.5',
            'is_accepted' => '1',
            'category_id' => '4',
            'user_id' => '2',
        ]);
        Course::create([
            'title' => 'Mysql',
            'course_avatar' => 'images/course_avatar/mysql1.jpg',
            'course_avatar_2' => 'images/course_avatar/mysql2.png',
            'course_avatar_3' => 'images/course_avatar/mysql3.png',
            'description' => 'Một khóa học bổ ích về Mysql cho người mới bắt đầu',
            'lecture_numbers' => '3',
            'duration' => '0',
            'views' => '200',
            'level' => '1',
            'course_rate' => '2.5',
            'is_accepted' => '1',
            'category_id' => '4',
            'user_id' => '5',
        ]);
        Course::create([
            'title' => 'Laravel',
            'course_avatar' => 'images/course_avatar/laravel1.jpg',
            'course_avatar_2' => 'images/course_avatar/laravel2.png',
            'course_avatar_3' => 'images/course_avatar/laravel3.jpeg',
            'description' => 'Bạn muốn bắt đầu học một framework mới cho server-side? Hãy bắt đầu từ khóa Laravel này',
            'lecture_numbers' => '6',
            'duration' => '0',
            'views' => '300',
            'level' => '2',
            'course_rate' => '5.0',
            'is_accepted' => '1',
            'category_id' => '11',
            'user_id' => '2',
        ]);
        Course::create([
            'title' => 'ES6',
            'course_avatar' => 'images/course_avatar/es6.jpeg',
            'course_avatar_2' => 'images/course_avatar/es6_2.png',
            'course_avatar_3' => 'images/course_avatar/es6_3.jpeg',
            'description' => 'Một khoá học rất hay về ES6',
            'lecture_numbers' => '6',
            'duration' => '0',
            'views' => '400',
            'level' => '2',
            'course_rate' => '5.0',
            'is_accepted' => '1',
            'category_id' => '2',
            'user_id' => '5',
        ]);
        Course::create([
            'title' => 'HTML',
            'course_avatar' => 'images/course_avatar/html.png',
            'course_avatar_2' => 'images/course_avatar/html2.png',
            'course_avatar_3' => 'images/course_avatar/html3.jpeg',
            'description' => 'Hãy bắt đầu từ cơ bản với khoá HTML này',
            'lecture_numbers' => '5',
            'duration' => '0',
            'views' => '500',
            'level' => '2',
            'course_rate' => '5.0',
            'is_accepted' => '1',
            'category_id' => '11',
            'user_id' => '6',
        ]);
        Course::create([
            'title' => 'nodejs',
            'course_avatar' => 'images/course_avatar/nodejs.png',
            'course_avatar_2' => 'images/course_avatar/nodejs2.jpeg',
            'course_avatar_3' => 'images/course_avatar/nodejs3.jpeg',
            'description' => 'Bạn muốn bắt đầu học một framework mới cho server-side? Hãy bắt đầu từ khóa Nodejs này',
            'lecture_numbers' => '6',
            'duration' => '0',
            'views' => '600',
            'level' => '2',
            'course_rate' => '3.0',
            'is_accepted' => '1',
            'category_id' => '10',
            'user_id' => '6',
        ]);
    }
}
