<?php

namespace App\Models\Admin;

use App\Traits\FilterByProject;
use App\Traits\FilterByTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Projects extends Model
{
    use FilterByTeam;
    protected $fillable = [
        'team_id',
        'project_name',
        'project_image',
        'project_map',
    ];

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
