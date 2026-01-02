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
            try {
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                $settings = [];
            }
        }

        return $settings[$key] ?? $default;
    }
}
