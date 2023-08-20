<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: UserController.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 11:29
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Invitation;
use App\Notifications\SendInvitationNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $invitations = Invitation::where('team_id', auth()->user()->current_team_id)->latest()->get();

        return view('settings.admin.users.index', compact('invitations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:invitations,email'],
        ]);

        $invitation = Invitation::create([
            'team_id' => auth()->user()->current_team_id,
            'project_id' => auth()->user()->current_project_id,
            'email' => $request->email,
            'token' => Str::random(32),
        ]);

        Notification::route('mail', $request->email)
            ->notify(new SendInvitationNotification($invitation));

        return redirect()->route('settings.admin.users.index');
    }

    public function acceptInvitation($token)
    {
        $invitation = Invitation::with('teams')
            ->where('token', $token)
            ->whereNull('accepted_at')
            ->firstOrFail();

        if (auth()->check()) {
            $invitation->update(['accepted_at' => now()]);
            auth()->user()->teams()->attach($invitation->team_id);
            auth()->user()->update(['current_team_id' => $invitation->team_id]);
            $teamDomain = str_replace('://', '://'.$invitation->teams->subdomain.'.', config('app.url'));

            return redirect($teamDomain.RouteServiceProvider::HOME);
        } else {
            return redirect()->route('register', ['token' => $invitation->token]);
        }
    }
}
