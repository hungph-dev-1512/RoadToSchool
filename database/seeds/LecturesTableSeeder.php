<?php

use Illuminate\Database\Seeder;
use App\Models\Lecture;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('lectures')->truncate();
        Schema::enableForeignKeyConstraints();
        Lecture::create([
            'title' => 'Giới thiệu về Git',
            'description' => 'Kiến thức yêu cầu
            Đây là một serie về Git nên mình cần các bạn có sẵn các kiến thức như sau:
            Biết rõ bạn đang tìm hiểu về cái gì.
            Đã từng sử dụng Linux trên máy tính cá nhân hoặc Server.
            Đã biết lập trình.
            Nếu bạn chưa có kinh nghiệm sử dụng Linux, mình khuyến khích bạn đi thẳng vào serie Học VPS/Máy chủ cơ bản để làm quen với các lệnh và khái niệm cần thiết.',
            'video_link' => 'https://www.youtube.com/watch?v=E1U3ckBaUN8',
            'duration' => '0:8:36',
            'course_id' => '1'
        ]);
        Lecture::create([
            'title' => 'Khởi tạo Repository',
            'description' => 'Repository (kho chứa) nghĩa là nơi mà bạn sẽ lưu trữ mã nguồn và một người khác có thể sao chép (clone) lại mã nguồn đó nhằm làm việc. Repository có hai loại là Local Repository (Kho chứa trên máy cá nhân) và Remote Repository (Kho chứa trên một máy chủ từ xa).
            Trong bài này, mình sẽ hướng dẫn bạn cách tạo local repository và remote repository (sử dụng Github) và làm việc với nó.',
            'video_link' => 'https://www.youtube.com/watch?v=uBVenaol5xw',
            'duration' => '0:10:54',
            'course_id' => '1'
        ]);
        Lecture::create([
            'title' => 'Khái niệm và cách làm việc với Branch',
            'description' => 'Ở phần nhập môn, bạn đã được giải thích về cách sử dụng cơ bản của Git. Còn ở phần phát triển này thì sẽ chủ yếu giải thích nội dung liên quan đến cách sử dụng và vận dụng của branch.
            Trong việc phát triển phần mềm, thì ứng với một phần mềm có nhiều thành viên đồng thời tiến hành thêm chức năng hay là tiến hành chỉnh sửa lỗi cùng một lúc. Và ở tình trạng tồn tại của nhiều phiên bản đã phát hành thì cũng phải lưu giữ từng phiên bản.
            Chính vì vậy để hỗ trợ quản lý phiên bản hay thêm nhiều chức năng được tiến hành song song, một chức năng được trang bị thêm được gọi là branch ở Git.',
            'video_link' => 'https://www.youtube.com/watch?v=c217pCBw3Ws',
            'duration' => '0:11:08',
            'course_id' => '1'
        ]);
        Lecture::create([
            'title' => 'Cài đặt MySQL',
            'description' => 'Hướng dẫn cài đặt MySQL',
            'video_link' => 'https://www.youtube.com/watch?v=ypmNtSyLBdw',
            'duration' => '0:8:04',
            'course_id' => '2'
        ]);
        Lecture::create([
            'title' => 'MySQL Data Types',
            'description' => 'Tìm hiểu MySQL data types',
            'video_link' => 'https://www.youtube.com/watch?v=ZAs-MhBS-kI',
            'duration' => '0:2:01',
            'course_id' => '2'
        ]);
        Lecture::create([
            'title' => 'Khóa ngoại foreign key',
            'description' => 'Khóa ngoại foreign key',
            'video_link' => 'https://www.youtube.com/watch?v=53r33AQKlZ0',
            'duration' => '0:17:49',
            'course_id' => '2'
        ]);
        
        Lecture::create([
            'title' => 'Giới thiệu Laravel Framework',
            'description' => 'Khóa học lập trình Laravel',
            'video_link' => 'https://www.youtube.com/watch?v=XJwhQumKCxU',
            'duration' => '0:15:55',
            'course_id' => '3'
        ]);
        Lecture::create([
            'title' => 'Cài đặt Laravel',
            'description' => 'Khóa học lập trình Laravel',
            'video_link' => 'https://www.youtube.com/watch?v=AbCsV68Kzrg',
            'duration' => '0:5:55',
            'course_id' => '3'
        ]);
    }
}
