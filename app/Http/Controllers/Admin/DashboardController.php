<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'invitations' => Invitation::count(),
        ];

        $latest_invitations = Invitation::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'latest_invitations'));
    }
}
