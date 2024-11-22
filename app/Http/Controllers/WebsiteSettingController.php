<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::first();
        return Inertia::render('Settings/Index', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',
            'meta_ads' => 'nullable|string'
        ]);

        $settings = WebsiteSetting::first() ?? new WebsiteSetting();

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::delete('public/' . $settings->logo);
            }
            $logo = $request->file('logo')->store('settings', 'public');
            $settings->logo = $logo;
        }

        $settings->title = $request->title;
        $settings->subtitle = $request->subtitle;
        $settings->address = $request->address;
        $settings->whatsapp = $request->whatsapp;
        $settings->meta_ads = $request->meta_ads;
        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
