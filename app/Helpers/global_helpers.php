<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('setActive')) {
    function setActive(array $routes, $activeClass = 'active'): string
    {
        return request()->routeIs($routes) ? $activeClass : '';
    }
}

if (!function_exists('user')) {
    /**
     * @return \App\Models\User|null
     */
    function user()
    {
        return Auth::user();
    }
}
