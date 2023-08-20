<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 19.${MONTH_NAME_FULL}.2023
 * Time: 12:07
 */

namespace App\Http\Livewire\Projects\Notes;

use Livewire\Component;
use Str;

class NotesEdit extends Component
{
    public $notes;

    public $changeNote;

    public $charsCount = 0;

    protected $messages = [
        'changeNote.required' => 'Notizen muss ausgefüllt werden.',
        'changeNote.max' => 'Notizen darf maximal 255 Zeichen haben.',
    ];

    protected $rules = [
        'changeNote' => ['required', 'max:255'],
    ];

    public function mount($notes)
    {
        $this->notes = $notes;
        $this->changeNote = $notes->notes;
        $this->updatedChangeNote($this->changeNote);
    }

    public function updatedChangeNote($value)
    {
        $this->charsCount = Str::length($value);
    }

    public function store()
    {
        $validatedData = $this->validate();

        $this->notes->update([
            'notes' => $validatedData['changeNote'],
        ]);

        toastr()->success('Note has been saved', __('note changed'));

        return to_route('project.notes.index');
    }

    public function render()
    {
        return view('livewire.projects.notes.notes-edit');
    }
}
