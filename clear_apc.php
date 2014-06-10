<?php

if (function_exists('apc_clear_cache')) {
    if (apc_clear_cache() && apc_clear_cache('user')) {
        echo 'APC cache cleared!';
    } else {
        echo 'APC cache clearing failed!';
    }

    echo '<pre>';
    print_r(apc_cache_info());
    echo '</pre>';
} else {
    echo 'APC not installed' . "\n";
}