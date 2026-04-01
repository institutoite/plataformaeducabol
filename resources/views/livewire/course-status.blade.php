@push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
@endpush

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8"
        x-data="{current_id: @entangle('current_id')}">

        <div class="lg:col-span-2">
            
            <div class="relative">
                <div wire:ignore x-data="{player: null, video: @entangle('video_url')}" 
                x-init="player = new Plyr($refs.player, {ratio: '16:9'});

                    player.source = {
                        type: 'video',
                        title: 'Example title',
                        sources: [
                            {
                                src: video,
                                type: 'video/mp4',
                            }
                        ],
                        poster: 'https://cdn.pixabay.com/photo/2022/01/09/21/35/21-35-10-530_960_720.png'
                    };
                    
                    $watch('video', value => {
                        player.source = {
                            type: 'video',
                            title: 'Example title',
                            sources: [
                                {
                                    src: value,
                                    type: 'video/mp4',
                                }
                            ],
                            poster: 'https://cdn.pixabay.com/photo/2022/01/09/21/35/21-35-10-530_960_720.png'
                        };
                    })
                ">
                    
                    <video playsinline controls x-ref="player">
                    </video>

                </div>

                {{-- Cargando --}}
                <div wire:loading.flex
                    class="absolute left-0 top-0 w-full h-full bg-black bg-opacity-25 items-center justify-center">
                    <div class="w-14 h-14 border-4 border-dashed rounded-full animate-spin border-gray-400">
                    </div>
                </div>
            </div>

            <h1 class="text-3xl text-gray-600 font-bold mt-4">
                {{$this->current->name}}
            </h1>

            @if ($this->current->resource)
                <div class="flex justify-end text-gray-600 cursor-pointer" wire:click="download">
                    <i class="fas fa-download text-lg"></i>
                    <p class="text-sm ml-2">Descargar Complemento</p>
                </div>
            @endif

            @if ($this->current->description)
                <div class="text-gray-600 mt-4 mb-4">
                    {{$this->current->description->name}}
                </div>
            @endif

            <x-toggle wire:model="active">
                Marcar esta unidad como culminada
            </x-toggle>

            

            {{-- {{$this->previous->id}}
            <hr>
            {{$this->next->id}} --}}

            <div class="card mt-2">
                <div class="card-body flex text-gray-500 font-bold">
                    
                    @if ($this->previous)
                        <a wire:click="$set('current_id', {{$this->previous ? $this->previous->id : null}})" class="cursor-pointer">Tema anterior</a>
                    @endif

                    @if ($this->next)
                        <a wire:click="$set('current_id', {{$this->next ? $this->next->id : null}})" class="ml-auto cursor-pointer">Siguiente tema</a>
                    @endif
                </div>
            </div>

        </div>
    
        <div>
            <div class="card">
                <div class="px-6 py-4">
                    <h1 class="text-2xl leading-8 text-center mb-4">{{$course->title}}</h1>

                    <div class="flex items-center">
                        <figure>
                            <img class="w-12 h-12 object-cover rounded-full mr-4" src="{{$course->teacher->profile_photo_url}}" alt="">
                        </figure>

                        <div>
                            <p>{{$course->teacher->name}}</p>
                        </div>
                    </div>

                    <p class="text-gray-400 text-sm mt-2">{{$this->advance . '%'}} Completado</p>

                    <div class="relative pt-1">
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-teal-200">
                            <div style="width:{{$this->advance . '%'}}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400 transition-all duration-500"></div>
                        </div>
                    </div>
                    <ul>
                        @foreach ($course->sections as $section)
                            <li class="text-gray-600 mb-4">
                                <a class="font-bold text-base inline-block mb-2" href="">{{$section->name}}</a>
                                <ul class="space-y-1">
                                    @foreach ($section->lessons as $lesson)
                                        <li>
                                            <a class="flex w-full cursor-pointer"
                                                x-on:click="current_id = {{ $lesson->id }}">
                                                <span class="inline-block w-5 h-5 rounded-full mt-0.5 mr-2"
                                                    x-bind:class="{{ $lesson->id }} == current_id ? 
                                                        'border-4 ' + '{{ $lesson->completed ? 'border-teal-300' : 'border-gray-400' }}' : 
                                                        '{{ $lesson->completed ? 'bg-teal-300' : 'bg-gray-400' }}'">
                                                </span>

                                                <span class="inline-block flex-1 text-left">
                                                    {{ $lesson->name }}
                                                </span>
                                                
                                            </a>
                                        </li>
                                    
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
@endpush
