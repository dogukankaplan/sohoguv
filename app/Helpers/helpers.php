<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value from database
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        }

        return $settings[$key] ?? $default;
    }
}
