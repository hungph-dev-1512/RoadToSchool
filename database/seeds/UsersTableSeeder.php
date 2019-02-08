<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $files = glob('public/images/avatar/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        Schema::enableForeignKeyConstraints();

        User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+84965818552',
            'birthday' => '1996-12-15',
            'address' => 'Ha Noi',
            'avatar' => 'images/default_avatar/admin.jpg',
            'is_admin' => '1',
            'personal_info' => 'Proficient instructor with many years’ experience teaching children between grade levels fourth through 10th. Able to adapt teaching methods to best meet the needs of the specific class. Excellent track record of teaching classrooms that exceed standardized test scores. Professional who brings fun and enthusiasm to the table and can get any classroom in order.',
            'working_place' => 'Hanoi University of Science and Technology 1 Dai Co Viet Road, Ha Noi, Viet Nam Tel: 043 869 2222 - Fax: 043 869 200'
        ]);

        for ($temp = 2; $temp <= 10; $temp++) {
            User::create([
                'name' => 'admin' . $temp,
                'email' => 'admin' . $temp . '@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => $faker->e164PhoneNumber,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'address' => $faker->address,
                'avatar' => $faker->image($dir = 'public/images/avatar', $width = 640, $height = 480),
                'is_admin' => '1',
                'personal_info' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'working_place' => $faker->company,
            ]);
        }

        User::create([
            'name' => 'instructor',
            'email' => 'instructor@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+84965818552',
            'birthday' => '1996-12-15',
            'address' => 'Ha Noi',
            'avatar' => 'images/default_avatar/teacher.jpg',
            'role' => 1,
            'is_admin' => '0',
            'personal_info' => 'Proficient instructor with many years’ experience teaching children between grade levels fourth through 10th. Able to adapt teaching methods to best meet the needs of the specific class. Excellent track record of teaching classrooms that exceed standardized test scores. Professional who brings fun and enthusiasm to the table and can get any classroom in order.',
            'working_place' => 'Hanoi University of Science and Technology 1 Dai Co Viet Road, Ha Noi, Viet Nam Tel: 043 869 2222 - Fax: 043 869 200'
        ]);

        for ($temp = 12; $temp <= 99; $temp++) {
            User::create([
                'name' => $faker->name,
                'email' => 'instructor' . $temp . '@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => $faker->e164PhoneNumber,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'address' => $faker->address,
                'avatar' => $faker->image($dir = 'public/images/avatar', $width = 640, $height = 480),
                'role' => 1,
                'is_admin' => '0',
                'personal_info' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'working_place' => $faker->company,
            ]);
        }

        User::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+84965818552',
            'birthday' => '1996-12-15',
            'address' => 'Ha Noi',
            'avatar' => 'images/default_avatar/student.jpeg',
            'role' => 2,
            'is_admin' => '0',
            'personal_info' => 'Proficient instructor with many years’ experience teaching children between grade levels fourth through 10th. Able to adapt teaching methods to best meet the needs of the specific class. Excellent track record of teaching classrooms that exceed standardized test scores. Professional who brings fun and enthusiasm to the table and can get any classroom in order.',
            'working_place' => 'Hanoi University of Science and Technology 1 Dai Co Viet Road, Ha Noi, Viet Nam Tel: 043 869 2222 - Fax: 043 869 200'
        ]);

        for ($temp = 1001; $temp <= 9999; $temp++) {
            User::create([
                'name' => $faker->name,
                'email' => 'student' . $temp . '@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => $faker->e164PhoneNumber,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'address' => $faker->address,
                'avatar' => $faker->image($dir = 'public/images/avatar', $width = 640, $height = 480),
                'role' => 2,
                'is_admin' => '0',
                'personal_info' => $faker->realText($maxNbChars = 500, $indexSize = 2),
                'working_place' => $faker->company,
            ]);
        }
    }

//        User::create([
//            'name' => 'teacher',
//            'email' => 'teacher@gmail.com',
//            'password' => Hash::make('123456'),
//            'address' => 'Ha Noi',
//            'role' => '0',
//            'avatar' => 'images/avatar/admin-avatar.jpg',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Lam',
//            'email' => 'lam@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+01665118758',
//            'birthday' => '1996-11-19',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
//            'role' => '0',
//            'avatar' => 'images/avatar/lam.jpg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Hung',
//            'email' => 'hung@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+0123456789',
//            'birthday' => '1996-12-05',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
//            'role' => '1',
//            'avatar' => 'images/avatar/hung.jpeg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Minh',
//            'email' => 'minh@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+016658873389',
//            'birthday' => '1996-01-02',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
//            'role' => '1',
//            'avatar' => 'images/avatar/minh.jpeg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Thanh',
//            'email' => 'thanh@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+01665118758',
//            'birthday' => '1996-12-04',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
//            'role' => '0',
//            'avatar' => 'images/avatar/lam.jpg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Phong',
//            'email' => 'phong@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+84123274821',
//            'birthday' => '1989-12-19',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
//            'role' => '0',
//            'avatar' => 'images/avatar/minh.jpg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Hai',
//            'email' => 'hai@gmail.com',
//            'password' => Hash::make('123456'),
//            'phone' => '+016658873389',
//            'birthday' => '2004-01-13',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
//            'role' => '1',
//            'avatar' => 'images/avatar/minh.jpeg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//
//        User::create([
//            'name' => 'Le',
//            'email' => 'le@gmail.com',
//            'password' => Hash::make('123456'),
//            'birthday' => '2008-12-02',
//            'address' => 'Ha Noi',
//            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
//            'role' => '1',
//            'avatar' => 'images/avatar/hung.jpeg',
//            'working_place' => 'BKHN',
//            'is_admin' => '0',
//        ]);
//    }
}
