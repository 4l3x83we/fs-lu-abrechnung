<?php

namespace App\Providers;

use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage_users', function (User $user) {
            return $user->teams()
                ->where('id', auth()->user()->current_team_id)
                ->wherePivot('is_owner', true)
                ->exists();
        });
        Gate::define('team_member', function (User $user) {
            return $user->teams()->where('id', auth()->user()->current_team_id)->exists();
        });
        Gate::define('project_member', function (User $user) {
            $project = Projects::findOrFail(auth()->user()->current_project_id);
            return $user->where('current_project_id', $project->id)->exists();
        });
    }
}
