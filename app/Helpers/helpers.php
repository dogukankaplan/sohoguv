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
                // Safely try to fetch settings, return empty array if table missing
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                $settings = [];
                // Log::error('Settings table missing or DB error: ' . $e->getMessage());
            }
        }

        return $settings[$key] ?? $default;
    }
}
