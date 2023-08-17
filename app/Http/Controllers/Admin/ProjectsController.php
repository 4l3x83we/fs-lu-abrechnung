<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Projects;
use App\Models\Admin\Team;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::all();

        return view('projects.index', compact('projects'));
    }

    public function changeProject($projectID)
    {
        $project = Projects::findOrFail($projectID);
        auth()->user()->update([
            'current_project_id' => $projectID,
        ]);
        $subdomain = Team::findOrFail($project->team_id)->subdomain;

        $teamDomain = str_replace('://', '://'.$subdomain.'.', config('app.url'));
        return redirect($teamDomain.RouteServiceProvider::HOME);
    }
}
