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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $targetSlug = 'titutlo-del-curso';
        $legacySlug = 'windows-basico-desde-cero';

        $defaultImage = 'courses/default-course.png';
        if (!Storage::disk('public')->exists($defaultImage)) {
            Storage::disk('public')->makeDirectory('courses');

            $fallbackPublicImage = public_path('img/sinimagen.png');
            if (file_exists($fallbackPublicImage)) {
                copy($fallbackPublicImage, storage_path('app/public/' . $defaultImage));
            }
        }

        $course = Course::where('slug', $targetSlug)
            ->orWhere('slug', $legacySlug)
            ->orWhere('title', 'Windows Basico desde Cero')
            ->first();

        if (!$course) {
            $course = new Course();
        }

        $course->fill([
            'title' => 'Windows Basico desde Cero',
            'subtitle' => 'Manejo practico de computadora, Windows y archivos',
            'description' => 'Curso practico para aprender desde cero el uso de la computadora, el escritorio de Windows, manejo de teclado y mouse, carpetas, archivos y WordPad.',
            'status' => Course::PUBLICADO,
            'slug' => $targetSlug,
            'user_id' => 1,
            'level_id' => 1,
            'category_id' => 1,
            'price_id' => 1,
        ]);
        $course->save();

        Image::updateOrCreate(
            [
                'imageable_id' => $course->id,
                'imageable_type' => Course::class,
            ],
            ['url' => $defaultImage]
        );

        if (!$course->reviews()->exists()) {
            Review::factory(5)->create(['course_id' => $course->id]);
        }

        $course->requirements()->delete();
        $course->goals()->delete();
        $course->audiences()->delete();
        $course->sections()->delete();

        $goals = [
            'Dominar lo esencial de Windows para uso diario.',
            'Administrar archivos y carpetas con seguridad.',
            'Usar teclado y mouse con buena precision.',
            'Trabajar con WordPad para formato basico de texto.',
            'Personalizar el escritorio y configuraciones basicas del sistema.',
        ];

        foreach ($goals as $goal) {
            Goal::create([
                'name' => $goal,
                'course_id' => $course->id,
            ]);
        }

        $requirements = [
            'No se requieren conocimientos previos.',
            'Contar con una computadora con Windows.',
            'Tener mouse y teclado en buen estado.',
            'Disposicion para practicar de forma constante.',
        ];

        foreach ($requirements as $requirement) {
            Requirement::create([
                'name' => $requirement,
                'course_id' => $course->id,
            ]);
        }

        $audiences = [
            'Personas que inician desde cero en computacion.',
            'Estudiantes que necesitan bases solidas de Windows.',
            'Trabajadores que desean mejorar su manejo de archivos.',
            'Adultos que quieren usar la computadora con confianza.',
        ];

        foreach ($audiences as $audience) {
            Audience::create([
                'name' => $audience,
                'course_id' => $course->id,
            ]);
        }

        $sections = [
            'Fundamentos de la computadora' => [
                'Encender y apagar la computadora',
                'Partes basicas de la computadora',
            ],
            'Escritorio de Windows' => [
                'El escritorio de Windows',
                'Partes del escritorio de Windows',
                'Archivos, iconos, iconos especiales (papelera) y accesos directos',
                'Barra de tareas',
                'Menu Inicio',
                'Fecha y hora',
            ],
            'Uso del mouse' => [
                'Uso del mouse',
                'Click izquierdo',
                'Click derecho',
                'Doble click',
                'Triple click',
                'Scroll',
                'Arrastrar y soltar',
            ],
            'Uso basico del teclado' => [
                'Uso basico del teclado',
                'Teclas alfanumericas',
                'Teclas numericas',
                'Caracteres especiales',
                'Teclas principales: Enter, Shift, Tab, Backspace, Delete, Barra espaciadora',
                'Bloq Mayus y Bloq Num',
                'Codigo ASCII basico',
            ],
            'Explorador de archivos' => [
                'Uso basico del explorador de archivos',
                'Unidades de almacenamiento',
                'Extensiones de archivos',
                'Guardar, abrir y localizar archivos',
            ],
            'Gestion de archivos y carpetas' => [
                'Crear directorios',
                'Crear carpetas',
                'Abrir carpetas',
                'Renombrar archivos y carpetas',
                'Navegar en directorios: atras, adelante, scroll y barra de desplazamiento',
                'Copiar archivos y carpetas',
                'Cortar archivos y carpetas',
                'Pegar archivos y carpetas',
                'Mover archivos y carpetas',
                'Copiar y pegar: con teclado',
                'Copiar y pegar: con barra de herramientas',
                'Copiar y pegar: con mouse',
            ],
            'Papelera de reciclaje' => [
                'Eliminar archivos a la papelera',
                'Eliminar archivos permanentemente',
                'Restaurar archivos de la papelera',
                'Vaciar la papelera',
            ],
            'Busquedas y programas' => [
                'Buscar archivos y carpetas',
                'Buscar programas',
                'Abrir programas basicos',
                'Cerrar programas',
            ],
            'Ventanas y portapapeles' => [
                'Minimizar, maximizar y restaurar ventanas',
                'Cambiar entre ventanas con mouse y teclado',
                'Uso basico del portapapeles',
            ],
            'Personalizacion del entorno' => [
                'Cambiar icono de carpeta o acceso directo',
                'Ordenar iconos del escritorio',
                'Crear accesos directos',
                'Personalizar el escritorio',
                'Cambiar fondo de pantalla',
                'Configuracion basica de pantalla',
                'Ajuste de volumen',
            ],
            'WordPad basico' => [
                'WordPad: introduccion',
                'WordPad: negrita',
                'WordPad: subrayado',
                'WordPad: tachado',
                'WordPad: color de fuente',
                'WordPad: resaltado',
                'WordPad: alineacion',
                'WordPad: tamano de fuente',
            ],
        ];

        foreach ($sections as $sectionName => $lessons) {
            $section = Section::create([
                'name' => $sectionName,
                'course_id' => $course->id,
            ]);

            foreach ($lessons as $lessonName) {
                $lesson = Lesson::create([
                    'name' => $lessonName,
                    'url' => 'https://youtu.be/DgDxAzbkOSs',
                    'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/DgDxAzbkOSs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    'section_id' => $section->id,
                ]);

                Description::create([
                    'name' => 'En esta leccion aprenderas: ' . $lessonName . '.',
                    'lesson_id' => $lesson->id,
                ]);
            }
        }

        $otherCourses = [
            'Word',
            'Excel',
            'Power Point',
            'Publisher',
            'Dactilografia',
            'Internet',
            'Utilidades ofimaticas',
            'Office avanzado',
        ];

        foreach ($otherCourses as $name) {
            $genericCourse = Course::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'title' => $name,
                    'subtitle' => 'Curso de ' . $name,
                    'description' => 'Descripcion del curso de ' . $name,
                    'status' => Course::PUBLICADO,
                    'user_id' => 1,
                    'level_id' => 1,
                    'category_id' => 1,
                    'price_id' => 1,
                ]
            );

            Image::updateOrCreate(
                [
                    'imageable_id' => $genericCourse->id,
                    'imageable_type' => Course::class,
                ],
                ['url' => $defaultImage]
            );
        }
    }
}
