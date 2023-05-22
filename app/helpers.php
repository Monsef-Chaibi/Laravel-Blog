<?php

use App\Models\Setting;

if (!function_exists('blogInfo')) {
    function blogInfo() {
        return Setting::find(1);
    }
}
