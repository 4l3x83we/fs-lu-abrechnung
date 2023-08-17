<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: TeamPictures.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 12:30
 */

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Team;
use App\Models\Admin\Teams\Teams;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeamPictures extends Component
{
    use WithFileUploads;

    public $uploadPicture = false;

    public $team;

    public $image;

    public $path = 'images/teams/';

    protected $rules = [
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function mount()
    {
        $this->team = Team::find(auth()->user()->current_team_id);
    }

    public function uploadPicture()
    {
        $this->uploadPicture = true;
    }

    public function updatedImage()
    {
        $validatedData = $this->validate()['image'];
        $path = $this->path.strtolower($this->team->name).'/';

        if (File::exists($this->team->image)) {
            File::delete($this->team->image);
        }

        $this->team->update([
            'image' => image($validatedData, $path),
        ]);

        $this->uploadPicture = false;
        toastr()->success(__('The Team Logo has been successfully changed or added').'.', ' ');

        return redirect(request()->header('Referer'));
    }

    public function destroyPicture()
    {
        $team = $this->team;
        File::delete($team->image);
        $this->team->update([
            'image' => null,
        ]);

        toastr()->success(__('The team logo has been successfully deleted').'.', ' ');

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.admin.team-pictures');
    }
}
