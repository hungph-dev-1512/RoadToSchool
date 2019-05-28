<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $language = \Session::get('website_language', config('app.locale'));
//        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
//
//        config(['app.locale' => $language]);
//        // Chuyển ứng dụng sang ngôn ngữ được chọn
////        dd($language);
//
//        return $next($request);
        if (\Session::has('website_language')) :
            $locale = \Session::get('website_language');
        else :
            $locale = config('app.fallback_locale');
        endif;
        config(['app.locale' => $locale]);
        app()->setLocale($locale);

        return $next($request);
    }
}
