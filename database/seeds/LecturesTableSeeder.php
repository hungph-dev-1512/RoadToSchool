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
        // Machine Learning Lecture
        Lecture::create([
            'title' => 'Welcome to Machine Learning!',
            'description' => 'What is machine learning? You probably use it dozens of times a day without even knowing it. Each time you do a web search on Google or Bing, that works so well because their machine learning software has figured out how to rank what pages. When Facebook or Apple\'s photo application recognizes your friends in your pictures, that\'s also machine learning. Each time you read your email and a spam filter saves you from having to wade through tons of spam, again, that\'s because your computer has learned to distinguish spam from non-spam email. So, that\'s machine learning. There\'s a science of getting computers to learn without being explicitly programmed. One of the research projects that I\'m working on is getting robots to tidy up the house. How do you go about doing that? Well what you can do is have the robot watch you demonstrate the task and learn from that. The robot can then watch what objects you pick up and where to put them and try to do the same thing even when you aren\'t there. For me, one of the reasons I\'m excited about this is the AI, or artificial intelligence problem. Building truly intelligent machines, we can do just about anything that you or I can do. Many scientists think the best way to make progress on this is through learning algorithms called neural networks, which mimic how the human brain works, and I\'ll teach you about that, too. In this class, you learn about machine learning and get to implement them yourself. I hope you sign up on our website and join us.',
            'video_link' => 'https://www.youtube.com/watch?v=PNp1prcWbkM',
            'duration' => '0:1:18',
            'course_id' => '1',
            'week' => 1,
            'index' => 0,
            'is_lecture' => 1,
            'is_quiz' => 0,
            'is_accepted' => 1,
        ]);

        Lecture::create([
            'title' => 'Introduction',
            'description' => 'Welcome to this free online class on machine learning. Machine learning is one of the most exciting recent technologies. And in this class, you learn about the state of the art and also gain practice implementing and deploying these algorithms yourself. You\'ve probably use a learning algorithm dozens of times a day without knowing it. Every time you use a web search engine like Google or Bing to search the internet, one of the reasons that works so well is because a learning algorithm, one implemented by Google or Microsoft, has learned how to rank web pages. Every time you use Facebook or Apple\'s photo typing application and it recognizes your friends\' photos, that\'s also machine learning. Every time you read your email and your spam filter saves you from having to wade through tons of spam email, that\'s also a learning algorithm. For me one of the reasons I\'m excited is the AI dream of someday building machines as intelligent as you or me. We\'re a long way away from that goal, but many AI researchers believe that the best way to towards that goal is through learning algorithms that try to mimic how the human brain learns. I\'ll tell you a little bit about that too in this class. In this class you learn about state-of-the-art machine learning algorithms. But it turns out just knowing the algorithms and knowing the math isn\'t that much good if you don\'t also know how to actually get this stuff to work on problems that you care about. So, we\'ve also spent a lot of time developing exercises for you to implement each of these algorithms and see how they work fot yourself. So why is machine learning so prevalent today? It turns out that machine learning is a field that had grown out of the field of AI, or artificial intelligence. We wanted to build intelligent machines and it turns out that there are a few basic things that we could program a machine to do such as how to find the shortest path from A to B. But for the most part we just did not know how to write AI programs to do the more interesting things such as web search or photo tagging or email anti-spam. There was a realization that the only way to do these things was to have a machine learn to do it by itself. So, machine learning was developed as a new capability for computers and today it touches many segments of industry and basic science. For me, I work on machine learning and in a typical week I might end up talking to helicopter pilots, biologists, a bunch of computer systems people (so my colleagues here at Stanford) and averaging two or three times a week I get email from people in industry from Silicon Valley contacting me who have an interest in applying learning algorithms to their own problems. This is a sign of the range of problems that machine learning touches. There is autonomous robotics, computational biology, tons of things in Silicon Valley that machine learning is having an impact on. Here are some other examples of machine learning. There\'s database mining. One of the reasons machine learning has so pervaded is the growth of the web and the growth of automation All this means that we have much larger data sets than ever before. So, for example tons of Silicon Valley companies are today collecting web click data, also called clickstream data, and are trying to use machine learning algorithms to mine this data to understand the users better and to serve the users better, that\'s a huge segment of Silicon Valley right now. Medical records. With the advent of automation, we now have electronic medical records, so if we can turn medical records into medical knowledge, then we can start to understand disease better. Computational biology. With automation again, biologists are collecting lots of data about gene sequences, DNA sequences, and so on, and machines running algorithms are giving us a much better understanding of the human genome, and what it means to be human. And in engineering as well, in all fields of engineering, we have larger and larger, and larger and larger data sets, that we\'re trying to understand using learning algorithms. A second range of machinery applications is ones that we cannot program by hand. So for example, I\'ve worked on autonomous helicopters for many years. We just did not know how to write a computer program to make this helicopter fly by itself. The only thing that worked was having a computer learn by itself how to fly this helicopter.',
            'video_link' => 'https://www.youtube.com/watch?v=r2WmaA8orfM',
            'duration' => '0:6:54',
            'course_id' => '1',
            'week' => 1,
            'index' => 1,
            'is_lecture' => 1,
            'is_quiz' => 0,
            'is_accepted' => 1,
        ]);

        Lecture::create([
            'title' => 'What is Machine Learning?',
            'description' => 'What is machine learning? In this video, we will try to define what it is and also try to give you a sense of when you want to use machine learning. Even among machine learning practitioners, there isn\'t a well accepted definition of what is and what isn\'t machine learning. But let me show you a couple of examples of the ways that people have tried to define it. Here\'s a definition of what is machine learning as due to Arthur Samuel. He defined machine learning as the field of study that gives computers the ability to learn without being explicitly learned.',
            'video_link' => 'https://www.youtube.com/watch?v=LF2s-n2EAmE',
            'duration' => '0:7:14',
            'course_id' => '1',
            'week' => 1,
            'index' => 2,
            'is_lecture' => 1,
            'is_quiz' => 0,
            'is_accepted' => 1,
        ]);


        Lecture::create([
            'title' => 'Supervised Learning',
            'description' => '<b>In supervised learning, we are given a data set and already know what our correct output should look like, having the idea that there is a relationship between the input and the output.<br>Supervised learning problems are categorized into "regression" and "classification" problems. In a regression problem, we are trying to predict results within a continuous output, meaning that we are trying to map input variables to some continuous function. In a classification problem, we are instead trying to predict results in a discrete output. In other words, we are trying to map input variables into discrete categories.</b>',
            'video_link' => 'https://www.youtube.com/watch?v=LslruK1p-70',
            'duration' => '0:12:29',
            'course_id' => '1',
            'week' => 2,
            'index' => 0,
            'is_lecture' => 1,
            'is_quiz' => 0,
            'is_accepted' => 1,
        ]);

        Lecture::create([
            'title' => 'Unsupervised Learning',
            'description' => '<p>Unsupervised learning allows us to approach problems with little or no idea what our results should look like. We can derive structure from data where we don\'t necessarily know the effect of the variables.<br>We can derive this structure by clustering the data based on relationships among the variables in the data.<br>With unsupervised learning there is no feedback based on the prediction results.</p>',
            'video_link' => 'https://www.youtube.com/watch?v=CCoQ49NASQ8',
            'duration' => '0:14:13',
            'course_id' => '1',
            'week' => 2,
            'index' => 1,
            'is_lecture' => 1,
            'is_quiz' => 0,
            'is_accepted' => 1,
        ]);

        Lecture::create([
            'title' => 'Instruction Quiz',
            'description' => 'Quiz, 5 questions',
            'duration' => '0:30:00',
            'course_id' => '1',
            'week' => 2,
            'index' => 2,
            'is_lecture' => 0,
            'is_quiz' => 1,
            'is_accepted' => 1,
        ]);

