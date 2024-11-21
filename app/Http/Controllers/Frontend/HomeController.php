<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::first();

        return Inertia::render('Frontend/Home', [
            'siteSettings' => $siteSettings
        ]);
    }
}
