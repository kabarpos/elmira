<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        
        return Inertia::render('Admin/Settings/Index', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'hero_cta_text' => 'required|string|max:255',
            'hero_cta_link' => 'required|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hero_overlay_color' => 'required|string|max:255',
            'hero_overlay_opacity' => 'required|integer|min:0|max:100',
        ]);

        $settings = SiteSetting::first();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $logo = $request->file('logo')->store('images', 'public');
            $settings->logo_path = $logo;
        }

        // Handle hero background upload
        if ($request->hasFile('hero_background')) {
            if ($settings->hero_background_image) {
                Storage::disk('public')->delete($settings->hero_background_image);
            }
            $heroBackground = $request->file('hero_background')->store('images', 'public');
            $settings->hero_background_image = $heroBackground;
        }

        $settings->update([
            'site_name' => $request->site_name,
            'hero_title' => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'hero_cta_text' => $request->hero_cta_text,
            'hero_cta_link' => $request->hero_cta_link,
            'hero_overlay_color' => $request->hero_overlay_color,
            'hero_overlay_opacity' => $request->hero_overlay_opacity,
        ]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
