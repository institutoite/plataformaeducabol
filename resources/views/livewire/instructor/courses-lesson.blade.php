<div>
    @foreach ($section->lessons as $item)
        
        <article class="card mt-4" x-data="{open: false}">
            <div class="card-body">
                @if ($lesson->id == $item->id)
                    <form wire:submit.prevent="update">
                        <div class="flex items-center">
                            <label class="w-32">Nombre</label>
                            <input wire:model="lesson.name" class="form-input w-full">
                        </div>

                        @error('lesson.name')
                            <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror

                        <div class="flex items-center mt-4">
                            <input wire:model="file" type="file" class="form-input flex-1">
                        </div>

                        @error('lesson.url')
                            <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror

                        <div class="text-teal-500 font-bold mt-1" wire:loading wire:target="file">
                            Cargando ...
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="button" class="btn btn-danger" wire:click="cancel">Cancelar</button>
                            <button type="submit" class="btn btn-ite ml-2" >Actualizar</button>
                        </div>

                    </form>
                @else
                    <header>
                        <h1 x-on:click="open = !open" class="cursor-pointer"><i class="far fa-play-circle text-teal-400 mr-1"></i> Leccion: {{$item->name}}</h1>
                    </header>

                    <div x-show="open">

                        <hr class="my-2">

                        <video width="320" height="240" controls>
                            <source src="{{URL::asset("/storage/$item->url")}}" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                        
                        <div class="my-2">
                            <button class="btn btn-ite text-sm" wire:click="edit({{$item}})">Editar</button>
                            <button class="btn btn-danger text-sm" wire:click="destroy({{$item}})">Eliminar</button>
                        </div>

                        <div class="mb-4">
                            @livewire('instructor.lesson-description', ['lesson' => $item], key('lesson-description-' . $item->id))
                        </div>

                        <div class="mb-4">
                            @livewire('instructor.lesson-resources', ['lesson' => $item], key('lesson-resources-' . $item->id))
                        </div>

                    </div>

                @endif

            </div>
        </article>

    @endforeach

    <div class="mt-4" x-data="{open: false}">
        <a x-show="!open" x-on:click="open = true" class="flex items-center cursor-pointer">
            <i class="far fa-plus-square text-2xl text-teal-400 mr-2"></i>
            Agregar nueva leccion
        </a>

        <article class="card" x-show="open">
            <div class="card-body">
                <h1 class="text-xl font-bold mb-4">Agregar nueva leccion</h1>

                <div class="mb-4">
                    <div class="flex items-center">
                        <label class="w-32">Nombre</label>
                        <input wire:model="name" class="form-input w-full">
                    </div>

                    @error('name')
                        <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    <div class="flex items-center mt-4">
                        <input wire:model="file" type="file" class="form-input flex-1">
                    </div>

                    @error('file')
                        <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    <div class="text-teal-500 font-bold mt-1" wire:loading wire:target="file">
                        Cargando ...
                    </div>

                </div>

                <div class="flex justify-end">
                    <button class="btn btn-danger" x-on:click="open = false">Cancelar</button>
                    <button class="btn btn-ite ml-2" wire:click="store">Agregar</button>
                </div>
            </div>
        </article>
    </div>
</div>
