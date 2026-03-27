<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::latest()->get();
        return view('admin.themes.index', compact('themes'));
    }

    public function create()
    {
        return view('admin.themes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:themes,slug',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tag' => 'required|string',
            'color' => 'required|string',
            'is_active' => 'boolean'
        ]);

        Theme::create($validated);

        return redirect()->route('admin.themes.index')->with('success', 'Tema baru berhasil ditambahkan.');
    }

    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:themes,slug,' . $theme->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tag' => 'required|string',
            'color' => 'required|string',
            'is_active' => 'boolean'
        ]);

        // Handle boolean because checkbox might not send value if unchecked
        $validated['is_active'] = $request->has('is_active');

        $theme->update($validated);

        return redirect()->route('admin.themes.index')->with('success', 'Tema berhasil diperbarui.');
    }

    public function destroy(Theme $theme)
    {
        $theme->delete();
        return back()->with('success', 'Tema berhasil dihapus.');
    }
}
