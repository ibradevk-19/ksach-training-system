<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value','key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = [

            'project_name' => $request->project_name,
            'project_email' => $request->project_email,
            'project_phone' => $request->project_phone,
            'sms_provider' => $request->sms_provider,
            'sms_username' => $request->sms_username,
            'sms_password' => $request->sms_password,
            'allow_multiple_applications' => $request->allow_multiple_applications,

        ];

        // Logo Upload

        if($request->hasFile('project_logo')){

            $logo = $request->file('project_logo')
                ->store('settings','public');

            $data['project_logo'] = $logo;
        }

        foreach($data as $key => $value){

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success','تم حفظ الإعدادات');
    }
}