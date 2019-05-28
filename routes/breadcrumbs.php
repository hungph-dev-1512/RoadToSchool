<?php
/**
 * Created by PhpStorm.
 * User: hungphamhoang
 * Date: 31/12/2018
 * Time: 11:15
 */

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Courses
Breadcrumbs::for('courses_index', function ($trail) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
});

// Home > Courses > Course Name
Breadcrumbs::for('courses_show', function ($trail, $course) {
    $trail->parent('courses_index');
    $trail->push($course->title, route('courses.show', $course));
});

// Home > My Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push("My cart", route('cart_items.index'));
});

// Home > My Course
Breadcrumbs::for('my_course', function ($trail, $userId) {
    $trail->parent('home');
    $trail->push("My course", route('courses.my_course', $userId));
});

// Home > My Profile
Breadcrumbs::for('users_show', function ($trail, $user) {
    $trail->parent('home');
    $trail->push('My Profile', route('users.show', $user->id));
});

// Home > My Cart > Check Out
Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('cart');
    $trail->push('Checkout', route('cart_items.checkout.get'));
});

// Home > Checkout Success
Breadcrumbs::for('checkout_success', function ($trail) {
    $trail->parent('home');
    $trail->push('Checkout Success', route('cart_items.checkout.post'));
});
