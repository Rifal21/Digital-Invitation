<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = [
            'admin_fee' => Setting::get('admin_fee', 0),
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'admin_fee' => 'required|numeric|min:0',
        ]);

        Setting::set('admin_fee', $request->admin_fee);

        return back()->with('success', 'Konfigurasi sistem berhasil diperbarui.');
    }
}
