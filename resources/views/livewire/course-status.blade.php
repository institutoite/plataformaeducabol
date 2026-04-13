<div class="min-h-screen bg-gray-50 py-8">
    @php
        $colorPrimary = 'rgb(38,186,165)';
        $colorSecondary = 'rgb(55,95,122)';
    @endphp

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-5">
            <section class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 overflow-hidden">
                <div class="bg-gray-900" style="aspect-ratio: 16 / 9;">
                    @if ($this->video_provider === 'youtube' && $this->youtube_embed_url)
                        <iframe
                            class="w-full h-full"
                            src="{{ $this->youtube_embed_url }}"
                            title="Video de la leccion"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    @elseif ($this->video_provider === 'local' && $video_url)
                        <video class="w-full h-full" controls preload="metadata">
                            <source src="{{ $video_url }}" type="video/mp4">
                            Tu navegador no soporta la reproduccion de video.
                        </video>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-200 px-6 text-center">
                            <p class="text-lg font-semibold">No se pudo previsualizar este video</p>
                            @if($video_url)
                                <a href="{{ $video_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center rounded-lg px-4 py-2 text-sm font-bold text-white" style="background-color: {{ $colorPrimary }};">
                                    Abrir video en una nueva pestana
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <h1 class="text-2xl font-bold" style="color: {{ $colorSecondary }};">{{ $this->current->name }}</h1>

                    @if ($this->current->description)
                        <p class="text-gray-600 mt-3">{{ $this->current->description->name }}</p>
                    @endif

                    @if ($this->current->resource)
                        <button type="button" class="mt-4 inline-flex items-center rounded-lg border px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50" style="border-color: {{ $colorSecondary }};" wire:click="download">
                            Descargar complemento
                        </button>
                    @endif

                    <div class="mt-5">
                        <x-toggle wire:model="active">
                            Marcar esta unidad como culminada
                        </x-toggle>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 p-4 sm:p-5">
                <div class="flex items-center justify-between gap-3">
                    <button
                        type="button"
                        class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold {{ $this->previous ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}"
                        @if($this->previous) wire:click="$set('current_id', {{ $this->previous->id }})" @else disabled @endif>
                        Tema anterior
                    </button>

                    <button
                        type="button"
                        class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold {{ $this->next ? 'text-white' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}"
                        @if($this->next) style="background-color: {{ $colorPrimary }};" @endif
                        @if($this->next) wire:click="$set('current_id', {{ $this->next->id }})" @else disabled @endif>
                        Siguiente tema
                    </button>
                </div>
            </section>
        </div>

        <div>
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 p-6 lg:sticky lg:top-6">
                <h2 class="text-2xl font-bold text-center" style="color: {{ $colorSecondary }};">{{ $course->title }}</h2>

                @php
                    $teacher = $course->teacher;
                    $fallbackPhoto = asset('img/sinimagen.png');
                    $teacherPhoto = $teacher ? $teacher->profile_photo_url : $fallbackPhoto;
                @endphp

                <div class="mt-5 flex items-center">
                    <img
                        class="w-12 h-12 rounded-full object-cover"
                        src="{{ $teacherPhoto }}"
                        alt="{{ $teacher ? $teacher->name : 'Docente' }}"
                        onerror="this.onerror=null;this.src='{{ $fallbackPhoto }}';">

                    <div class="ml-3">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Instructor</p>
                        <p class="font-semibold" style="color: {{ $colorSecondary }};">{{ $teacher ? $teacher->name : 'Docente no disponible' }}</p>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="flex items-center justify-between text-sm">
                        <p class="font-semibold text-gray-600">Progreso</p>
                        <p class="font-bold" style="color: {{ $colorPrimary }};">{{ $this->advance . '%' }}</p>
                    </div>
                    <div class="mt-2 h-2 rounded-full bg-gray-200 overflow-hidden">
                        <div class="h-full transition-all duration-500" style="width: {{ $this->advance . '%' }}; background-color: {{ $colorPrimary }};"></div>
                    </div>
                </div>

                <div class="mt-6 space-y-5 max-h-[60vh] overflow-auto pr-1">
                    @foreach ($course->sections as $section)
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-wide mb-2" style="color: {{ $colorSecondary }};">{{ $section->name }}</h3>

                            <ul class="space-y-1.5">
                                @foreach ($section->lessons as $lesson)
                                    @php
                                        $isCurrent = $lesson->id === $current_id;
                                    @endphp
                                    <li>
                                        <button
                                            type="button"
                                            wire:click="$set('current_id', {{ $lesson->id }})"
                                            class="w-full text-left rounded-lg px-3 py-2 transition {{ $isCurrent ? '' : 'hover:bg-gray-50' }}"
                                            @if($isCurrent) style="background-color: rgba(38,186,165,0.12); border: 1px solid rgba(38,186,165,0.35);" @endif>
                                            <span class="flex items-start">
                                                <span
                                                    class="mt-1 mr-2 inline-block w-2.5 h-2.5 rounded-full"
                                                    style="background-color: {{ $lesson->completed ? $colorPrimary : ($isCurrent ? $colorSecondary : '#D1D5DB') }};">
                                                </span>
                                                <span class="text-sm {{ $isCurrent ? 'font-semibold' : 'text-gray-700' }}" @if($isCurrent) style="color: {{ $colorSecondary }};" @endif>{{ $lesson->name }}</span>
                                            </span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
