<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: NotesCreate.php
 * User: ${USER}
 * Date: 18.${MONTH_NAME_FULL}.2023
 * Time: 12:09
 */

namespace App\Http\Livewire\Projects\Notes;

use App\Models\Project\Notes;
use Livewire\Component;
use Str;

class NotesCreate extends Component
{
    public $newNotes = false;

    public $notes;

    public $charsCount = 0;

    protected $messages = [
        'notes.required' => 'Notizen muss ausgefüllt werden.',
        'notes.max' => 'Notizen darf maximal 255 Zeichen haben.',
    ];

    protected $rules = [
        'notes' => ['required', 'max:255'],
    ];

    public function newNotes()
    {
        $this->newNotes = true;
    }

    public function updatedNotizenNotes($value)
    {
        $this->charsCount = Str::length($value);
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['team_id'] = auth()->user()->current_team_id;
        $validatedData['project_id'] = auth()->user()->current_project_id;
        $validatedData['user_id'] = auth()->id();
        Notes::create([
            'team_id' => $validatedData['team_id'],
            'project_id' => $validatedData['project_id'],
            'user_id' => $validatedData['user_id'],
            'notes' => $validatedData['notes'],
        ]);

        $this->newNotes = false;
        toastr()->success('Note has been saved');

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.projects.notes.notes-create');
    }
}
