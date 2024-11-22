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
            'settings' => $settings ? [
                'id' => $settings->id,
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'logo' => $settings->logo,
                'logo_url' => $settings->logo ? Storage::url($settings->logo) : null,
                'address' => $settings->address,
                'whatsapp' => $settings->whatsapp,
                'meta_ads' => $settings->meta_ads,
            ] : null,
            'flash' => [
                'success' => session('success'),
                'error' => session('error')
            ],
        ]);
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'nullable|string',
                'whatsapp' => 'nullable|string|max:20',
                'meta_ads' => 'nullable|string'
            ]);

            $settings = WebsiteSetting::first() ?? new WebsiteSetting();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($settings->logo) {
                    Storage::delete($settings->logo);
                }
                
                // Store new logo
                $path = $request->file('logo')->store('settings', 'public');
                $settings->logo = $path;
            }

            $settings->title = $request->title;
            $settings->subtitle = $request->subtitle;
            $settings->address = $request->address;
            $settings->whatsapp = $request->whatsapp;
            $settings->meta_ads = $request->meta_ads;
            $settings->save();

            return redirect()->back()->with('success', 'Settings updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings. ' . $e->getMessage());
        }
    }
}
