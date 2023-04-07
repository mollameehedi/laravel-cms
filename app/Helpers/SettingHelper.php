<?php

if (!function_exists('setting')) {
    function setting($name, $default = null)
    {
        return \App\Models\Setting::getByName($name, $default);
    }
}
