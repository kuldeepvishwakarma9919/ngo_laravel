<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first(); // only one row
        return view('admin.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::first();

        $data = $request->validate([
            'site_name' => 'required',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'email' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'payment_key' => 'nullable',
            'payment_secret' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'youtube' => 'nullable',
            'tiktok' => 'nullable',
            'x' => 'nullable',
            'telegram' => 'nullable',
            'whatsapp' => 'nullable',
            'map_location' => 'nullable',
        ]); 
        if ($request->hasFile('logo')) {
            if ($setting && $setting->logo && File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }

            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/settings'), $logoName);
            $data['logo'] = 'uploads/settings/'.$logoName;
        }

        // Create or Update
        Setting::updateOrCreate(['id' => $setting->id ?? null], $data);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
