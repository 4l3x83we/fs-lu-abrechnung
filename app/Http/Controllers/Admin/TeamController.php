<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return Team::all();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['nullable'], 'image' => ['nullable'], 'subdomain' => ['nullable'],]);

        return Team::create($request->validated());
    }

    public function show(Team $team)
    {
        return $team;
    }

    public function update(Request $request, Team $team)
    {
        $request->validate(['name' => ['nullable'], 'image' => ['nullable'], 'subdomain' => ['nullable'],]);

        $team->update($request->validated());

        return $team;
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json();
    }
}
