<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_team_id',
        'current_project_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function teams(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withPivot('is_owner');
    }

    public function projectName()
    {
        if (auth()->user()->current_project_id) {
            return Projects::findOrFail(auth()->user()->current_project_id)->project_name;
        }
    }

    public function teamName()
    {
        return Team::findOrFail(auth()->user()->current_team_id)->name;
    }

    public function teamImage()
    {
        return Team::findOrFail(auth()->user()->current_team_id)->image;
    }

    public function projectImage()
    {
        if (auth()->user()->current_project_id) {
            return Projects::findOrFail(auth()->user()->current_project_id)->project_image;
        }
    }
}
