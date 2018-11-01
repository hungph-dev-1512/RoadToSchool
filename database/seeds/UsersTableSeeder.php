<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Ha Noi',
            'role' => '0',
            'avatar' => config('app.image') .'avatar/admin-avatar.jpg',
            'is_admin' => '1',
        ]);

        User::create([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Ha Noi',
            'role' => '0',
            'avatar' => config('app.image') .'avatar/admin-avatar.jpg',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Lam',
            'email' => 'lam@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+01665118758',
            'birthday' => '1996-11-19',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
            'role' => '0',
            'avatar' => config('app.image') .'avatar/lam.jpg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Hung',
            'email' => 'hung@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+0123456789',
            'birthday' => '1996-12-05',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
            'role' => '1',
            'avatar' => config('app.image') .'avatar/hung.jpeg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Minh',
            'email' => 'minh@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+016658873389',
            'birthday' => '1996-01-02',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
            'role' => '1',
            'avatar' => config('app.image') .'avatar/minh.jpeg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Thanh',
            'email' => 'thanh@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+01665118758',
            'birthday' => '1996-12-04',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
            'role' => '0',
            'avatar' => config('app.image') .'avatar/lam.jpg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Phong',
            'email' => 'phong@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+84123274821',
            'birthday' => '1989-12-19',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những giáo viên tốt nhất tại BKHN',
            'role' => '0',
            'avatar' => config('app.image') .'avatar/minh.jpg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Hai',
            'email' => 'hai@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '+016658873389',
            'birthday' => '2004-01-13',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
            'role' => '1',
            'avatar' => config('app.image') .'avatar/minh.jpeg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);

        User::create([
            'name' => 'Le',
            'email' => 'le@gmail.com',
            'password' => Hash::make('123456'),
            'birthday' => '2008-12-02',
            'address' => 'Ha Noi',
            'personal_info' => 'Một trong những sinh viên giỏi nhất tại BKHN',
            'role' => '1',
            'avatar' => config('app.image') .'avatar/hung.jpeg',
            'working_place' => 'BKHN',
            'is_admin' => '0',
        ]);
    }
}
