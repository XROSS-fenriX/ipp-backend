<?php

namespace Database\Seeders;

use App\Models\Academic\Assessment;
use App\Models\Academic\AssessmentQuestion;
use App\Models\Academic\EnumerationAnswer;
use App\Models\Academic\IdentificationAnswer;
use App\Models\Academic\McqChoice;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $assessment = Assessment::create([
            'assessment_title' => 'Introduction to Information Technology',
            'assessment_type' => 'Quiz',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 1 - Multiple Choice
        |--------------------------------------------------------------------------
        */

        $question1 = AssessmentQuestion::create([
            'question' => 'What does CPU stand for?',
            'question_type' => 'mcq',
            'points' => 2,
            'assessment_id' => $assessment->assessment_id,
        ]);

        McqChoice::create([
            'choice' => 'Central Processing Unit',
            'is_correct' => true,
            'question_id' => $question1->question_id,
        ]);

        McqChoice::create([
            'choice' => 'Computer Personal Unit',
            'is_correct' => false,
            'question_id' => $question1->question_id,
        ]);

        McqChoice::create([
            'choice' => 'Central Program Utility',
            'is_correct' => false,
            'question_id' => $question1->question_id,
        ]);

        McqChoice::create([
            'choice' => 'Computer Processing Utility',
            'is_correct' => false,
            'question_id' => $question1->question_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 2 - Multiple Choice
        |--------------------------------------------------------------------------
        */

        $question2 = AssessmentQuestion::create([
            'question' => 'Which language is primarily used by Laravel?',
            'question_type' => 'mcq',
            'points' => 2,
            'assessment_id' => $assessment->assessment_id,
        ]);

        McqChoice::create([
            'choice' => 'PHP',
            'is_correct' => true,
            'question_id' => $question2->question_id,
        ]);

        McqChoice::create([
            'choice' => 'Python',
            'is_correct' => false,
            'question_id' => $question2->question_id,
        ]);

        McqChoice::create([
            'choice' => 'Java',
            'is_correct' => false,
            'question_id' => $question2->question_id,
        ]);

        McqChoice::create([
            'choice' => 'C++',
            'is_correct' => false,
            'question_id' => $question2->question_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 3 - Identification
        |--------------------------------------------------------------------------
        */

        $question3 = AssessmentQuestion::create([
            'question' => 'What does API stand for?',
            'question_type' => 'identification',
            'points' => 3,
            'assessment_id' => $assessment->assessment_id,
        ]);

        IdentificationAnswer::create([
            'correct_answer' => 'Application Programming Interface',
            'question_id' => $question3->question_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Question 4 - Enumeration
        |--------------------------------------------------------------------------
        */

        $question4 = AssessmentQuestion::create([
            'question' => 'Enumerate the three basic components of a URL.',
            'question_type' => 'enumeration',
            'points' => 3,
            'assessment_id' => $assessment->assessment_id,
        ]);

        EnumerationAnswer::create([
            'answer' => 'Protocol',
            'question_id' => $question4->question_id,
        ]);

        EnumerationAnswer::create([
            'answer' => 'Domain',
            'question_id' => $question4->question_id,
        ]);

        EnumerationAnswer::create([
            'answer' => 'Path',
            'question_id' => $question4->question_id,
        ]);
    }
}
