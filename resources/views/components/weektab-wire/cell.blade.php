@props(['dateCell'=>''])

<div {{ $attributes->merge(['class'=>'relative flex flex-col group']) }}>
    <span class="mx-2 my-1 text-base font-bold">{{ $slot }}</span>
    <div class="flex flex-col px-1 py-1 overflow-auto">
        @isset($events)
        {{ $events }}
        @endisset
    </div>
    <button wire:click="addEvent('{{ $dateCell }}')" class="absolute bottom-0 right-0 flex items-center justify-center hidden w-6 h-6 mb-2 mr-2 text-white bg-gray-400 rounded group-hover:flex hover:bg-gray-500">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 plus"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
    </button>
</div>
