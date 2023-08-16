<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return Projects::all();
    }

    public function store(Request $request)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_name' => ['nullable'], 'project_image' => ['nullable'], 'project_map' => ['nullable'],]);

        return Projects::create($request->validated());
    }

    public function show(Projects $projects)
    {
        return $projects;
    }

    public function update(Request $request, Projects $projects)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_name' => ['nullable'], 'project_image' => ['nullable'], 'project_map' => ['nullable'],]);

        $projects->update($request->validated());

        return $projects;
    }

    public function destroy(Projects $projects)
    {
        $projects->delete();

        return response()->json();
    }
}
