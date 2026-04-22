<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => 'admin123',
            'account_type' => 'admin',
        ]);

        // Create sample subjects
        Subject::create([
            'code' => 'CS101',
            'title' => 'Introduction to Computer Science',
            'unit' => 3,
        ]);
        Subject::create([
            'code' => 'MATH201',
            'title' => 'Advanced Mathematics',
            'unit' => 4,
        ]);
        Subject::create([
            'code' => 'ENG150',
            'title' => 'English Composition',
            'unit' => 3,
        ]);
        Subject::create([
            'code' => 'PHY301',
            'title' => 'Physics Laboratory',
            'unit' => 2,
        ]);

        // Create sample programs
        Program::create([
            'code' => 'BSCS',
            'title' => 'Bachelor of Science in Computer Science',
            'years' => 4,
        ]);
        Program::create([
            'code' => 'BSMATH',
            'title' => 'Bachelor of Science in Mathematics',
            'years' => 4,
        ]);
        Program::create([
            'code' => 'BAENG',
            'title' => 'Bachelor of Arts in English',
            'years' => 4,
        ]);
        Program::create([
            'code' => 'BSPHYS',
            'title' => 'Bachelor of Science in Physics',
            'years' => 4,
        ]);
    }
}
