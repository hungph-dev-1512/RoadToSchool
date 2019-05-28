<?php
/**
 * Created by PhpStorm.
 * User: hungphamhoang
 * Date: 19/02/2019
 * Time: 14:46
 */

/**
 * Return nav-here if current path begins with this path.
 *
 * @param string $path
 * @return string
 */
function setActive($path)
{
//    if($path === 'admin/users/instructor_ranking') {
//        return Request::is($path) ? ' class=active' :  '';
//    }

    return Request::is($path) ? ' class=active' : '';
}

function setOpen($path)
{
    if ($path === 'admin') {
        return Request::is($path) ? ' open' : '';
    }

    return Request::is($path . '*') ? ' open' : '';
}