<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::role('admin')->count(),
            'total_editors' => User::role('editor')->count(),
            'total_users_basic' => User::role('user')->count(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats
        ]);
    }
}