//        Lecture::create([
//            'title' => 'Giới thiệu về Git',
//            'description' => 'Kiến thức yêu cầu
//            Đây là một serie về Git nên mình cần các bạn có sẵn các kiến thức như sau:
//            Biết rõ bạn đang tìm hiểu về cái gì.
//            Đã từng sử dụng Linux trên máy tính cá nhân hoặc Server.
//            Đã biết lập trình.
//            Nếu bạn chưa có kinh nghiệm sử dụng Linux, mình khuyến khích bạn đi thẳng vào serie Học VPS/Máy chủ cơ bản để làm quen với các lệnh và khái niệm cần thiết.',
//            'video_link' => 'https://www.youtube.com/watch?v=E1U3ckBaUN8',
//            'duration' => '0:8:36',
//            'course_id' => '1',
//            'week' => 1,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'Khởi tạo Repository',
//            'description' => 'Repository (kho chứa) nghĩa là nơi mà bạn sẽ lưu trữ mã nguồn và một người khác có thể sao chép (clone) lại mã nguồn đó nhằm làm việc. Repository có hai loại là Local Repository (Kho chứa trên máy cá nhân) và Remote Repository (Kho chứa trên một máy chủ từ xa).
//            Trong bài này, mình sẽ hướng dẫn bạn cách tạo local repository và remote repository (sử dụng Github) và làm việc với nó.',
//            'video_link' => 'https://www.youtube.com/watch?v=uBVenaol5xw',
//            'duration' => '0:10:54',
//            'course_id' => '1',
//            'week' => 1,
//            'index' => 1,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'Git Branch',
//            'description' => 'Ở phần nhập môn, bạn đã được giải thích về cách sử dụng cơ bản của Git. Còn ở phần phát triển này thì sẽ chủ yếu giải thích nội dung liên quan đến cách sử dụng và vận dụng của branch.
//            Trong việc phát triển phần mềm, thì ứng với một phần mềm có nhiều thành viên đồng thời tiến hành thêm chức năng hay là tiến hành chỉnh sửa lỗi cùng một lúc. Và ở tình trạng tồn tại của nhiều phiên bản đã phát hành thì cũng phải lưu giữ từng phiên bản.
//            Chính vì vậy để hỗ trợ quản lý phiên bản hay thêm nhiều chức năng được tiến hành song song, một chức năng được trang bị thêm được gọi là branch ở Git.',
//            'video_link' => 'https://www.youtube.com/watch?v=c217pCBw3Ws',
//            'duration' => '0:11:08',
//            'course_id' => '1',
//            'week' => 2,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'Cài đặt MySQL',
//            'description' => 'Hướng dẫn cài đặt MySQL',
//            'video_link' => 'https://www.youtube.com/watch?v=ypmNtSyLBdw',
//            'duration' => '0:8:04',
//            'course_id' => '2',
//            'week' => 1,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'MySQL Data Types',
//            'description' => 'Tìm hiểu MySQL data types',
//            'video_link' => 'https://www.youtube.com/watch?v=ZAs-MhBS-kI',
//            'duration' => '0:2:01',
//            'course_id' => '2',
//            'week' => 2,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'Khóa ngoại foreign key',
//            'description' => 'Khóa ngoại foreign key',
//            'video_link' => 'https://www.youtube.com/watch?v=53r33AQKlZ0',
//            'duration' => '0:17:49',
//            'course_id' => '2',
//            'week' => 2,
//            'index' => 1,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//
//        Lecture::create([
//            'title' => 'Giới thiệu Laravel Framework',
//            'description' => 'Khóa học lập trình Laravel',
//            'video_link' => 'https://www.youtube.com/watch?v=XJwhQumKCxU',
//            'duration' => '0:15:55',
//            'course_id' => '3',
//            'week' => 1,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
//        Lecture::create([
//            'title' => 'Cài đặt Laravel',
//            'description' => 'Khóa học lập trình Laravel',
//            'video_link' => 'https://www.youtube.com/watch?v=AbCsV68Kzrg',
//            'duration' => '0:5:55',
//            'course_id' => '3',
//            'week' => 2,
//            'index' => 0,
//            'is_lecture' => 1,
//            'is_quiz' => 0
//        ]);
    }
}
