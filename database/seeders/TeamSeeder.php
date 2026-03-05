<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/footballTeam.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: {$csvFile}");
            return;
        }

        $handle = fopen($csvFile, 'r');
        $header = fgetcsv($handle, 1000, ';'); // Olvasd be a fejlécet

        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            if (count($data) >= 2 && !empty($data[0])) {
                Team::create([
                    'name' => trim($data[0]),
                    'tournament' => trim($data[1]),
                ]);
            }
        }

        fclose($handle);

        $teamCount = Team::count();
        $this->command->info("Successfully imported {$teamCount} teams from CSV file.");
    }
}
