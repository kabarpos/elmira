<?php

namespace App\Http\Middleware;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Middleware;

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
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = WebsiteSetting::first();
        
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'roles' => $request->user() ? $request->user()->getRoleNames() : [],
                'permissions' => $request->user() ? $request->user()->getAllPermissions()->pluck('name') : [],
            ],
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
                'message' => session('message'),
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }
}
