<?php

namespace Database\Seeders;

use App\Models\Academic\Track;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = [
            'Academic',
            'Technical-Vocational-Livelihood',
        ];

        foreach ($tracks as $trackName) {
            Track::create([
                'track_id' => (string) Str::uuid(),
                'track_name' => $trackName,
            ]);
        }
    }
}
