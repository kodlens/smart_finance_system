<?php

namespace Database\Seeders;

use App\Models\AppointmentType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            OfficeSeeder::class,
            AcademicYearSeeder::class,
            CourseSeeder::class,
            RoomSeeder::class,
            ScheduleSeeder::class,
            FacultyLoadSeeder::class,
            ProgramSeeder::class,
            StudentListSeeder::class
        ]);
    }
}
