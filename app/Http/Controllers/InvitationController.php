<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\InvitationMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = \Illuminate\Support\Facades\Auth::user()->invitations()->latest()->get();
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        $themes = \App\Models\Theme::where('is_active', true)->get();
        return view('invitations.create', compact('themes'));
    }

    public function store(Request $request)
    {
        // If theme only (from the theme picker)
        if ($request->has('theme') && !$request->has('groom_name')) {
            $invitation = \Illuminate\Support\Facades\Auth::user()->invitations()->create([
                'title' => 'Draf Undangan Baru',
                'groom_name' => 'Mempelai Pria',
                'bride_name' => 'Mempelai Wanita',
                'slug' => 'draft-' . Str::random(8),
                'theme' => $request->theme,
                'theme_color' => '#E11D48',
                'event_date' => now()->addMonths(3),
                'event_location' => 'Nama Tempat / Lokasi',
            ]);
            return redirect()->route('invitations.edit', $invitation);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'slug' => 'required|string|unique:invitations,slug',
            'theme_color' => 'required|string',
            'theme' => 'required|string|exists:themes,slug',
        ]);

        $invitation = \Illuminate\Support\Facades\Auth::user()->invitations()->create($validated);

        return redirect()->route('invitations.edit', $invitation)->with('success', 'Undangan berhasil dibuat! Silakan mulai kustomisasi.');
    }

    public function edit(Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }
        
        $invitation->data = $this->mergeInvitationDefaults($invitation);
        
        // Save if structure updated (only in editor to persist for this user)
        $currentData = $invitation->getOriginal('data') ?? [];
        if (json_encode($invitation->data) !== json_encode($currentData)) {
            $invitation->save();
        }

        return view('invitations.editor', compact('invitation'));
    }

    public function mergeInvitationDefaults(Invitation $invitation): array
    {
        $defaults = [
            'general' => [
                'quote' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri...',
                'music_url' => '',
                'title_font' => 'font-script',
                'body_font' => 'font-serif',
                'bg_color' => '#ffffff',
                'accent_color' => '#3a4d39',
                'show_story' => true,
                'show_gallery' => true,
                'show_gift' => true,
                'show_rsvp' => true,
            ],
            'hero' => [
                'background_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80',
                'title_font' => 'font-script',
            ],
            'groom' => [
                'full_name' => $invitation->groom_name,
                'father' => 'Nama Ayah Mempelai Pria',
                'mother' => 'Nama Ibu Mempelai Pria',
                'instagram' => '@groom',
                'child_order' => 'Putra Pertama',
                'image' => 'https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=1200&q=80',
                'bg_pos' => 'center',
            ],
            'bride' => [
                'full_name' => $invitation->bride_name,
                'father' => 'Nama Ayah Mempelai Wanita',
                'mother' => 'Nama Ibu Mempelai Wanita',
                'instagram' => '@bride',
                'child_order' => 'Putri Pertama',
                'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80',
                'bg_pos' => 'center',
            ],
            'event' => [
                'akad_time' => '08:00 - 10:00 WIB',
                'resepsi_time' => '11:00 - Selesai',
                'google_maps' => '',
                'image' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=1200&q=80',
            ],
            'story' => [
                ['year' => '2022', 'content' => 'Pertemuan pertama kami di sebuah kafe kecil.'],
                ['year' => '2024', 'content' => 'Kami memutuskan untuk melangkah ke jenjang yang lebih serius.'],
            ],
            'gift' => [
                'bank_name' => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_holder' => $invitation->groom_name,
            ],
            'gallery' => [],
        ];

        return array_replace_recursive($defaults, $invitation->data ?? []);
    }

    public function save(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'slug' => 'required|string|unique:invitations,slug,' . $invitation->id,
            'data' => 'required|array',
        ]);

        $invitation->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil disimpan!');
    }

    public function destroy(Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $invitation->delete();
        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dihapus!');
    }

    public function upload(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'image' => 'required|image|max:5120', // Limit to 5MB
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('invitations/assets', 'public');
            return response()->json([
                'success' => true,
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['success' => false, 'error' => 'No file uploaded'], 400);
    }

    public function show(Invitation $invitation)
    {
        $theme = $invitation->theme ?? 'modern';
        $invitation->data = $this->mergeInvitationDefaults($invitation);
        $messages = $invitation->messages()->latest()->get();
        return view("invitations.themes.{$theme}", compact('invitation', 'messages'));
    }

    public function storeMessage(Request $request, Invitation $invitation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'is_attending' => 'boolean',
            'guest_count' => 'integer|min:1|max:10',
        ]);

        $message = $invitation->messages()->create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan dikirim!',
                'data' => $message
            ]);
        }

        return back()->with('success', 'Pesan Anda telah terkirim!');
    }

    public function destroyMessage(InvitationMessage $message)
    {
        if ($message->invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }

    public function guests(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $search = $request->input('search');
        
        $query = $invitation->guests()->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('group', 'like', "%{$search}%");
            });
        }

        $invitation->getGuests = $query->paginate(9)->withQueryString();
        
        if ($request->ajax()) {
            return view('invitations.partials.guest-list', compact('invitation', 'search'))->render();
        }

        return view('invitations.guests', compact('invitation', 'search'));
    }
}
