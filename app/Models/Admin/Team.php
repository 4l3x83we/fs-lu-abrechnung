<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Traits\FilterByTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'image',
        'subdomain',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_owner');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Projects::class);
    }
}
