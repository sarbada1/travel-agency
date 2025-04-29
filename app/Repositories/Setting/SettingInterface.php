<?php

namespace App\Repositories\Setting;

interface SettingInterface
{

    public function getSetting();

    public function updateSetting($data);
}
