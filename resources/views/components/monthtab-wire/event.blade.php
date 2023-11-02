@props(['id','name','start','end'=>'','title'=>'Без темы', 'color'=>''])
<a  href="{{ route('info.time-event',['id'=>$id, 'edit'=>0])}}" 
    class="border-b text-indigo-900 flex flex-row items-center h-5 px-1 text-xs hover:bg-gray-500 hover:text-white {{ $color }}" 
    x-data="{ tooltip: false }" 
    x-on:mouseover="tooltip = true" 
    x-on:mouseleave="tooltip = false"
    >
        
    <span class="font-extrabold text-center px-1 tabular-nums">{{ $start }}</span>
    <span class="ml-2 font-medium leading-none truncate shrink">{{ $name }}</span>
    <div x-cloak x-show="tooltip" class="absolute z-50 left-0 bottom-0 p-1 {{ $color }} text-black overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto tabular-nums">{{ $start }} {{ !empty($end) ? '- '.$end : $end }}: {{ $title }}</div>
</a>
