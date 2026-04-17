<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Settings ka page dikhane ke liye
    public function index()
    {
        // Database se saari settings nikal kar ek simple Array mein convert kar li
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    // Settings ko save/update karne ke liye
    public function update(Request $request)
    {
        // Token ke ilawa baqi sab data le lo
        $data = $request->except(['_token']);
        
        // Loop chala kar har field ko key aur value mein save ya update kar do
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key], 
                ['value' => $value]
            );
        }

        return back()->with('success', 'BHOOM! 💥 System Settings Successfully Updated!');
    }
}