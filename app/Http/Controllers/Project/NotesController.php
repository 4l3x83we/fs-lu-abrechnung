<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Notes::where('project_id', auth()->user()->current_project_id)->get();
        $newNotes = false;
        return view('projects.notes.index', compact('notes', 'newNotes'));
    }

    public function store(Request $request)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_id' => ['nullable', 'integer'], 'notes' => ['nullable'],]);

        return Notes::create($request->validated());
    }

    public function show(Notes $notes)
    {
        return $notes;
    }

    public function update(Request $request, Notes $notes)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_id' => ['nullable', 'integer'], 'notes' => ['nullable'],]);

        $notes->update($request->validated());

        return $notes;
    }

    public function destroy(Notes $notes)
    {
        $notes->delete();

        return response()->json();
    }
}
