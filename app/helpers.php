<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/**
 * Returns current route name or compares route name to optional parameter.
 *
 * @param mixed $routeName
 */
function routeName(mixed $routeName = null)
{
    if (is_array($routeName)) {
        foreach ($routeName as $name) {
            if (stristr(Route::currentRouteName(), $name)) {
                return true;
            }
        }
        return false;
    }

    return $routeName ? stristr(Route::currentRouteName(), $routeName) : Route::currentRouteName();
}

/**
 * Returns current locale or compares locale to optional parameter.
 *
 * @param string $locale
 */
function locale($locale = null)
{
    return $locale ? App::isLocale($locale) : App::getLocale();
}

/**
 * Sets and stores the locale.
 *
 * @return void
 */
function setLang(): void
{
    $locale = request()->segment(1);

    if (in_array($locale, config('app.active_locales'))) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
}

/**
 * Cut $text on $x and add $end.
 *
 * @param int $x [char count for end]
 * @param string $end
 * @param string $text
 * @return string
 */
function cutText(int $x, string $end, string $text)
{
    $text = strip_tags($text);

    if (strlen($text) < 1) {
        return '';
    }

    if (strlen($text) <= $x) {
        return $text;
    }

    $arr = explode(' ', $text);
    $text = '';

    for ($i = 0; strlen($text . ' ' . $arr[$i]) <= $x; $i++) {
        $text .= ' ' . $arr[$i];
    }

    $text .= $end;

    return $text;
}
