<?php

namespace App\Models\Maps;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['icon', 'preview', 'map_id'];
}
