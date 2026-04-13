<x-app-layout>

    <section class="relative overflow-hidden bg-cover bg-center" style="background-image: url({{ asset('img/home/home.jpg') }});">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/85 via-gray-900/70 to-gray-900/45"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="max-w-2xl">
                <p class="inline-flex items-center rounded-full bg-white/10 px-4 py-1.5 text-sm font-semibold tracking-wide text-white ring-1 ring-white/25">
                    Plataforma educativa ITE
                </p>

                <h1 class="mt-5 text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">
                    Aprende habilidades reales,
                    <span class="text-teal-300">a tu ritmo</span>
                </h1>

                <p class="mt-5 max-w-xl text-base text-gray-100 sm:text-lg">
                    Cursos practicos para mejorar tus conocimientos en computacion y otras areas clave, con contenido claro y acompanamiento permanente.
                </p>

                <div class="mt-8">
                    @livewire('search')
                </div>

                <div class="mt-8 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <div class="rounded-xl border border-white/20 bg-white/10 px-4 py-3 text-white backdrop-blur-sm">
                        <p class="text-2xl font-bold">+1000</p>
                        <p class="text-xs uppercase tracking-wider text-gray-200">Estudiantes</p>
                    </div>
                    <div class="rounded-xl border border-white/20 bg-white/10 px-4 py-3 text-white backdrop-blur-sm">
                        <p class="text-2xl font-bold">9+</p>
                        <p class="text-xs uppercase tracking-wider text-gray-200">Cursos activos</p>
                    </div>
                    <div class="rounded-xl border border-white/20 bg-white/10 px-4 py-3 text-white backdrop-blur-sm">
                        <p class="text-2xl font-bold">100%</p>
                        <p class="text-xs uppercase tracking-wider text-gray-200">En linea</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-12">
                <p class="text-sm font-semibold uppercase tracking-widest text-teal-600">Nuestra propuesta</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-800">Por que elegirnos</h2>
                <p class="mt-3 text-gray-500">Creamos una experiencia de aprendizaje clara, flexible y enfocada en resultados.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <article class="group rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <figure>
                        <img class="h-40 w-full rounded-t-2xl object-cover" src="{{ asset('img/home/1.jpg') }}" alt="Aprende a tu ritmo">
                    </figure>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800">Aprende a tu ritmo</h3>
                        <p class="mt-2 text-sm text-gray-500">Accede cuando quieras y avanza desde cualquier dispositivo.</p>
                    </div>
                </article>

                <article class="group rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <figure>
                        <img class="h-40 w-full rounded-t-2xl object-cover" src="{{ asset('img/home/2.jpg') }}" alt="Profesores con experiencia">
                    </figure>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800">Profesores con experiencia</h3>
                        <p class="mt-2 text-sm text-gray-500">Formacion practica guiada por docentes con trayectoria.</p>
                    </div>
                </article>

                <article class="group rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <figure>
                        <img class="h-40 w-full rounded-t-2xl object-cover" src="{{ asset('img/home/3.jpg') }}" alt="Contenido profesional">
                    </figure>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800">Contenido profesional</h3>
                        <p class="mt-2 text-sm text-gray-500">Lecciones estructuradas para aprender con claridad y foco.</p>
                    </div>
                </article>

                <article class="group rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl">
                    <figure>
                        <img class="h-40 w-full rounded-t-2xl object-cover" src="{{ asset('img/home/4.jpg') }}" alt="Inscribete hoy">
                    </figure>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800">Inscribete hoy</h3>
                        <p class="mt-2 text-sm text-gray-500">Encuentra cursos de computacion y otras areas utiles para tu crecimiento.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    @role('Student')
        <section class="relative overflow-hidden bg-gray-900 py-20">
            <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image: url('https://cdn.pixabay.com/photo/2020/08/04/08/10/woman-5462074_960_720.jpg');"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/90 to-gray-900/80"></div>

            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">Comparte tu experiencia y ensena en ITE</h2>
                <p class="mt-4 text-gray-200 text-lg">Crea contenido, publicalo en nuestra plataforma y genera ingresos con tus conocimientos.</p>
                <div class="mt-8">
                    <a href="{{ route('solicitude.teacher') }}" class="inline-flex items-center rounded-lg bg-teal-500 px-6 py-3 font-bold text-white transition hover:bg-teal-400">
                        Convertirme en profesor
                    </a>
                </div>
            </div>
        </section>
    @endrole

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row mb-8">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-teal-600">Contenido reciente</p>
                    <h2 class="text-3xl font-bold text-gray-800">Ultimos cursos</h2>
                    <p class="text-sm text-gray-500 mt-1">Estamos ampliando continuamente nuestro catalogo de formacion.</p>
                </div>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:bg-gray-50">
                    Ver catalogo completo
                </a>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-gray-800 to-gray-700 py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white">No sabes que curso elegir</h2>
            <p class="mt-2 text-gray-200">Explora el catalogo y filtra por categoria o nivel hasta encontrar el ideal para ti.</p>
            <div class="mt-6">
                <a href="{{ route('courses.index') }}" class="inline-flex items-center rounded-lg bg-teal-500 px-6 py-3 font-bold text-white transition hover:bg-teal-400">
                    Ir al catalogo de cursos
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-4">
                <div>
                    <a data-turbo="false" href="/">
                        <img src="{{ asset('img/home/logo.png') }}" alt="Logo ITE" class="h-12">
                    </a>
                    <p class="mt-4 text-sm text-gray-500">Formacion practica para impulsar tu desarrollo academico y profesional.</p>
                </div>

                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Telefonos</h3>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li>+591 71039910</li>
                        <li>+591 71324941</li>
                        <li>+591 75553338</li>
                        <li>3-219050</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Correo</h3>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li>info@ite.com.bo</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Direccion</h3>
                    <p class="mt-4 text-sm text-gray-600">
                        Villa 1 de Mayo, av. Tres Pasos al Frente esquina Che Guevara 4710<br>
                        Santa Cruz de la Sierra, Bolivia
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 py-4 text-center text-sm text-gray-500">
            © {{ date('Y') }} Instituto ITE. Todos los derechos reservados.
        </div>
    </footer>

</x-app-layout>
