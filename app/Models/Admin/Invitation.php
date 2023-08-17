<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = ['team_id', 'project_id', 'email', 'token', 'accepted_at',];

    protected $casts = ['accepted_at' => 'datetime',];

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
