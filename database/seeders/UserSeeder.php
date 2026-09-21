<?php

namespace Database\Seeders;

use App\Models\Academic\Elective;
use App\Models\School\School;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        // Retrieve sample school and elective IDs
        $school = School::first();
        $elective = Elective::where('elective_name', 'STEM')->first() ?? Elective::first();

        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@school.edu'],
            [
                'user_id' => (string) Str::uuid(),
                'password' => $password,
                'role' => 'admin',
                'fname' => 'System',
                'mname' => 'A.',
                'lname' => 'Administrator',
                'gender' => 'Male',
                'contact' => '09123456789',
                'account_status' => 'active',
                'school_id' => $school?->school_id,
                'elective_id' => null,
                'email_verified_at' => now(),
            ]
        );

        // Teacher Account
        User::updateOrCreate(
            ['email' => 'teacher@school.edu'],
            [
                'user_id' => (string) Str::uuid(),
                'password' => $password,
                'role' => 'teacher',
                'fname' => 'Jane',
                'mname' => 'B.',
                'lname' => 'Doe',
                'gender' => 'Female',
                'contact' => '09234567890',
                'account_status' => 'active',
                'school_id' => $school?->school_id,
                'elective_id' => null,
                'email_verified_at' => now(),
            ]
        );

        // Student Account
        User::updateOrCreate(
            ['email' => 'student@school.edu'],
            [
                'user_id' => (string) Str::uuid(),
                'password' => $password,
                'role' => 'student',
                'fname' => 'John',
                'mname' => 'C.',
                'lname' => 'Smith',
                'gender' => 'Male',
                'contact' => '09345678901',
                'account_status' => 'active',
                'school_id' => $school?->school_id,
                'elective_id' => $elective?->elective_id,
                'email_verified_at' => now(),
            ]
        );
    }
}
