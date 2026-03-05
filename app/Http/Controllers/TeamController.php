<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Team::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'tournament' => 'required|string',
        ]);

        return Team::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return $team;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'tournament' => 'sometimes|string',
        ]);

        $team->update($validated);
        return $team;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->noContent();
    }
}
