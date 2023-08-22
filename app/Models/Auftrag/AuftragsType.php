<?php

namespace App\Models\Auftrag;

use Illuminate\Database\Eloquent\Model;

class AuftragsType extends Model
{
    protected $fillable = ['team_id', 'project_id', 'name', 'kosten', 'type'];
}
