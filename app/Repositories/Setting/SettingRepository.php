<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Setting;

class SettingRepository implements SettingInterface
{
    private Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function getSetting()
    {
        return $this->setting->first();
    }

    public function updateSetting($data)
    {
        $setting = $this->setting->first();
        $setting->update($data);
        return true;
    }
}
