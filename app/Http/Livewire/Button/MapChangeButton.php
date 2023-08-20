<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: MapChangeButton.php
 * User: ${USER}
 * Date: 20.${MONTH_NAME_FULL}.2023
 * Time: 09:26
 */

namespace App\Http\Livewire\Button;

use App\Models\Admin\Projects;
use Livewire\Component;

class MapChangeButton extends Component
{
    public $mapID;

    public function mapChange($mapID)
    {
        $project = Projects::find(auth()->user()->current_project_id);
        $project->update([
            'project_map' => $mapID,
            'updated_at' => now(),
        ]);

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.button.map-change-button');
    }
}
