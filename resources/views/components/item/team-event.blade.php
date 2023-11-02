@props (['item'])
@php
    $weekDays = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );
@endphp

<div class="flex text-sm hover:bg-gray-600 hover:text-white border-b space-y-1">
		<a href="{{ route('info.time-event',['id'=>$item->id, 'edit'=>0])}}" 
			class="w-full flex space-x-2 border-r px-1 items-center grow after:content-['_↗']">
			<span class="tabular-nums">{{ $item->dayFormat }}</span>
			<span class="tabular-nums">{{ $item->startFormat }} - {{ $item->endFormat }}</span>
			<span class="grow">{{ $item->title ?? '' }}</span>
		</a>
		<div class="">
	        <x-button.icon-del wire:click="showDeleteEvent({{ $item->id }})" title="Удалить"/>
		</div>
</div>