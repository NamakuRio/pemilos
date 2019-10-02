<?php

namespace App\Http\ViewComposers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view)
    {
        $setting = Setting::get();
        $view->with([
            'app_name' => $setting->where('name', 'app_name')->first()->value,
            'app_description' => $setting->where('name', 'app_description')->first()->value,
            'app_author' => $setting->where('name', 'app_author')->first()->value,
            'app_version' => $setting->where('name', 'app_version')->first()->value,
            'app_logo' => $setting->where('name', 'app_logo')->first()->value,
            'meta_author' => $setting->where('name', 'meta_author')->first()->value,
            'meta_description' => $setting->where('name', 'meta_description')->first()->value
        ]);
    }
}
