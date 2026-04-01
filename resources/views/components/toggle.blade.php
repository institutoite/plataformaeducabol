<a x-data="{active: @entangle($attributes->wire('model'))}" 
    class="flex items-center cursor-pointer" 
    x-on:click="active = !active">

    <i x-show="active" class="fas fa-toggle-on text-2xl text-teal-400"></i>
    <i style="display: none;" x-show="!active" class="fas fa-toggle-off text-2xl text-gray-600"></i>

    <span class="text-sm ml-2">
        {{$slot}}
    </span>
</a>