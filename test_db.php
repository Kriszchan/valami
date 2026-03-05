<?php

require 'vendor/autoload.php';
require 'bootstrap/app.php';

use App\Models\Team;
use App\Models\Game;

// Check Teams
$teams = Team::all();
echo "Total teams in database: " . count($teams) . "\n";
echo "First 5 teams:\n";
foreach ($teams->take(5) as $team) {
    echo "  - {$team->name} ({$team->tournament})\n";
}

echo "\nTotal games: " . Game::count() . "\n";

// Test creating a new game
echo "\n--- Testing Game Creation ---\n";
if ($teams->count() >= 2) {
    $game = Game::create([
        'home_team_id' => $teams[0]->id,
        'away_team_id' => $teams[1]->id,
        'scheduled_at' => now()->addDays(5),
        'current_period' => 'not_started'
    ]);
    echo "Created game: {$teams[0]->name} vs {$teams[1]->name}\n";
    echo "Game ID: {$game->id}\n";
    echo "Status: {$game->current_period}\n";
}
