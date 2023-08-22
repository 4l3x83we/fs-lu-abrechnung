<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use App\Models\Maps\Maps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withPivot('is_owner');
    }

    public function projectName()
    {
        if (auth()->user()->current_project_id) {
            return Projects::findOrFail(auth()->user()->current_project_id)->project_name;
        }
    }

    public function projectMapID()
    {
        if (auth()->user()->current_project_id) {
            return Projects::findOrFail(auth()->user()->current_project_id)->project_map;
        }

        return null;
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

        return null;
    }

    public function mapAuswahl()
    {
        $map = null;
        $fields = null;
        $projectMap = Projects::where('team_id', auth()->user()->current_team_id)->first()->project_map;
        if ($projectMap) {
            $maps = Maps::find($projectMap);
            if (lang() === 'de') {
                $map = $maps->md_title_de;
            } else {
                $map = $maps->md_title_en;
            }
            $fields = count(json_decode($maps->md_fields, true));
        }

        return [
            'maps' => $map,
            'fields' => $fields,
        ];
    }
}
