@props(['id','name','start','end'])
<input type="hidden" name="event-id" value="{{ $id }}">
<button class="flex items-center flex-shrink-0 h-5 px-1 text-xs hover:bg-gray-200" title="{{ $start }}-{{ $end }}: {{ $name }}">
    <span class="flex-shrink-0 w-2 h-2 border border-gray-500 rounded-full"></span>
    <span class="ml-2 font-light leading-none">{{ $start }}</span>
    <span class="ml-2 font-light leading-none">{{ $end }}</span>
    <span class="ml-2 font-medium leading-none truncate">{{ $name }}</span>
</button>
<!-- <button class="flex items-center flex-shrink-0 h-5 px-1 text-xs hover:bg-gray-200">
    <span class="flex-shrink-0 w-2 h-2 bg-gray-500 rounded-full"></span>
    <span class="ml-2 font-light leading-none">2:15pm</span>
    <span class="ml-2 font-medium leading-none truncate">A confirmed event</span>
</button> -->