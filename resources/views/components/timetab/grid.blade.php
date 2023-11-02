@props(['rows'])

<div class="grid flex-grow w-full h-auto grid-cols-7 grid-rows-{{ $rows }} gap-px pt-px mt-1 bg-gray-200">
    {{ $slot }}            
</div>
