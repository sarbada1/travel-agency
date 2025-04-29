<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Repositories\Setting\SettingInterface;
use Illuminate\Http\Request;

class SettingController extends BackendController
{
    protected SettingInterface $si;

    public function __construct(SettingInterface $si)
    {
        parent::__construct();
        $this->si = $si;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'settings_list');
        $this->data('settingData', $this->si->getSetting());
        return view($this->pagePath . 'setting.index', $this->data);
    }

    public function update(Request $request)
    {
        $this->checkAuthorization($request->user(), 'settings_edit');
        $data = $request->all();
        $this->si->updateSetting($data);
        return redirect()->back()->with('success', 'Setting was updated');
    }
}
