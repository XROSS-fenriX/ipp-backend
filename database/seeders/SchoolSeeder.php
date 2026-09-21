<?php

namespace Database\Seeders;

use App\Models\School\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'school_id' => (string) Str::uuid(),
            'school_name' => 'Central Pangasinan Adventist School',
            'street' => 'Cosmos',
            'barangay' => 'Poblacion',
            'municipality' => 'Mapandan',
            'province' => 'Pangasinan',
            'type' => 'Private',
        ]);
    }
}
