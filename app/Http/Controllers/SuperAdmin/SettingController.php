<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('SuperAdmin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name'  => 'required',
            'company_email' => 'required|email',
        ]);

        // Get first row OR create new object
        $setting = Setting::firstOrNew([]);

        // Upload Logo
        if ($request->hasFile('company_logo')) {

            $logo = $request->file('company_logo');

            $logoName = time().'.'.$logo->getClientOriginalExtension();

            $logo->move(public_path('uploads/logo'), $logoName);

            $setting->company_logo = $logoName;
        }

        // Assign values
        $setting->company_name      = $request->company_name;
        $setting->company_email     = $request->company_email;
        $setting->company_phone     = $request->company_phone;
        $setting->website           = $request->website;
        $setting->company_address   = $request->company_address;

        $setting->office_start_time = $request->office_start_time;
        $setting->office_end_time   = $request->office_end_time;
        $setting->late_mark_time    = $request->late_mark_time;

        $setting->timezone          = $request->timezone;
        $setting->currency          = $request->currency;
        $setting->date_format       = $request->date_format;

        // IMPORTANT SAVE
        $setting->save();

        return back()->with('success', 'Settings Updated Successfully');
    }
}
