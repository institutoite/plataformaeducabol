<x-app-layout>

    <section class="bg-cover" style="background-image: url({{asset('img/home/home.jpg')}})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-fold text-4xl">Cursos en linea</h1>
                <p class="text-white text-lg mt-2 mb-4">Aprende a tu ritmo desde cualquier dispositivo</p>

                @livewire('search')

            </div>
        </div>
    </section>

    <section class="mt-24">
        <h1 class="text-gray-600 text-center text-3xl mb-6">¿Porque elegirnos?</h1>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{asset('img/home/1.jpg')}}" alt="">
                </figure>

                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Aprende a tu ritmo</h1>
                </header>

                <p class="text-sm text-gray-500">Aprende a cualquier hora y desde cualquier dispositivo.</p>
                
            </article>

            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{asset('img/home/2.jpg')}}" alt="">
                </figure>

                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Profesores con experiencia</h1>
                </header>

                <p class="text-sm text-gray-500">Cada curso es impartido solo por profesores con gran experiencia.</p>

            </article>

            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{asset('img/home/3.jpg')}}" alt="">
                </figure>

                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Cursos producidos profesionalmente</h1>
                </header>

                <p class="text-sm text-gray-500">Seleccionamos los mejores contenidos multimedia para que no pierdas ningun detalle.</p>
                
            </article>

            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{asset('img/home/4.jpg')}}" alt="">
                </figure>

                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Incribite a un curso</h1>
                </header>

                <p class="text-sm text-gray-500">Desde aprender matematica hasta aprender computacion, pasando por practicamente cualquier materia.</p>
                
            </article>
        </div>
    </section>

    @role('Student')
    <section class="mt-24 w-full bg-gray-400 bg-center bg-cover bg-blend-multiply mb-24" style="background-image: url('https://cdn.pixabay.com/photo/2020/08/04/08/10/woman-5462074_960_720.jpg');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col flex-wrap content-center justify-center p-20">
            <h1 class="text-5xl antialiased font-semibold leading-none text-center text-gray-100">¿Te gustaria enseñar en nuestra plataforma educativa?</h1>
            <p class="pt-2 text-xl antialiased text-center text-gray-100">Crea contenido, subelo a nuestra plataforma y comienza a ganar dinero a traves de tus conocimientos.</p>
        
            <div class="flex justify-center mt-4">
                <a href="{{ route('solicitude.teacher') }}" class="btn btn-ite text-white font-bold py-2 px-4 rounded">
                    Convertirme en profesor
                </a>
            </div>
        </div>    
    </section>
    @endrole

    
    <section class="my-24">
        <h1 class="text-center text-3xl text-gray-600">ULTIMOS CURSOS</h1>
        <p class="text-center text-gray-500 text-sm mb-6">Estamos desarrollando cursos para subir a nuestra plataforma</p>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            @foreach ($courses as $course)
                <x-course-card :course="$course" />
            @endforeach
        </div>
        
    </section>

    <section class="mt-24 bg-gray-700 py-12">
        <h1 class="text-center text-white text-3xl">¿No sabes qué curso llevar?</h1>
        <p class="text-center text-white">Dirígete al catálogo de cursos y filtralos por categoría o nivel</p>

        <div class="flex justify-center mt-4">
            <a href="{{ route('courses.index') }}" class="btn btn-ite text-white font-bold py-2 px-4 rounded">
                Catalogo de cursos
            </a>
        </div>
    </section>

    <footer class="divide-y bg-white text-gray-800">
	
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-6 flex flex-col justify-between py-10 mx-auto space-y-8 lg:flex-row lg:space-y-0">
        <div class="lg:w-1/3">
                <a href="/">
                    </a><a data-turbo="false" href="/">
                        <img src="{{asset('img/home/logo.png')}}" alt="Logo" class="h-12">
                    </a>
                
            </div>
            <div class="grid grid-cols-2 text-sm gap-x-3 gap-y-8 lg:w-2/3 sm:grid-cols-3">
                
                <div class="space-y-3">
                    <h3 class="tracking-wide uppercase text-gray-900">Telefonos</h3>
                    <ul class="space-y-1">
                        <li>
                            +591 71039910
                        </li>
    
                        <li>
                            +591 71324941
                        </li>

                        <li>
                            +591 75553338
                        </li>
                        <li>
                            3-219050
                        </li>
                    </ul>
                </div>
    
                <div class="space-y-3">
                    <h3 class="uppercase text-gray-900">Correo</h3>
                    <ul class="space-y-1">
                        <li>
                            info@ite.com.bo
                        </li>
                    </ul>
                </div>
    
                <div class="space-y-3">
                    <div class="uppercase text-gray-900">Direccion</div>
                    <ul class="space-y-1">
                        <li>
                            Villa 1 de mayo avenida tres pasos al frente esquina Che Guevara 4710
                            <br> 
                            Santa Cruz de la Sierra, Bolivia
                        </li>
                    </ul>
                </div>
            </div>
    </div>    
        <div class="py-4 text-sm text-center text-gray-600">
            © 2022 Instituto ITE. Todos los derechos reservados.
        </div>
    
    </footer>

</x-app-layout>


