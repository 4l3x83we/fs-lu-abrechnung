<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['team_id', 'project_name', 'project_image', 'project_map',];
}
