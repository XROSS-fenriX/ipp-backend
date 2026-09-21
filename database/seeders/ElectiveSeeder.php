<?php

namespace Database\Seeders;

use App\Models\Academic\Elective;
use App\Models\Academic\Track;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ElectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = Track::all();

        if ($tracks->isEmpty()) {
            $this->command->warn('No tracks found. Please run TrackSeeder first.');
            return;
        }

        // Electives mapped under their respective Track names
        $electivesByTrack = [
            'Academic' => [
                'STEM',
                'ABM',
                'GAS',
                'HUMSS',
            ],
            'Technical-Vocational-Livelihood' => [
                // Add TVL electives/strands here if needed in the future
            ],
        ];

        foreach ($electivesByTrack as $trackName => $electives) {
            // Find track by exact name matching
            $track = $tracks->firstWhere('track_name', $trackName);

            if ($track) {
                foreach ($electives as $electiveName) {
                    Elective::firstOrCreate(
                        [
                            'elective_name' => $electiveName,
                            'track_id' => $track->track_id,
                        ],
                        [
                            'elective_id' => (string) Str::uuid(),
                        ]
                    );
                }
            } else {
                $this->command->warn("Track '{$trackName}' not found in the database.");
            }
        }
    }
}
