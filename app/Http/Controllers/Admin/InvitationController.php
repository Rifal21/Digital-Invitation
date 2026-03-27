<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('user')->latest()->paginate(20);
        return view('admin.invitations.index', compact('invitations'));
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return back()->with('success', 'Undangan berhasil dihapus oleh Admin.');
    }
}
