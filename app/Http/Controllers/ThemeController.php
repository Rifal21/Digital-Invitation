<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::where('is_active', true)->get();
        return view('themes.index', compact('themes'));
    }

    public function show($slug)
    {
        $theme = Theme::where('slug', $slug)->firstOrFail();
        
        // Dummy data for preview
        $invitation = new Invitation([
            'title' => 'The Wedding of Romeo & Juliet',
            'groom_name' => 'Romeo Montague',
            'bride_name' => 'Juliet Capulet',
            'event_date' => now()->addMonths(3),
            'event_location' => 'Verona Italian Garden, Jakarta Selatan',
            'message' => 'Cinta kami akan terus tumbuh seiring berjalannya waktu.',
            'theme_color' => $theme->color,
            'slug' => 'preview-dummy',
            'theme' => $theme->slug
        ]);

        $invitation->data = (new InvitationController)->mergeInvitationDefaults($invitation);
        $messages = collect([]); // Dummy messages for preview

        return view("invitations.themes.{$theme->slug}", compact('invitation', 'messages'));
    }
}
