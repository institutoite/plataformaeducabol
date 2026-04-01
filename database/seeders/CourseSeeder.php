<?php

namespace Database\Seeders;

use App\Models\Audience;
use App\Models\Course;
use App\Models\Description;
use App\Models\Goal;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Requirement;
use App\Models\Review;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseNames = [
            'Windows',
            'Word',
            'Excel',
            'Power Point',
            'Publisher',
            'Dactilografía',
            'Internet',
            'Utilidades ofimáticas',
            'Office avanzado'
        ];

        foreach ($courseNames as $name) {
            $course = Course::create([
                'title' => $name,
                'subtitle' => 'Curso de ' . $name,
                'description' => 'Descripción del curso de ' . $name,
                'status' => Course::PUBLICADO,
                'slug' => \Illuminate\Support\Str::slug($name),
                'user_id' => 1,
                'level_id' => 1,
                'category_id' => 1,
                'price_id' => 1,
            ]);

            Review::factory(5)->create([
                'course_id' => $course->id
            ]);

            Image::factory(1)->create([
                'imageable_id' => $course->id,
                'imageable_type' => 'App\\Models\\Course'
            ]);

            Requirement::factory(4)->create([
                'course_id' => $course->id
            ]);

            Goal::factory(4)->create([
                'course_id' => $course->id
            ]);

            Audience::factory(4)->create([
                'course_id' => $course->id
            ]);

            $sections = Section::factory(4)->create(['course_id' => $course->id]);

            foreach ($sections as $section) {
                $lessons = Lesson::factory(4)->create(['section_id' => $section->id]);

                foreach ($lessons as $lesson) {
                    Description::factory(1)->create(['lesson_id' => $lesson->id]);
                }
            }
        }
    }
}
