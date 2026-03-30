<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuestTemplateExport;
use App\Imports\GuestsImport;

class GuestController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'group' => 'nullable|string|max:100',
        ]);

        $guest = $invitation->guests()->create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'group' => $validated['group'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(4),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'guest' => $guest]);
        }

        return back()->with('success', 'Tamu berhasil ditambahkan!');
    }

    public function destroy(Guest $guest)
    {
        if ($guest->invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $guest->delete();
        return back()->with('success', 'Tamu berhasil dihapus!');
    }

    public function update(Request $request, Guest $guest)
    {
        if ($guest->invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'group' => 'nullable|string|max:100',
        ]);

        $guest->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'group' => $validated['group'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(4),
        ]);

        return back()->with('success', 'Data tamu berhasil diperbarui!');
    }

    public function import(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new GuestsImport($invitation), $request->file('file'));
            return back()->with('success', 'Daftar tamu berhasil diimpor!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new GuestTemplateExport, 'template_tamu_memora.xlsx');
    }
}
