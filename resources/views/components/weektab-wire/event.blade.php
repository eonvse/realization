@props(['time_event'])

<a  href="{{ route('info.time-event',['id'=>$time_event->id, 'edit'=>0])}}" 
    class="border-b text-indigo-900  items-center h-5 px-1 text-sm hover:bg-gray-500 hover:text-white {{ $time_event->color }} overflow-hidden"
    x-data="{ tooltip: false }" 
    x-on:mouseover="tooltip = true" 
    x-on:mouseleave="tooltip = false"
    >
    <span class="px-1 font-extrabold tabular-nums overflow-hidden">{{ date('H:i',strtotime($time_event->start)) }} - {{ date('H:i',strtotime($time_event->end)) }}</span>
    <span class="ml-2 font-medium overflow-hidden">{{ $time_event->name }}.</span>
    <span class="ml-2 overflow-hidden">"{{ $time_event->title }}"</span>

    <div x-cloak x-show="tooltip" class="grid grid-cols-3 absolute z-50 left-0 bottom-0 p-1 {{ $time_event->color }} text-black overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto tabular-nums">
        <div class="whitespace-pre-line">Всего участников: {{ $time_event->all_u }}
            Было: {{ $time_event->b_u }}
            Не было: {{ $time_event->n_u }}
        </div>
        <div class="whitespace-pre-line">Заметок: {{ $time_event->notes }}
            Файлов: {{ $time_event->files }}
        </div>
        <div>
            <div>Последняя заметка</div>
            @if (!empty($time_event->last_note))
            <span class="italic text-black">
                <svg class="h-4 w-4 inline-flex"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />  <line x1="12" y1="11" x2="12" y2="11.01" />  <line x1="8" y1="11" x2="8" y2="11.01" />  <line x1="16" y1="11" x2="16" y2="11.01" /></svg>
                {{ $time_event->last_note }}
            </span>
            @endif
        </div>
    </div>
</a>

