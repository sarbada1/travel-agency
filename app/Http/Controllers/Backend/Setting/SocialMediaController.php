<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Models\Setting\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends BackendController
{
    public function index(Request $request)
    {
        $this->data('socialMedia', SocialMedia::all());
        return view($this->pagePath . 'setting.social-media', $this->data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'url' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        SocialMedia::create($data);
        return redirect()->back()->with('success', 'Social Media added successfully');

    }

    public function edit($id)
    {
        $this->data('socialMedia', SocialMedia::findOrFail($id));
        return view($this->pagePath . 'setting.social-media-update', $this->data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'url' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        SocialMedia::findOrFail($id)->update($data);
        return redirect()->back()->with('success', 'Social Media updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        SocialMedia::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Social Media deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        if (isset($_POST['active'])) {
            SocialMedia::findOrFail($id)->update(['status' => 0]);
        } else {
            SocialMedia::findOrFail($id)->update(['status' => 1]);
        }
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
