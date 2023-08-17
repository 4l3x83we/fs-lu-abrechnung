<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Invitation;
use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $invitationEmail = NULL;
        if (request('token')) {
            $invitation = Invitation::where('token', request('token'))
                ->whereNull('accepted_at')
                ->firstOrFail();

            $invitationEmail = $invitation->email;
        }

        return view('auth.register', compact('invitationEmail'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'team' => ['sometimes', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:teams,subdomain'],
        ]);

        $invitation = null;
        $email = $request->email;
        if ($request->token) {
            $invitation = Invitation::with('teams')
                ->where('token', $request->token)
                ->whereNull('accepted_at')
                ->first();

            if (!$invitation) {
                return redirect()->back()->withInput()->withErrors(['email' => __('Invitation link incorrect')]);
            }

            $email = $invitation->email;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
        ]);

        $subdomain = replaceStrToLower($request->team);
        if ($invitation) {
            $invitation->update(['accepted_at' => now()]);
            $team = Team::findOrFail($invitation->team_id);
            $team->users()->attach($user->id);
            $user->update(['current_team_id' => $invitation->team_id, 'current_project_id' => $invitation->project_id]);
            $subdomain = $team->subdomain;
        } else {
            $team = Team::create([
                'name' => $request->team,
                'subdomain' => $subdomain,
            ]);
            $team->users()->attach($user->id, ['is_owner' => true]);
            $user->update(['current_team_id' => $team->id,]);
        }

        event(new Registered($user));

        Auth::login($user);

        if (is_null($invitation)) {
            $project = Projects::create([
                'team_id' => $team->id,
                'project_name' => $team->name . ' Project'
            ]);

            $user->update(['current_project_id' => $project->id,]);
        }

        $teamDomain = str_replace('://', '://'.$subdomain.'.', config('app.url'));
        return redirect($teamDomain.RouteServiceProvider::HOME);
    }
}
