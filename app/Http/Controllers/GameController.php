<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Game::with(['homeTeam', 'awayTeam'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'scheduled_at' => 'required|date',
            'current_period' => 'sometimes|in:not_started,first_half,second_half,finished',
        ]);

        $validated['current_period'] = $validated['current_period'] ?? 'not_started';

        return Game::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return $game->load(['homeTeam', 'awayTeam']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'home_score' => 'sometimes|integer|min:0',
            'away_score' => 'sometimes|integer|min:0',
            'current_period' => 'sometimes|in:not_started,first_half,second_half,finished',
            'scheduled_at' => 'sometimes|date',
        ]);

        $game->update($validated);
        return $game->load(['homeTeam', 'awayTeam']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return response()->noContent();
    }
}
