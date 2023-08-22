<?php

namespace App\Http\Controllers\Auftrag;

use App\Http\Controllers\Controller;
use App\Models\Auftrag\AuftragsType;
use Illuminate\Http\Request;

class AuftragsTypeController extends Controller
{
    public function index()
    {
        return AuftragsType::all();
    }

    public function store(Request $request)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_id' => ['nullable', 'integer'], 'name' => ['nullable'], 'kosten' => ['nullable'], 'type' => ['nullable']]);

        return AuftragsType::create($request->validated());
    }

    public function show(AuftragsType $auftragsType)
    {
        return $auftragsType;
    }

    public function update(Request $request, AuftragsType $auftragsType)
    {
        $request->validate(['team_id' => ['nullable', 'integer'], 'project_id' => ['nullable', 'integer'], 'name' => ['nullable'], 'kosten' => ['nullable'], 'type' => ['nullable']]);

        $auftragsType->update($request->validated());

        return $auftragsType;
    }

    public function destroy(AuftragsType $auftragsType)
    {
        $auftragsType->delete();

        return response()->json();
    }
}
