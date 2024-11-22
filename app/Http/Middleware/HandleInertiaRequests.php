<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Storage;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $settings = WebsiteSetting::first();
        $settingsData = null;

        if ($settings) {
            $settingsData = [
                'id' => $settings->id,
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'logo' => $settings->logo,
                'logo_url' => $settings->logo ? Storage::url($settings->logo) : null,
                'address' => $settings->address,
                'whatsapp' => $settings->whatsapp,
                'meta_ads' => $settings->meta_ads,
            ];
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'roles' => $request->user()->roles->pluck('name'),
                ] : null,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],
            'settings' => $settingsData,
        ]);
    }
}
