@props(['id','name','start','end'=>'','title'=>'Без темы', 'color'=>''])
<input type="hidden" name="event-id" value="{{ $id }}">
<a  href="{{ route('info.time-event',['id'=>$id, 'edit'=>0])}}" 
    class="text-indigo-900  flex flex-row items-center h-5 px-1 text-xs hover:bg-gray-500 hover:text-white {{ $color }}" 
    x-data="{ tooltip: false }" 
    x-on:mouseover="tooltip = true" 
    x-on:mouseleave="tooltip = false"
    >
        
    <span class="p-1 font-bold bg-gray-500 text-white leading-none text-center basis-8">{{ $start }}</span>
    <span class="ml-2 font-medium leading-none truncate shrink">{{ $name }}</span>
    <div x-show="tooltip" class="absolute z-50 left-0 bottom-0 p-1 {{ $color }} text-black overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto ">{{ $start }} {{ !empty($end) ? '- '.$end : $end }}: {{ $title }}</div>
</a>
<!-- <button class="flex items-center flex-shrink-0 h-5 px-1 text-xs hover:bg-gray-200">
    <span class="flex-shrink-0 w-2 h-2 bg-gray-500 rounded-full"></span>
    <span class="ml-2 font-light leading-none">2:15pm</span>
    <span class="ml-2 font-medium leading-none truncate">A confirmed event</span>

    href="{{ route('info.team',['id'=>$id]) }}"
</button> -->