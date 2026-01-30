<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, $default = 'Đang cập nhật...')
    {
        $settings = cache()->rememberForever('settings', function () {
            return Setting::where('is_active', 1)
                        ->select('key', 'value')
                        ->get()
                        ->pluck('value', 'key')
                        ->toArray();
        });

        return $settings[$key] ?? $default;
    }
}
