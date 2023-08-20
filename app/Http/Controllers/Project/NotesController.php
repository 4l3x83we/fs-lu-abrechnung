<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Admin\Projects;
use App\Models\Project\Notes;
use App\Models\User;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Notes::where('project_id', auth()->user()->current_project_id)->get();
        $newNotes = false;

        return view('projects.notes.index', compact('notes', 'newNotes'));
    }

    public function show(Notes $note)
    {
        $note['user'] = User::findOrFail($note->user_id)->name;
        $note['project'] = Projects::findOrFail($note->project_id)->project_name;

        return view('projects.notes.show', compact('note'));
    }

    public function edit(Notes $note)
    {
        return view('projects.notes.edit', compact('note'));
    }

    public function destroy(Notes $note)
    {
        $note->forceDelete();

        toastr()->error('Note has been irretrievably deleted', ' ');

        return to_route('project.notes.index');
    }
}
