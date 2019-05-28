<?php

use App\Models\CourseUser;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use Faker\Generator as Faker;
use League\Csv\Writer;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       Schema::disableForeignKeyConstraints();
       DB::table('courses')->truncate();
       Schema::enableForeignKeyConstraints();
       // Machine Learning Course
       Course::create([
           'title' => 'Machine Learning',
           'course_avatar' => 'public/images/default_course_avatar/machine_learning_1.jpg',
           'course_avatar_2' => 'public/images/default_course_avatar/machine_learning_2.jpg',
           'course_avatar_3' => 'public/images/default_course_avatar/machine_learning_3.jpeg',
           'description' => '<p>Machine learning is the science of getting computers to act without being explicitly programmed. In the past decade, machine learning has given us self-driving cars, practical speech recognition, effective web search, and a vastly improved understanding of the human genome. Machine learning is so pervasive today that you probably use it dozens of times a day without knowing it. Many researchers also think it is the best way to make progress towards human-level AI. In this class, you will learn about the most effective machine learning techniques, and gain practice implementing them and getting them to work for yourself. More importantly, you\'ll learn about not only the theoretical underpinnings of learning, but also gain the practical know-how needed to quickly and powerfully apply these techniques to new problems. Finally, you\'ll learn about some of Silicon Valley\'s best practices in innovation as it pertains to machine learning and AI.<br><br>This course provides a broad introduction to machine learning, datamining, and statistical pattern recognition. Topics include: (i) Supervised learning (parametric/non-parametric algorithms, support vector machines, kernels, neural networks). (ii) Unsupervised learning (clustering, dimensionality reduction, recommender systems, deep learning). (iii) Best practices in machine learning (bias/variance theory; innovation process in machine learning and AI). The course will also draw from numerous case studies and applications, so that you\'ll also learn how to apply learning algorithms to building smart robots (perception, control), text understanding (web search, anti-spam), computer vision, medical informatics, audio, database mining, and other areas.</p>',
           'lecture_numbers' => rand(1, 10),
           // duration minutes
           'duration' => rand(200, 1000),
           'origin_price' => '399.99',
           'promotion_price' => '199.99',
           'seller' => rand(100, 1000),
           'level' => 2,
           'course_rate' => rand(1, 5),
           'is_accepted' => '1',
           'category_id' => 27,
           'user_id' => 12,
       ]);

       // Courses in category id 9: Web Development
       Course::create([
           'title' => 'Web Development In 2019 - A Practical Guide',
           'course_avatar' => 'public/images/default_course_avatar/web_development_1.jpeg',
           'course_avatar_2' => 'public/images/default_course_avatar/web_development_2.png',
           'course_avatar_3' => 'public/images/default_course_avatar/web_development_3.jpg',
           'description' => '<div id="watch-description-text" class=""><p id="eow-description" class="" >This is my yearly step by step guide to becoming a web developer in 2019. We will look at nearly all aspects of web technology including the necessities as well as some of the new trends for 2019.<br /><br />💖 Become a Patron: Show support & get perks!<br /><a href="/redirect?q=http%3A%2F%2Fwww.patreon.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.patreon.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">http://www.patreon.com/traversymedia</a><br /><br />Website & Udemy Courses<br /><a href="/redirect?q=http%3A%2F%2Fwww.traversymedia.com&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.traversymedia.com&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">http://www.traversymedia.com</a><br /><br />Follow Traversy Media:<br /><a href="/redirect?q=https%3A%2F%2Fwww.facebook.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fwww.facebook.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">https://www.facebook.com/traversymedia</a><br /><a href="/redirect?q=https%3A%2F%2Fwww.twitter.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fwww.twitter.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">https://www.twitter.com/traversymedia</a><br /><a href="/redirect?q=https%3A%2F%2Fwww.instagram.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fwww.instagram.com%2Ftraversymedia&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">https://www.instagram.com/traversymedia</a><br /><br />Shared & VPS Hosting:<br /><a href="/redirect?q=https%3A%2F%2Finmotion-hosting.evyy.net%2Fc%2F396530%2F260033%2F4222&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Finmotion-hosting.evyy.net%2Fc%2F396530%2F260033%2F4222&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">https://inmotion-hosting.evyy.net/c/3...</a><br /><br />Cheap Domain Names:<br /><a href="/redirect?q=https%3A%2F%2Fnamecheap.pxf.io%2Fc%2F1299552%2F386170%2F5618&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" class="yt-uix-sessionlink  " data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fnamecheap.pxf.io%2Fc%2F1299552%2F386170%2F5618&event=video_description&v=UnTQVlqmDQ0&redir_token=QIHfX0v12FTG3mscsrNbqcON1PZ8MTU0NjM0NDc2OUAxNTQ2MjU4MzY5" data-sessionlink="itct=CDgQ6TgYACITCMzp4aaFyt8CFZiCxAodvC4NGCj4HUiNmpjV5Yq0ulI" target="_blank" rel="nofollow noopener">https://namecheap.pxf.io/c/1299552/38...</a></p></div>',
           'lecture_numbers' => rand(1, 10),
           // duration minutes
           'duration' => rand(200, 1000),
           'origin_price' => '99.99',
           'promotion_price' => '69.99',
           'seller' => rand(100, 1000),
           'level' => rand(1, 3),
           'course_rate' => rand(1, 5),
           'is_accepted' => '1',
           'category_id' => '9',
           'user_id' => rand(11, 99),
       ]);

       // Courses in category id 10: Mobile Apps
       Course::create([
           'title' => 'Mobile Apps - Web vs. Native vs. Hybrid',
           'course_avatar' => 'public/images/default_course_avatar/mobile_apps_1.jpg',
           'course_avatar_2' => 'public/images/default_course_avatar/mobile_apps_2.jpg',
           'course_avatar_3' => 'public/images/default_course_avatar/mobile_apps_3.jpg',
           'description' => '<div id="watch-description-text" class=""><p id="eow-description" class="" >In this presentation we will examine the pros and cons of the different types of mobile apps that you can build. We will look at web, native and hybrid mobile apps and compare things like performance, price, difficulty to maintain, etc<br /><br />SPONSORS:<br />ZEQR - <a href="/redirect?q=https%3A%2F%2Fwww.zeqr.com&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fwww.zeqr.com&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">https://www.zeqr.com</a><br /><br />MEGA MOBILE COURSE:<br /><a href="/redirect?q=https%3A%2F%2Fwww.eduonix.com%2Faffiliates%2Fid%2F16-10474&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=https%3A%2F%2Fwww.eduonix.com%2Faffiliates%2Fid%2F16-10474&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">https://www.eduonix.com/affiliates/id...</a><br /><br />BECOME A PATRON: Show support & get perks!<br /><a href="/redirect?q=http%3A%2F%2Fwww.patreon.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.patreon.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">http://www.patreon.com/traversymedia</a><br /><br />ONE TIME DONATIONS:<br /><a href="/redirect?q=http%3A%2F%2Fwww.paypal.me%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.paypal.me%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">http://www.paypal.me/traversymedia</a><br /><br />FOLLOW TRAVERSY MEDIA:<br /><a href="/redirect?q=http%3A%2F%2Fwww.facebook.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.facebook.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">http://www.facebook.com/traversymedia</a><br /><a href="/redirect?q=http%3A%2F%2Fwww.twitter.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.twitter.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">http://www.twitter.com/traversymedia</a><br /><a href="/redirect?q=http%3A%2F%2Fwww.instagram.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" class="yt-uix-sessionlink  " data-sessionlink="itct=CDcQ6TgYACITCNn80qC2yt8CFVitxAodI3QPbCj4HUj246bR3bbFlGY" data-target-new-window="True" data-url="/redirect?q=http%3A%2F%2Fwww.instagram.com%2Ftraversymedia&redir_token=_1euJfZmXvCyGCDOi-u2hShd_lx8MTU0NjM1NzkxMEAxNTQ2MjcxNTEw&v=ZikVtdopsfY&event=video_description" rel="nofollow noopener" target="_blank">http://www.instagram.com/traversymedia</a></p></div>',
           'lecture_numbers' => rand(1, 10),
           // duration minutes
           'duration' => rand(200, 1000),
           'origin_price' => '139.99',
           'promotion_price' => '89.99',
           'seller' => rand(100, 1000),
           'level' => rand(1, 3),
           'course_rate' => rand(1, 5),
           'is_accepted' => '1',
           'category_id' => '10',
           'user_id' => rand(11, 99),
       ]);

       // Courses in category id 11: Programming Languages
       Course::create([
           'title' => 'Top 4 Programming Languages to Learn in 2019 to Get a Job Without a College Degree',
           'course_avatar' => 'public/images/default_course_avatar/programming_languages_1.png',
           'course_avatar_2' => 'public/images/default_course_avatar/programming_languages_2.jpeg',
           'course_avatar_3' => 'public/images/default_course_avatar/programming_languages_3.jpg',
           'description' => '<p id="eow-description" class="" >Join my epic 3-part FREE training masterclass here... <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=https%3A%2F%2Fcleverprogrammer.com" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=https%3A%2F%2Fcleverprogrammer.com" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">https://cleverprogrammer.com</a><br /><br />In this video, we cover the top 4 programming languages you need to learn in 2019 to get a job without a college degree. These languages are great for part-time, full-time, or even building your very own startup.<br /><br />Enroll in Learn Python™ course<br /><a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/enroll</a><br /><br />==================================================<br />Connect With Me!<br /><br />Website     ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/enroll</a><br />Facebook  ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Ffacebook" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Ffacebook" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/facebook</a><br />Twitter     ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Ftwitter" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Ftwitter" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/twitter</a><br />Instagram ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Finstagram" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Finstagram" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/instagram</a><br />Snapchat  ► Rafeh1<br />iTunes Podcast ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fpodcast" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fpodcast" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/podcast</a><br />Google Podcast    ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fgoogle-podcast" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fgoogle-podcast" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/google-pod...</a><br />Support (Patreon) ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fpatreon" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fpatreon" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/patreon</a><br />Youtube    ► <a href="https://www.youtube.com/c/CleverProgrammer" class="yt-uix-sessionlink  " data-url="https://www.youtube.com/c/CleverProgrammer" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" >https://www.youtube.com/c/CleverProgr...</a><br />Github (Code) ► <a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fgithub" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fgithub" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/github</a><br /><br />Enroll in Learn Python™ course<br /><a href="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" class="yt-uix-sessionlink  " data-url="/redirect?event=video_description&v=YWWfQ_aRu6g&redir_token=v4C2h4esnOKfScc3ZlEHRbiaocZ8MTU0NjQzNjk1NUAxNTQ2MzUwNTU1&q=http%3A%2F%2Fcleverprogrammer.to%2Fenroll" data-sessionlink="itct=CDYQ6TgYACITCIGrstzczN8CFZWsxAodBZgHeyj4HUio98a0v-jnsmE" data-target-new-window="True" target="_blank" rel="nofollow noopener">http://cleverprogrammer.to/enroll</a></p></div>',
           'lecture_numbers' => rand(1, 10),
           // duration minutes
           'duration' => rand(200, 1000),
           'origin_price' => '179.99',
           'promotion_price' => '69.99',
           'seller' => rand(100, 1000),
           'level' => rand(1, 3),
           'course_rate' => rand(1, 5),
           'is_accepted' => '1',
           'category_id' => '11',
           'user_id' => rand(11, 99),
       ]);

       // Faker seed data
       foreach (Category::where('parent_id', '<>', 0)->pluck('title', 'id') as $key => $value) {
           $randomCount = rand(10, 30);
           for ($temp = 0; $temp < $randomCount; $temp++) {
               $randomOriginPrice = $faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 500);
               $randomInt = rand(0, 1);
               if ($randomInt === 0) {
                   $randomPromotionPrice = $faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = $randomOriginPrice);
               } else if ($randomInt === 1) {
                   $randomPromotionPrice = $randomOriginPrice;
               }

               Course::create([
                   'title' => $value . ' - Rand Course: ' . $faker->text($maxNbChars = 50),
                   'course_avatar' => $faker->image($dir = 'public/images/course_avatar', $width = 690, $height = 450),
                   'course_avatar_2' => $faker->image($dir = 'public/images/course_avatar', $width = 690, $height = 450),
                   'course_avatar_3' => $faker->image($dir = 'public/images/course_avatar', $width = 690, $height = 450),
                   'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                   'lecture_numbers' => rand(5, 50),
                   // duration minutes
                   'duration' => rand(500, 1000),
                   'origin_price' => $randomOriginPrice,
                   'promotion_price' => $randomPromotionPrice,
                   'seller' => rand(100, 1000),
                   'level' => rand(1, 3),
                   'course_rate' => rand(1, 5),
                   'is_accepted' => rand(0, 1),
                   'category_id' => $key,
                   'user_id' => rand(11, 99),
               ]);
           }
       }

       //Other courses
       Course::create([
           'title' => 'Git',
           'course_avatar' => 'images/course_avatar/git1.png',
           'course_avatar_2' => 'images/course_avatar/git2.png',
           'course_avatar_3' => 'images/course_avatar/git3.png',
           'description' => 'Một khóa học bổ ích về Git cho người mới bắt đầu',
           'lecture_numbers' => '4',
           'duration' => '500',
           'origin_price' => '99.99',
           'promotion_price' => '39.99',
           'seller' => '100',
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
           'duration' => '6000',
           'origin_price' => '300.00',
           'promotion_price' => '18.99',
           'seller' => '200',
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
           'duration' => '300',
           'origin_price' => '189.99',
           'seller' => '300',
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
           'origin_price' => '300.00',
           'promotion_price' => '18.99',
           'seller' => '400',
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
           'origin_price' => '300.00',
           'promotion_price' => '18.99',
           'seller' => '500',
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
           'origin_price' => '300.00',
           'promotion_price' => '18.99',
           'seller' => '600',
           'level' => '2',
           'course_rate' => '3.0',
           'is_accepted' => '1',
           'category_id' => '10',
           'user_id' => '6',
       ]);

        Schema::disableForeignKeyConstraints();
        DB::table('course_user')->truncate();
        Schema::enableForeignKeyConstraints();
        $userIdList = \App\Models\User::where('role', 2)->pluck('id')->toArray();
        $courseIdList = \App\Models\Course::where('is_accepted', 1)->pluck('id')->toArray();
        $appreciateList = [
            0 => 'Bad course',
            1 => 'This course is boring',
            2 => 'This course is confusing',
            3 => 'Normal course',
            4 => 'This course is quite understandable',
            5 => 'Very good course, easy to understand',
        ];

        // Create random student
        for ($temp = 0; $temp < 10000; $temp++) {
            $flagRate = rand(0, 1);
            $flagAppreciate = rand(0, 1);
            if ($flagRate == 1) {
                $data['rate'] = rand(0, 5);
                if ($flagAppreciate == 1) {
                    $data['appreciate'] = $appreciateList[$data['rate']];
                }
            }
            $checkExist = 1;
            while ($checkExist) {
                $randUserKey = array_rand($userIdList);
                $randCourseKey = array_rand($courseIdList);
                $randUserId = $userIdList[$randUserKey];
                $randCourseId = $courseIdList[$randCourseKey];
                $checkExist = CourseUser::where('course_id', $randCourseId)->where('user_id', $randUserId)->first();
            }
            if (!$checkExist) {
                $data['course_id'] = $randCourseId;
                $data['user_id'] = $randUserId;
                CourseUser::create($data);
            }
        }
        $courseUser = CourseUser::all();
        $header = ['course_id', 'user_id', 'rate'];

        $csv = Writer::createFromPath("course_user.csv", "w");

        $csv->insertOne($header);

        foreach ($courseUser as $one) {
            $csv->insertOne([$one->course_id, $one->user_id, $one->rate]);
        }
    }
}
