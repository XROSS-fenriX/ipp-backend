<?php

namespace Database\Seeders;

use App\Models\Academic\Classroom;
use App\Models\Academic\Elective;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch generated teachers and sample elective
        $teachers = User::where('role', 'teacher')->get();
        $elective = Elective::where('elective_name', 'STEM')->first() ?? Elective::first();

        if ($teachers->isEmpty()) {
            return;
        }

        $sampleClassrooms = [
            [
                'classroom_name' => '10-A Mathematics',
                'subject_name' => 'General Mathematics',
                'grade_level' => 'Grade 10',
                'elective_id' => null,
            ],
            [
                'classroom_name' => '11-STEM Physics',
                'subject_name' => 'General Physics 1',
                'grade_level' => 'Grade 11',
                'elective_id' => $elective?->elective_id,
            ],
            [
                'classroom_name' => '12-STEM Chemistry',
                'subject_name' => 'General Chemistry',
                'grade_level' => 'Grade 12',
                'elective_id' => $elective?->elective_id,
            ],
        ];

        foreach ($sampleClassrooms as $index => $data) {
            // Assign a teacher as adviser iteratively[cite: 2, 3]
            $teacher = $teachers[$index % $teachers->count()];

            Classroom::updateOrCreate(
                [
                    'classroom_name' => $data['classroom_name'],
                    'subject_name' => $data['subject_name'],
                ],
                [
                    'grade_level' => $data['grade_level'],
                    'adviser_id' => $teacher->user_id,
                    'elective_id' => $data['elective_id'],
                ]
            );
        }
    }
}
