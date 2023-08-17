<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ProjectPictures.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 12:31
 */

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use File;

class ProjectPictures extends Component
{
    use WithFileUploads;

    public $uploadPicture = false;

    public $project;

    public $image;

    public $path = 'images/teams/';

    protected $rules = [
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function mount()
    {
        $this->project = Projects::find(auth()->user()->current_project_id);
    }

    public function uploadPicture()
    {
        $this->uploadPicture = true;
    }

    public function updatedImage()
    {
        $validatedData = $this->validate()['image'];
        $path = $this->path.strtolower(auth()->user()->teamName()).'/'.strtolower(auth()->user()->projectName()).'/';

        if (File::exists($this->project->project_image)) {
            File::delete($this->project->project_image);
        }

        $this->project->update([
            'project_image' => image($validatedData, $path),
        ]);

        $this->uploadPicture = false;
        toastr()->success(__('The Project Logo has been successfully changed or added').'.', ' ');

        return redirect(request()->header('Referer'));
    }

    public function destroyPicture()
    {
        $project = $this->project;
        File::delete($project->project_image);
        $this->project->update([
            'project_image' => null,
        ]);

        toastr()->success(__('The Project Logo has been successfully deleted').'.', ' ');

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.admin.project-pictures');
    }
}
